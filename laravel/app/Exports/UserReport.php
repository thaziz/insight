<?php

namespace App\Exports;

use App\Pengguna as User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use App\Modules\master\model\m_inspeksi;

class UserReport implements FromView
{
     use Exportable;

      public function __construct(int $id,string $from,string $to)
    {

        $this->id = $id;                
        $this->from = $from;        
        $this->to = $to;        

    }
    
    public function view(): View
    {

    	$data=$this->excel($this->id,$this->from,$this->to);

        return view('master::report.print', [
            'users' => $data
        ]);
    }


    function excel($id,$from,$to){     	   	    	    	

    	$nama=m_inspeksi::join('m_inspeksi_dt','i_id','=','idt_inspeksi')
    		  ->where('i_unit',$id)->select('idt_nama',DB::raw('sum(idt_ada) As qty'))->groupBy('idt_nama')
    		  ->whereBetween('i_tgl', [$from, $to])->get();

    	$date=m_inspeksi::join('m_inspeksi_dt','i_id','=','idt_inspeksi')
    		  ->where('i_unit',$id)
    		  ->select(DB::raw('CONCAT(i_triwulan," ", i_tgl) AS tgl'),'i_tgl','i_triwulan')
    		  ->groupBy('i_tgl','i_triwulan')->whereBetween('i_tgl', [$from, $to])->get();
    		  


    	foreach ($nama as $key => $n) {
    			foreach ($date as  $tgl) {         
    			/*dd($this->cari($request->id,$n->idt_nama,$tgl->i_triwulan,$tgl->i_tgl));*/
    			$nama[$key][$tgl->tgl]	=$this->cariPDF($id,$n->idt_nama,$tgl->i_triwulan,$tgl->i_tgl);
    			
    			}
    	}

    	

    	$data=['nama'=>$nama,'date'=>$date];
    	return $data;
    }



    function cariPDF($unit,$nama,$tri,$tgl){
    	
    	$date=m_inspeksi::join('m_inspeksi_dt','i_id','=','idt_inspeksi')
    		  ->where('i_unit',$unit)
    		  ->where('idt_nama',$nama)
    		  ->where('i_triwulan',$tri)
    		  ->where('i_tgl',$tgl)
    		  /*->select('idt_ada','idt_rusak','idt_tidak','idt_presentase','i_ket')*/
    		  ->select(DB::raw('CONCAT("<td>",idt_ada,"</td>", "<td>", idt_tidak,"</td>","<td>", idt_rusak,"</td><td>",idt_presentase,"</td><td>",idt_ket,"</td>") AS tgl'))
    		  ->groupBy('i_tgl','i_triwulan')->first();
    	   if($date){
                return $date->tgl;  
            }else{
                return '-';
            }
    }
}