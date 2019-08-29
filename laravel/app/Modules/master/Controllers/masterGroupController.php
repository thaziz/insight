<?php




namespace App\Modules\master\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengguna;
use DB;
use Auth;
use Carbon\Carbon;
use App\Modules\master\model\m_group;
use App\Modules\master\model\m_group_detail;
use Yajra\Datatables\Datatables;
use Validator;


class masterGroupController extends Controller
{
    function index(){    	
    	return view('master::group.index');
    }
    function data(){
	    return m_group::datatables();
    }
    function tambah(){
    	return view('master::group.tambah');
    }
    function simpan(Request $request){
    	DB::beginTransaction();
        try {      
        $rules = array(
            'group' => 'required',
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

        $id=m_group::max('g_id')+1;
        
    	m_group::create([
                'g_nama' =>$request->group,
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
      $data=m_group::where('g_id',$id)->first();
      return view('master::group.edit',compact('data'));
    }
     function update(Request $request){
        DB::beginTransaction();
        try {           

        $rules = array(
            'group' => 'required',
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

        $update=m_group::where('g_id',$request->id);        
        $update->update([                                                                   
                              'g_nama' =>$request->group,
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
         m_group::where('g_id',$request->id)->delete();
         m_group_detail::where('gd_group',$request->id)->delete();

         DB::commit();
         $data=['status'=>'berhasil','pesan'=>''];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }
    }
   public function detail($id){
      $data=m_group::where('g_id',$id)->first();
      $data_dt=m_group_detail::where('gd_group',$id)->get();

      return view('master::group.tambah-detail',compact('data','data_dt'));
    }
  public function simpan_detail(Request $request){
          $id=$request->id;
          $erorDtB='';
          $data_dt=m_group_detail::where('gd_group',$id)->delete();
          for ($i=0; $i<count($request->namabarang); $i++) { 
                $in=$i;
                if($request->namabarang[$i]==''){
                  $erorDtB.='Nama Hadiah Ke '.($in+1).' Pada Detail Masih Kosong';
                }
          }

          $lengkap=$erorDtB;        
          if($lengkap!=''){
              $dataInfo=['status'=>'gagal','pesan'=>$lengkap];            
              return json_encode($dataInfo);        
          }

          
          for ($i=0; $i <count($request->namabarang) ; $i++) {                 
                  $gd_detailid=m_group_detail::where('gd_group',$id)->max('gd_detailid')+1;
                  m_group_detail::create([                      
                          'gd_group' =>$id,                             
                          'gd_detailid' =>$gd_detailid,
                          'gd_nama' =>$request->namabarang[$i],                
                   ]);
          }

          DB::commit();
          $data=['status'=>'berhasil','pesan'=>''];
          return json_encode($data);
  }

}

