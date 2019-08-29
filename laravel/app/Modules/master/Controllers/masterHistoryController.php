<?php




namespace App\Modules\master\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengguna;
use DB;
use Auth;
use Carbon\Carbon;
use App\Modules\master\model\m_kode;
use Yajra\Datatables\Datatables;
use Validator;


class masterHistoryController extends Controller
{
    function chek_kode(){     
    return view('master::chek_kode.index');
    }
    function chek_kode_data(){     
     $data=DB::select(DB::raw('SELECT  m_kode.kode,(COALESCE(jumlah_main,0)-COALESCE(main,0)) as main,
TIMEDIFF(TIME_FORMAT(concat(masa_berlaku,":00:00"),"%H:%i:%s"),TIMEDIFF(NOW(),kode_created)) as total ,
time_to_sec(TIMEDIFF(TIME_FORMAT(concat(masa_berlaku,":00:00"),"%H:%i:%s"),TIMEDIFF(NOW(),kode_created))) as waktu FROM m_kode'));
       $getdata = collect($data);
       

      return Datatables::of($getdata)
            ->addIndexColumn()
            ->addColumn('action', function ($getdata) {
              
              if($getdata->main<=0){
                 return '<span class="label label-warning">Sisa Permainan 0</span>';
              }
              if($getdata->main>0 && $getdata->waktu>0){
                 return '<span class="label label-success">Tersisa '.$getdata->total.' Jam Untuk Memainkan</span>';
              }
              if($getdata->main>0 && $getdata->waktu<0){
                 return '<span class="label label-danger">expired (sudah habis masa berlaku)</span>';
              }



                  })                  
                  ->rawColumns(['action','hadiah','jam'])
            ->make(true);

    }
    function index(){    	
    	return view('master::history.index');
    }
    function data(){
       $data=DB::select(DB::raw("SELECT kode,main,group_CONCAT(gd_nama SEPARATOR '<br>') as hadiah,GROUP_CONCAT(DATE_FORMAT(t.t_created_at,'%d-%m-%Y %H:%i:%S') SEPARATOR '<br>') as jam FROM m_kode AS k JOIN transaksi AS t ON (k.kode=t.t_kode) JOIN m_group_detail gd ON (gd.gd_group=t.t_group AND gd.gd_detailid=t.t_group_dt) GROUP BY kode"));
       $getdata = collect($data);
       

      return Datatables::of($getdata)
            ->addIndexColumn()
            ->addColumn('action', function ($getdata) {
                    return '<center><div class="btn-group btn-group-sm">
                            <button class="btn btn-primary" rel="tooltip" data-placement="top" data-original-Approve="Edit"><i class="glyphicon glyphicon-check"></i></button>
                            <button class="btn btn-danger" rel="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button>';


                  })                  
                  ->rawColumns(['action','hadiah','jam'])
            ->make(true);
    }
    function tambah(){
    	return view('master::history.tambah');
    }
    function simpan(Request $request){
    	DB::beginTransaction();
        try {      
        $rules = array(
            'masa_berlaku' => 'required',
            'jumlah_main' => 'required',
            'history' => 'required',
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

        $id=m_kode::max('history_id')+1;
        
    	m_kode::create([
                'history_id' =>$id,                           
    						'masa_berlaku' =>$request->masa_berlaku,    						
                'jumlah_main' =>$request->jumlah_main,
                'history' =>$request->history,
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
      $data=m_kode::where('history_id',$id)->first();
      return view('master::history.edit',compact('data'));
    }
     function update(Request $request){
        DB::beginTransaction();
        try {           

        $rules = array(
            'masa_berlaku' => 'required',
            'jumlah_main' => 'required',
            'history' => 'required',
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

        $update=m_kode::where('history_id',$request->id);        
        $update->update([                                                
                              'masa_berlaku' =>$request->masa_berlaku,                
                              'jumlah_main' =>$request->jumlah_main,
                              'history' =>$request->history,
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

            
         m_kode::where('history_id',$request->id)->delete();

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

