<?php




namespace App\Modules\member\Controllers;

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


class memberAktivasiController extends Controller
{
    function index(){  
      $m_id=Auth::user()->u_member;  	
    	return view('member::member.index',compact('m_id'));
    }
    function data(){
         $m_id=Auth::user()->u_member;
         $getdata = DB::table('member')->where('m_id',$m_id)->get();         
          return Datatables::of($getdata)
              ->addIndexColumn()
              ->addColumn('action', function ($getdata) {

                if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='Y'){
                      return '<center><div class="btn-group btn-group-sm">
                      <button class="btn btn-primary" onclick="daftar('.$getdata->m_id.')" rel="tooltip" data-placement="top" data-original-Approve="Daftar Member"><i class="fa fa-list-o"></i></button>';
                }
                else if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='N'){
                    return '<center><div class="btn-group btn-group-sm">
                      <button class="btn btn-info" onclick="verifikasi('.$getdata->m_id.',\''.md5($getdata->m_email).'\')" rel="tooltip" data-placement="top" title="Aktivasi Member"><i class="glyphicon glyphicon-check"></i></button>
                      <button class="btn btn-warning" onclick="daftar('.$getdata->m_id.')" rel="tooltip" data-placement="top" title="Daftar Member"><i class="fa fa-list"></i></button>';
                }              
              })    
               ->addColumn('status', function ($getdata) {
                  if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='Y'){
                      return '<span class="label label-primary">Aktif</span>';
                  }
                  else if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='N'){
                    return '<span class="label label-info">Trial</span>'; 
                  }
              })                
              ->rawColumns(['action','status'])
              ->make(true); 
    }


    function dataChild(){
         $m_id=Auth::user()->u_member;
         $getdata = DB::table('member')->where('m_parrent_m_id',$m_id)->get();
          return Datatables::of($getdata)
              ->addIndexColumn()
              ->addColumn('action', function ($getdata) {

                if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='Y'){
                      return '<center><div class="btn-group btn-group-sm">
                      <button class="btn btn-primary" onclick="daftar('.$getdata->m_id.')" rel="tooltip" data-placement="top" data-original-Approve="Daftar Member"><i class="fa fa-list-o"></i></button>';
                }
                else if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='N'){
                    return '<center><div class="btn-group btn-group-sm">
                      <button class="btn btn-info" onclick="verifikasi('.$getdata->m_id.',\''.md5($getdata->m_email).'\')" rel="tooltip" data-placement="top" title="Aktivasi Member"><i class="glyphicon glyphicon-check"></i></button>
                      <button class="btn btn-warning" onclick="daftar('.$getdata->m_id.')" rel="tooltip" data-placement="top" title="Daftar Member"><i class="fa fa-list"></i></button>';
                }              
              })    
               ->addColumn('status', function ($getdata) {
                  if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='Y'){
                      return '<span class="label label-primary">Aktif</span>';
                  }
                  else if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='N'){
                    return '<span class="label label-info">Trial</span>'; 
                  }
              })                
              ->rawColumns(['action','status'])
              ->make(true); 
    }
    function data_verifikasi($id,$token){
      $data=Pengguna::where('u_member',$id)
            ->leftjoin('member','m_id','=','u_member')
            ->leftjoin('session','u_id','=','s_user_id')
            ->first();

      if($token==md5($data->u_username)){               
        $paket=DB::table('master_paket')->get();
        $bank=DB::table('bank_account')->get();

        return view('member::member.tambah',compact('data','paket','bank')); 
      }else{
        return '404';
      }
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
      return view('member::kode.edit',compact('data','group'));
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

