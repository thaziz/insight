<?php




namespace App\Modules\master\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengguna;
use DB;
use Auth;
use Carbon\Carbon;
use App\Modules\master\model\m_kategori;
use Yajra\Datatables\Datatables;


class kategoriBarangController extends Controller
{
    function index(){    	
    	return view('master::kategori.index');
    }
    function data(){
	    $getdata = m_kategori::get();
	    return Datatables::of($getdata)
	    			->addIndexColumn()
	    			->addColumn('action', function ($getdata) {
	                    return'<a onclick=edit("'.$getdata->k_id.'") class="btn btn-primary btn-bitbucket btn-xs" type="button"><i class="fa fa-check"></i></a>';


	                })
	                ->editColumn('k_status', function ($getdata) {
	                	if($getdata->k_status=='Y'){
	                		return '<span class="pull-right label label-primary">Aktif</span>';
	                	}else{
	                		return '<span class="pull-right label label-warning">Tidak Aktif</span>';
	                	}
	                    


	                })
	                ->rawColumns(['k_status','action'])
	    			->make(true);
    }
    function tambah(){
    	return view('master::kategori.tambah');
    }
    function simpan(Request $req){
    	DB::beginTransaction();
        try {        	
    	m_kategori::create([
    						'k_name' =>$req->k_name,
    						'k_created'=>date('Y-m-d')
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
}

