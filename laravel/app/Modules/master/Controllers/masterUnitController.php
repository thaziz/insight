<?php




namespace App\Modules\master\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengguna;
use DB;
use Auth;
use Carbon\Carbon;
use App\Modules\master\model\m_unit;
use Validator;


class masterUnitController extends Controller
{
    function index(){    	      
    	return view('master::unit.index');
    }
    function data(){
	    return m_unit::datatables();
    }
    function tambah(){
    	return view('master::unit.tambah');
    }
    function simpan(Request $request){
    	DB::beginTransaction();
        try {        	

        $rules = array(
            'nama_induk' => 'required',
            'nama_unit' => 'required|min:4',
            'alamat' => 'required|min:4',
            'manager' => 'required|min:4',
            'k3' => 'required|min:4',
        );
        $custom=[
                  'required'             => ':Attribute Wajib Di isi.',
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

        $id=m_unit::max('u_id')+1;
        
    	m_unit::create([
                      'u_nama_unit' =>$id,                             
                      'u_nama_unit' =>$request->nama_unit,                           
    						      'u_induk' =>$request->nama_induk,    						
                      'u_alamat' =>$request->alamat,
                      'u_manager' =>$request->manager,
                      'u_k3' =>$request->k3

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
      $data=m_unit::join('m_induk','i_id','=','u_induk')->where('u_id',$id)->first();      
      return view('master::unit.edit',compact('data'));
    }
     function update(Request $request){
        DB::beginTransaction();
        try {           

        $rules = array(
            'nama_induk' => 'required',
            'nama_unit' => 'required|min:4',
            'alamat' => 'required|min:4',
            'manager' => 'required|min:4',
            'k3' => 'required|min:4',
        );
        $custom=[
                  'required'             => ':Attribute Wajib Di isi.',
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

        $update=m_unit::where('u_id',$request->id);        
        $update->update([                            
                            'u_nama_unit' =>$request->nama_unit,                           
                            'u_induk' =>$request->nama_induk,               
                            'u_alamat' =>$request->alamat,                   
                            'u_manager' =>$request->manager,
                            'u_k3' =>$request->k3
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

            
         m_unit::where('u_id',$request->id)->delete();

         DB::commit();
         $data=['status'=>'berhasil','pesan'=>''];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }
    }

    function select_unit(){
        $lokasi=m_unit::get();              
        $res = ['data' => $lokasi];
        return json_encode($res);
    }
}

