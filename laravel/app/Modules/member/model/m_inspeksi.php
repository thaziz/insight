<?php

namespace App\Modules\master\model;

use Illuminate\Database\Eloquent\Model;

use Yajra\Datatables\Datatables;

class m_inspeksi extends Model
{
    protected $table = 'm_inspeksi';
    protected $primaryKey = 'i_id';
    const CREATED_AT = 'i_created';
    const UPDATED_AT = 'i_updated';

            
    protected $fillable = ['i_id','i_contract','i_tgl','i_triwulan','i_tahun','i_presentase','i_unit'];

static function datatables(){
	$getdata = m_inspeksi::Leftjoin('m_contract','c_id','=','i_contract')->leftjoin('m_vendor','v_id','=','c_vendor')
    ->leftjoin('m_unit','u_id','=','c_unit')
    ->get();

	    return Datatables::of($getdata)
	    			->addIndexColumn()
	    			->addColumn('action', function ($getdata) {
                    return '<center><div class="btn-group btn-group-sm">
                            <button class="btn btn-primary" onclick="edit('.$getdata->i_id.')" rel="tooltip" data-placement="top" data-original-Approve="Edit"><i class="glyphicon glyphicon-check"></i></button>

                            <button class="btn btn-success" onclick="detail('.$getdata->i_id.')" rel="tooltip" data-placement="top" data-original-Approve="Edit"><i class="fa fa-list-alt"></i></button>                    
                                    
                            <button class="btn btn-danger" onclick="hapus('.$getdata->i_id.')" rel="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button>';


	                })	                
	                ->rawColumns(['action'])
	    			->make(true);
}


}
