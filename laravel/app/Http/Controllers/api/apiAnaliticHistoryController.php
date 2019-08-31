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

class apiAnaliticHistoryController extends Controller
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
          $dataInfo=['status_code'=>300,'status'=>'gagal','pesan'=>$eror];            
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
          $data=['status_code'=>200,'status'=>'berhasil','konten'=>'Data Berhasil Disimpan'];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status_code'=>300,'status'=>'gagal','konten'=>$e->getMessage()];
          return json_encode($data);
        }
        
    }

public function data(){
  $data=DB::table('analitic_history')->get();
          $data=['status_code'=>200,'status'=>'berhasil','konten'=>$data];
          return json_encode($data);
}

public function show($id_profile_ig){
  $data=DB::table('analitic_history')->where('id_profile_ig',$id_profile_ig)->first();
          $data=['status_code'=>200,'status'=>'berhasil','konten'=>$data];
          return json_encode($data);
}

public function update($id_profile_ig,Request $req) {       
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
          $dataInfo=['status_code'=>300,'status'=>'gagal','pesan'=>$eror];            
          return json_encode($dataInfo);        
        } else {           
            DB::table('analitic_history')->where('id_profile_ig',$id_profile_ig)
            ->update([
                'id_profile_ig' =>$req->id_profile_ig,
                'time_stamp' => $req->time_stamp,
                'follower_count' => $req->follower_count, 
                'post_count' => $req->post_count,
                'daily_engagement_rate'=>$req->daily_engagement_rate, 
                'following' =>$req->following, 
                ]);
            
        }
          DB::commit();
          $data=['status_code'=>200,'status'=>'berhasil','konten'=>'Data Berhasil Diperbarui'];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status_code'=>300,'status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }
        
    }


    public function delete($id_profile_ig){
          $data=DB::table('analitic_history')->where('id_profile_ig',$id_profile_ig);
          if($data->first()){
          $data->delete();
            $data=['status_code'=>200,'status'=>'berhasil','Data Berhasil Dihapus'];
            return json_encode($data);
          }else{
            $data=['status_code'=>300,'status'=>'gagal','konten'=>'Data Tidak Ditemukan'];
            return json_encode($data);
          }
          
}


}
