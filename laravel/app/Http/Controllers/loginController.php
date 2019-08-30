<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use Validator;

use DB;

use App\Pengguna;

use Carbon\Carbon;

use Auth;

class loginController extends Controller
{
    public function authenticate(Request $req) {       
        return DB::transaction(function() use ($req){         
        $rules = array(
            'email' => 'required|min:4', // make sure the  is an actual 
            'password' => 'required|min:4' // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {            
                $dataInfo=['status'=>'gagal','data'=>'Panjang Karakter Password atau Nama Harus Minimal 4 Karakter '];            
                return json_encode($dataInfo);
        } else {
            $email = $req->email;
            $password = $req->password;
            $user = Pengguna::whereRaw("BINARY `u_username`= ?",[$req->email])->first();
            

            if(empty($user->u_id)){
                  $dataInfo=['status'=>'gagal','konten'=>'Password atau Nama Tidak Di Temukan'];            
                      return json_encode($dataInfo);
            }

             
                    if($user->u_role=='Admin'){
                          Auth::login($user);
                         $url='/admin';
                          $dataInfo=['status'=>'sukses','nama'=>$user->u_username,'redirect'=>$url];
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
                    Auth::login($user);
                    if(Auth::user()->u_role=='Admin'){
                         $url='/admin';
                    }
                    else{
                     $url='/member';   
                    }
                    $dataInfo=['status'=>'sukses','nama'=>$user->u_username,'redirect'=>$url];

                     return json_encode($dataInfo);

            } else {      

                 $dataInfo=['status'=>'gagal','konten'=>'Password atau Nama Tidak Di Temukan'];            
                      return json_encode($dataInfo);
            }
        }
        });
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
