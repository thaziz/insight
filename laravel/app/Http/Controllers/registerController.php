<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use Validator;

use DB;

use App\Pengguna;

use Carbon\Carbon;

use Auth;

use Mail;
/*member*/
class registerController extends Controller
{

public function verify(Request $req){  
        DB::beginTransaction();
        try {                           
          $mem=DB::table('member')->where('m_activation_code',$req->token);
          if($mem->first()){

          if($mem->first()->m_status_verifikasi=='N'){            
                DB::table('member')->where('m_activation_code',$req->token)->update([
                  'm_status_verifikasi'=>'Y'
                ]);
                $u_id=Pengguna::select('u_id')->max('u_id')+1;
                $data=$mem->first();
                
                Pengguna::create([
                                  'u_id'=>$u_id,
                                  'u_password'=>$data->m_password,
                                  'u_member'=>$data->m_id,
                                  'u_username'=>$data->m_email,
                                  'u_status'=>'A',
                                  'u_role'=>'member',
                                ]);
          }else{
            return response (['status' => 'gagal','konten'=>'Verifikasi Sudah Dilakukan']);
          }
          }else{
            return response (['status' => 'gagal','konten'=>'Kode Verifikasi Sudah Expired']); 
          }                
          DB::commit();
          Session::flush();  
          Auth::logout();
          return redirect()->route('daftar');
          /*return response (['status' => 'sukses','konten'=>'Verifikasi Berhasil']);*/
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','konten'=>$e->getMessage()];
          return json_encode($data);
        }
  

}
public function sendEmail($nama,$email,$aktifasi)
{
    try{
        $url=route('register.verify', ['token' => $aktifasi]);
        Mail::send('email', ['nama' => $nama, 'pesan' => $url], function ($message) use ($nama,$email,$aktifasi)
        {
            $message->subject('Email Aktivasi');
            $message->from('donotreply@gmail.com', 'Insight');
            $message->to($email);
        });
        return back()->with('alert-success','Berhasil Kirim Email');
    }
    catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
    }
}


  public function register(Request $req) {       
        return DB::transaction(function() use ($req){         
        $rules = array(
            'nama' => 'unique:member,m_username|required|min:4',
            'email' => 'email|unique:member,m_email|required|min:4',
            'no_telpon' => 'required|min:4|numeric',
            'password' => 'required|min:4',
        );

        $custom=[
                  'numeric' => ':Attribute Harus Angka.',                        
                  'unique'             => ':Attribute Sudah Terdaftar.',
                  'required'             => ':Attribute Wajib Di isi.',
                  'email'                => 'Alamat E-Mail belum benar.',                    
                  'min'                  => [
                        'numeric' => ':Attribute Minimal :min Karakter.',                        
                        'string'  => ':Attribute Minimal :min Karakter.',    
                        'file'  => ':Attribute Tidak Boleh Kosong.',    

                        
                    ],

                ];

          

        $validator = Validator::make($req->all(), $rules,$custom);

        if ($validator->fails()) {                            
          $eror='';
          
           foreach ($validator->errors()->all() as $key => $value) {
                  $eror.=$value.'<br>';
            }
                $dataInfo=['status'=>'gagal','konten'=>$eror];  
                return json_encode($dataInfo);
        } else {          
          $tgl    =date('Y-m-d');
          $waktu  =date('H:i:s');
          $strtotime=strtotime($waktu);
          $aktifasi=sha1(md5($req->email.$waktu).'Bismillah');
              $datamember=[
                            'm_username' => $req->nama,
                              'm_email' =>$req->email,
                              'm_hp' => $req->no_telpon,
                              'm_password' => md5($req->password),
                              'm_status_trial' =>'N',
                              'm_created' =>$tgl.' '.$waktu,
                              'm_status_expired'=>date('Y-m-d', strtotime('+7 day',$strtotime)).' '.$waktu,
                              'm_activation_code'=>$aktifasi,
                            ];
              if($req->m_id!=''){
                  $datamember['m_parrent_m_id']=$req->m_id;
              }

              
              DB::table('member')->insert([
                $datamember
              ]);

            $this->sendEmail($req->nama,$req->email,$aktifasi);


        $dataInfo=['status'=>'sukses','konten'=>'Registrasi Berhasi'];           
        return json_encode($dataInfo);

        }

        });
    }

function getAll(){
          $data=Pengguna::get();
          return response()->json($data);
}

function showRegister($id){
          $data=Pengguna::where('u_id',$id)->first();
          return response()->json($data);
}

 public function destroy($id)
    {
        $data=Pengguna::where('u_id',$id)->delete();
        if($data){
            return response()->json([
                'message' => 'Hapus Data Berhasi!'
            ]);
        }else{
          return response()->json([
                'message' => 'gagal'
            ]);
        }
    }



}
