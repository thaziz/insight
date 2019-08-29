<?php




namespace App\Modules\master\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengguna;
use DB;
use Auth;
use Carbon\Carbon;
use App\Modules\master\model\m_kode;
use App\Modules\master\model\m_group;
use Yajra\Datatables\Datatables;
use Validator;


class masterKodeController extends Controller
{
    function index(){    	
    	return view('master::kode.index');
    }
    function data(){
	    return m_kode::datatables();
    }
    function tambah(){
      $group=m_group::get();
    	return view('master::kode.tambah',compact('group'));
    }
    function simpan(Request $request){
    	DB::beginTransaction();
        try {      
        $rules = array(
            'masa_berlaku' => 'required|numeric',
            'jumlah_main' => 'required|numeric',
            'kode' => 'required',
            'group' => 'required',
        );
        $custom=[
                  'required'             => ':Attribute Wajib Di isi.',
                  'numeric'             => ':Attribute Wajib Angka',
                  'email'                => 'Alamat E-Mail belum benar.',                    
                  'min'                  => [
                        'numeric' => ':Attribute Minimal :min Karakter.',                        
                        'string'  => ':Attribute Minimal :min Karakter.',    
                        'file'  => ':Attribute Tidak Boleh Kosong.',    

                        
                    ],

                ];
        $validator = Validator::make($request->all(), $rules,$custom);
        

        if ($validator->fails()) {                          
        $eror='';

          foreach ($validator->errors()->all() as $key => $value) {

                  $eror.=$value;



                  if($eror!='')
                    $eror=$eror.'<br>';

          }


                $dataInfo=['status'=>'gagal','pesan'=>$eror];            
                return json_encode($dataInfo);
        
        }

        $id=m_kode::max('kode_id')+1;
        
    	m_kode::create([
                'kode_id' =>$id,                           
    						'masa_berlaku' =>$request->masa_berlaku,    						
                'jumlah_main' =>$request->jumlah_main,
                'kode' =>$request->kode,
                'group' =>$request->group,
    					  ]);
    	 DB::commit();
    	 $data=['status'=>'berhasil','pesan'=>''];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }

    }

   public function edit($id){
      $group=m_group::get();
      $data=m_kode::where('kode_id',$id)->first();
      return view('master::kode.edit',compact('data','group'));
    }
     function update(Request $request){
        DB::beginTransaction();
        try {           

        $rules = array(
            'masa_berlaku' => 'required|numeric',
            'jumlah_main' => 'required|numeric',
            'kode' => 'required',
            'group' =>'required',
        );
        $custom=[
                  'required'             => ':Attribute Wajib Di isi.',
                  'numeric'             => ':Attribute Wajib Angka',
                  'email'                => 'Alamat E-Mail belum benar.',                    
                  'min'                  => [
                        'numeric' => ':Attribute Minimal :min Karakter.',                        
                        'string'  => ':Attribute Minimal :min Karakter.',    
                        'file'  => ':Attribute Tidak Boleh Kosong.',    

                        
                    ],

                ];
        $validator = Validator::make($request->all(), $rules,$custom);
        

        if ($validator->fails()) {                          
        $eror='';

          foreach ($validator->errors()->all() as $key => $value) {

                  $eror.=$value;



                  if($eror!='')
                    $eror=$eror.'<br>';

          }


                $dataInfo=['status'=>'gagal','pesan'=>$eror];            
                return json_encode($dataInfo);
        
        }

        $update=m_kode::where('kode_id',$request->id);        
        $update->update([                                                
                              'masa_berlaku' =>$request->masa_berlaku,                
                              'jumlah_main' =>$request->jumlah_main,
                              'kode' =>$request->kode,
                              'group' =>$request->group,
                          ]);
         DB::commit();
         $data=['status'=>'berhasil','pesan'=>''];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }

    }

    function delete(Request $request){
        DB::beginTransaction();
        try {           

            
         m_kode::where('kode_id',$request->id)->delete();

         DB::commit();
         $data=['status'=>'berhasil','pesan'=>''];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }
    }
    function select_induk(){
        $lokasi=m_kode::get();      
        $res = ['data' => $lokasi];
        return json_encode($res);
    }

}

