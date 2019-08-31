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

class apiActivityController extends Controller
{
    public function create(Request $req) {       
      DB::beginTransaction();
        try {      

        $rules = array(
            'user_id' => 'required', 
            'account_ig' => 'required', 
            'type_activity' => 'required',             
            'post_url' => 'required', 
            'time_stamp' => 'required',             
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
                'user_id' => $req->user_id, 
                'account_ig' => $req->account_ig, 
                'type_activity' => $req->type_activity,                
                'post_url' => $req->post_url, 
                'time_stamp' => $req->time_stamp,  
                ];
            DB::table('activity')
            ->insert([  
                      $data
                    ]);
            
        }
          DB::commit();
          $data=['status_code'=>200,'status'=>'berhasil','konten'=>'Data Berhasil Disimpan','member_id'=>$req->member_id];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status_code'=>300,'status'=>'gagal','konten'=>$e->getMessage()];
          return json_encode($data);
        }
        
    }

public function data(){
  $data=DB::table('activity')->get();
          $data=['status_code'=>200,'status'=>'berhasil','konten'=>$data];
          return json_encode($data);
}

public function show($id){
  $data=DB::table('activity')->where('a_id',$id)->first();
          $data=['status_code'=>200,'status'=>'berhasil','konten'=>$data];
          return json_encode($data);
}

public function update($id,Request $req) {       
      DB::beginTransaction();
        try {      
         $rules = array(
            'user_id' => 'required', 
            'account_ig' => 'required', 
            'type_activity' => 'required',             
            'post_url' => 'required', 
            'time_stamp' => 'required',             
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

            DB::table('activity')->where('a_id',$id)
            ->update([
                'user_id' => $req->user_id, 
                'account_ig' => $req->account_ig, 
                'type_activity' => $req->type_activity,                
                'post_url' => $req->post_url, 
                'time_stamp' => $req->time_stamp,  
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


    public function delete($id){
          $data=DB::table('activity')->where('a_id',$id);
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
