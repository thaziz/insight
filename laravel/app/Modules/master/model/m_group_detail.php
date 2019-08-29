<?php

namespace App\Modules\master\model;

use Illuminate\Database\Eloquent\Model;

use Yajra\Datatables\Datatables;

class m_group_detail extends Model
{
    protected $table = 'm_group_detail';
    protected $primaryKey = 'gd_group';
    public $timestamps=false;
    protected $fillable = ['gd_group','gd_detailid','gd_nama'];

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
