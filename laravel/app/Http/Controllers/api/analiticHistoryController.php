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

class analiticHistoryController extends Controller
{
    public function create(Request $req) {       
      DB::beginTransaction();
        try {      
        $rules = array(
            'id_profile_ig' => 'required', 
            'time_stamp' => 'required', 
            'follower_count' => 'required', 
            'post_count' => 'required', 
            'daily_engagement_rate'=> 'required', 
            'following' =>'required', 
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
                'id_profile_ig' =>$req->id_profile_ig,
                'time_stamp' => $req->time_stamp,
                'follower_count' => $req->follower_count, 
                'post_count' => $req->post_count,
                'daily_engagement_rate'=>$req->daily_engagement_rate, 
                'following' =>$req->following, 
                ];
            DB::table('analitic_history')
            ->insert([  
                      $data
                    ]);
            
        }
          DB::commit();
          $data=['status'=>'berhasil','konten'=>'Data Berhasil Disimpan'];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }
        
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
