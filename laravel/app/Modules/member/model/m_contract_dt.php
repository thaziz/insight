<?php

namespace App\Modules\master\model;

use Illuminate\Database\Eloquent\Model;

use Yajra\Datatables\Datatables;

class m_contract_dt extends Model
{
    protected $table = 'm_contract_dt';
    protected $primaryKey = 'cdt_contract';
    public $timestamps=false;
    protected $fillable = ['cdt_contract','cdt_detailid','cdt_nama','cdt_jumlah','cdt_satuan'];

static function datatables(){
	$getdata = m_contract::join('m_unit','u_id','=','c_unit')->join('m_vendor','v_id','=','c_vendor')->get();
	    return Datatables::of($getdata)
	    			->addIndexColumn()
	    			->addColumn('action', function ($getdata) {
                    return '<center><div class="btn-group btn-group-sm">
                            <button class="btn btn-primary" onclick="edit('.$getdata->c_id.')" rel="tooltip" data-placement="top" data-original-Approve="Edit"><i class="glyphicon glyphicon-check"></i></button>   
                            <button class="btn btn-danger" onclick="hapus('.$getdata->c_id.')" rel="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button>';


	                })	                
	                ->rawColumns(['action'])
	    			->make(true);
}


}
