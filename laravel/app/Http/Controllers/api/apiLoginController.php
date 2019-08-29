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

            if ($user && $user->u_password == md5($req->password)) {
                    Auth::login($user);
                    $session=DB::table('session')
                            ->where('s_user_id',$user->u_id)
                            ->first();
                    if($session){
                        $dataInfo=['status'=>'gagal','konten'=>'Sudah Login'];            
                        return json_encode($dataInfo);
                    }else{
                        
                        $token=$this->token(32);
                        DB::table('session')
                                ->insert([
                                    's_user_id'=>$user->u_id,
                                    's_token'  =>$token,
                                ]);
                    }


                    
                    if(Auth::user()->u_role=='Admin'){
                    $url='/admin';
                    }
                    else{
                     $url='/user';   
                    }
                    $dataInfo=['status'=>'sukses','nama'=>$user->u_username,'redirect'=>$url,'token'=>$token];

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
