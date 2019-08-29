<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Session;

use Validator;

use DB;

use App\Pengguna;

use Carbon\Carbon;

use Auth;

class subscribeController extends Controller
{
    public function create(Request $req) {       
      DB::beginTransaction();
        try {      
        $rules = array(
            'id_member' => 'required', 
            'expired_date' => 'required', 
            'id_paket' => 'required',             
        );
          $custom=[
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
          $dataInfo=['status'=>'gagal','pesan'=>$eror];            
          return json_encode($dataInfo);        
        } else {
            $data=[
                'id_member' => $req->id_member, 
                'expired_date' => $req->expired_date, 
                'id_paket' => $req->id_paket,                
                ];
            DB::table('subscribe')
            ->insert([  
                      $data
                    ]);
            
        }
          DB::commit();
          $data=['status'=>'berhasil','konten'=>'Data Berhasil Disimpan','member_id'=>$req->member_id];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','konten'=>$e->getMessage()];
          return json_encode($data);
        }
        
    }

public function data(){
  $data=DB::table('subscribe')->get();
          $data=['status'=>'berhasil','konten'=>$data];
          return json_encode($data);
}

public function show($s_id){
  $data=DB::table('subscribe')->where('s_id',$s_id)->first();
          $data=['status'=>'berhasil','konten'=>$data];
          return json_encode($data);
}

public function update($s_id,Request $req) {       
      DB::beginTransaction();
        try {      
        $rules = array(
            'id_member' => 'required', 
            'expired_date' => 'required', 
            'id_paket' => 'required',             
        );
          $custom=[
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
          $dataInfo=['status'=>'gagal','pesan'=>$eror];            
          return json_encode($dataInfo);        
        } else {           
            DB::table('subscribe')->where('s_id',$s_id)
            ->update([
                'id_member' => $req->id_member, 
                'expired_date' => $req->expired_date, 
                'id_paket' => $req->id_paket,                
                ]);
            
        }
          DB::commit();
          $data=['status'=>'berhasil','konten'=>'Data Berhasil Diperbarui'];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }
        
    }


    public function delete($s_id){
          $data=DB::table('subscribe')->where('s_id',$s_id);
          if($data->first()){
          $data->delete();
            $data=['status'=>'berhasil','Data Berhasil Dihapus'];
            return json_encode($data);
          }else{
            $data=['status'=>'gagal','konten'=>'Data Tidak Ditemukan'];
            return json_encode($data);
          }
          
}


}
