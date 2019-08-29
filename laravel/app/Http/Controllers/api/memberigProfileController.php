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

class memberigProfile extends Controller
{
    public function create(Request $req) {       
      DB::beginTransaction();
        try {      
        $rules = array(
            'member_id' => 'required', 
            'ig_profile_id' => 'required', 
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
                'member_id' =>$req->member_id,
                'ig_profile_id' => $req->ig_profile_id,                
                ];
            DB::table('member_ig_profile')
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
  $data=DB::table('member_ig_profile')->get();
          $data=['status'=>'berhasil','konten'=>$data];
          return json_encode($data);
}

public function show($mi_id){
  $data=DB::table('member_ig_profile')->where('mi_id',$mi_id)->first();
          $data=['status'=>'berhasil','konten'=>$data];
          return json_encode($data);
}

public function update($mi_id,Request $req) {       
      DB::beginTransaction();
        try {      
        $rules = array(
            'member_id' => 'required', 
            'ig_profile_id' => 'required', 
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
            DB::table('member_ig_profile')->where('mi_id',$mi_id)
            ->update([
                'member_id' =>$req->member_id,
                'ig_profile_id' => $req->ig_profile_id,                
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


    public function delete($mi_id){
          $data=DB::table('member_ig_profile')->where('mi_id',$mi_id);
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
