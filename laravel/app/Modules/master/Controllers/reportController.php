<?php
namespace App\Modules\master\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengguna;
use DB;
use Auth;
use Carbon\Carbon;
use App\Modules\master\model\m_inspeksi;
use Yajra\Datatables\Datatables;
use Validator;
use Excel;
use App\Exports\UserReport;



class reportController extends Controller
{
    function index(){     	   	
    	return view('master::report.index');
    }

    function cari($unit,$nama,$tri,$tgl){
    	
    	$date=m_inspeksi::join('m_inspeksi_dt','i_id','=','idt_inspeksi')
    		  ->where('i_unit',$unit)
    		  ->where('idt_nama',$nama)
    		  ->where('i_triwulan',$tri)
    		  ->where('i_tgl',$tgl)
    		  ->select(DB::raw('CONCAT("Sisa ",idt_ada,", ", " Rusak ", idt_rusak,", "," Hilang ", idt_tidak," ", idt_presentase,"%") AS tgl'))
    		  ->groupBy('i_tgl','i_triwulan')->first();
    	if($date){
    	return $date->tgl;	
    }else{
    	return '-';
    }
    	
    }

    function reportTable(Request $request){     
    	$from=date('Y-m-d',strtotime($request->tgl1));
    	$to=date('Y-m-d',strtotime($request->tgl2));

    	$nama=m_inspeksi::join('m_inspeksi_dt','i_id','=','idt_inspeksi')
    		  ->where('i_unit',$request->id)->select('idt_nama',DB::raw('sum(idt_ada) As qty'))->groupBy('idt_nama')->whereBetween('i_tgl', [$from, $to])->get();

    	$date=m_inspeksi::join('m_inspeksi_dt','i_id','=','idt_inspeksi')
    		  ->where('i_unit',$request->id)
    		  ->select(DB::raw('CONCAT(i_triwulan," ", i_tgl) AS tgl'),'i_tgl','i_triwulan')
    		  ->groupBy('i_tgl','i_triwulan')->whereBetween('i_tgl', [$from, $to])->get();
    		  


    	foreach ($nama as $key => $n) {
    			foreach ($date as  $tgl) {         
    			/*dd($this->cari($request->id,$n->idt_nama,$tgl->i_triwulan,$tgl->i_tgl));*/
    			$nama[$key][$tgl->tgl]	=$this->cari($request->id,$n->idt_nama,$tgl->i_triwulan,$tgl->i_tgl);
    			
    			}
    	}

    	

    	return view('master::report.table',compact('nama','date'));
    }
    


    function chart(Request $request){     	   	    	    	
    	$from=date('Y-m-d',strtotime($request->tgl1));
    	$to=date('Y-m-d',strtotime($request->tgl2));
    	$nama=m_inspeksi::where('i_unit',$request->id)->select(DB::raw('CONCAT(i_triwulan," ", i_tgl) AS tgl'),'i_tgl','i_triwulan','i_presentase')->groupBy('i_tgl','i_triwulan')
    	->whereBetween('i_tgl', [$from, $to])->get();
    	$label='';
    	$p='';

    	foreach ($nama as $key => $val) {

    		$label.='"'.$val->tgl.'"'.',';
    		$p.=$val->i_presentase.',';

    	}

    	return view('master::report.chart',compact('label','p'));
    }


	public function laporanExcel(Request $request){     	   	    	    	
		$id=$request->id;
    	$from=date('Y-m-d',strtotime($request->tgl1));
    	$to=date('Y-m-d',strtotime($request->tgl2));    
        return Excel::download(new UserReport($id,$from,$to), 'laporan.xlsx');
    }

    


}

