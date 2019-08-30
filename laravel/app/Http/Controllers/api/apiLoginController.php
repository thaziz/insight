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

class apiLoginController extends Controller
{
    public function authenticate(Request $req) {       
        return DB::transaction(function() use ($req){         
        $rules = array(
            'email' => 'required|min:4', // make sure the  is an actual 
            'password' => 'required|min:4' // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {            
                $dataInfo=['status'=>'gagal','konten'=>'Panjang Karakter Password atau Nama Harus Minimal 4 Karakter '];            
                return json_encode($dataInfo);
        } else {
            $email = $req->email;
            $password = $req->password;
            $user = Pengguna::whereRaw("BINARY `u_username`= ?",[$req->email])->first();

            if(empty($user->u_id)){
                  $dataInfo=['status'=>'gagal','konten'=>'Password atau Nama Tidak Di Temukan'];            
                      return json_encode($dataInfo);
            }

            $member=DB::table('member')->select('m_status_expired','m_status_verifikasi')->where('m_id',$user->u_member)->first();
            $start=date('Y-m-d H:i:s');                
            $end=$member->m_status_expired;

            if($member->m_status_verifikasi=='N'){
                $dataInfo=['status'=>'gagal','konten'=>'Account Belum Diaktifasi'];            
                return json_encode($dataInfo);
            }            

            if($start>=$end){
                $dataInfo=['status'=>'gagal','konten'=>'Login Expired'];            
                return json_encode($dataInfo);
            }            

            if ($user && $user->u_password == md5($req->password)) {                    
                  $session=DB::table('session')
                            ->where('s_user_id',$user->u_id)
                            ->first();



                    $start = date_create($start);
                    $end = date_create($end);
                    $diff=date_diff($end,$start);

                    $waktu=[
                            'total Hari' =>$diff->days,
                            'tahun'=>$diff->y,
                            'bulan'=>$diff->m,
                            'hari'=>$diff->d,
                            'jam'=>$diff->h,
                            'menit'=>$diff->i,
                            'detik'=>$diff->s
                            ];

                    if($session){
                        if(
                          $session->s_imei==$req->imei &&
                          $session->s_manufacture==$req->manufacture &&
                          $session->s_ip==$req->ip
                          && $req->imei!=''
                          && $req->manufacture!=''
                          && $req->ip!=''
                        ){
                        $dataInfo=['status'=>'sukses',
                                   'konten'=>'Sudah Login',
                                   'user_id'=>$user->u_id,
                                   'berlaku'=>$waktu,
                                   'token'=>$session->s_token,
                                 ];            
                        return json_encode($dataInfo);
                        }else{
                          $dataInfo=['status'=>'gagal','konten'=>'Sesion Pada login Berbeda'];
                          return json_encode($dataInfo);

                        }
                    }else{

                        $token=$this->token(32);
                        DB::table('session')
                                ->insert([
                                    's_user_id'=>$user->u_id,
                                    's_token'  =>$token,
                                    's_imei'  =>$req->imei,
                                    's_manufacture'  =>$req->manufacture,
                                    's_ip'  =>$req->ip,
                                    's_model_gadget'  =>$req->model_gadget,
                                    's_os_version'  =>$req->os_version,
                                    's_app_version'  =>$req->app_version,
                                    's_time_stamp'  =>$req->time_stamp,
                                ]);
                    }

                    $dataInfo=['status'=>'sukses',
                                   'konten'=>'Login Berhasil',
                                   'user_id'=>$user->u_id,
                                   'berlaku'=>$waktu,
                                   'token'=>$token,
                                 ];            
                    return json_encode($dataInfo);

                     

            } else {      

                 $dataInfo=['status'=>'gagal','konten'=>'Password atau Nama Tidak Di Temukan'];            
                 return json_encode($dataInfo);
            }
        }
        });
    }


    function logout(Request $req){
      DB::beginTransaction();
        try {
          $user = Pengguna::where('u_id',$req->id)->first();
          if($user){
            $session=DB::table('session')
                            ->where('s_user_id',$req->id)
                            ->first();
            $dataInfo=['status'=>'sukses','konten'=>'Logout Berhasil'];            
          }else{
            $dataInfo=['status'=>'gagal','konten'=>'Logout Gagal'];            
          }          
          DB::commit();                    
          return json_encode($dataInfo);
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','konten'=>$e->getMessage()];
          return json_encode($data);
        }
        



    }

    

    function token($value)
    {
      $keyspace = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $str = '';
      $max = mb_strlen($keyspace, '8bit') - 1;
      for ($i = 0; $i < $value; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
      }
      return $str;
    }



}
