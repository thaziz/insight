<?php

namespace App\Modules\master\model;

use Illuminate\Database\Eloquent\Model;

use Yajra\Datatables\Datatables;

class m_contract extends Model
{
    protected $table = 'm_contract';
    protected $primaryKey = 'c_id';
    const CREATED_AT = 'c_created';
    const UPDATED_AT = 'c_updated';

            
    protected $fillable = ['c_id','c_unit','c_vendor','c_pekerjaan','c_nomor_kontrak','c_tgl_kontrak','c_durasi_kontrak' ];

static function datatables(){
	$getdata = m_contract::join('m_unit','u_id','=','c_unit')->join('m_vendor','v_id','=','c_vendor')->get();
    
	    return Datatables::of($getdata)
	    			->addIndexColumn()
	    			->addColumn('action', function ($getdata) {
                    return '<center><div class="btn-group btn-group-sm">
                            <button class="btn btn-primary" onclick="edit('.$getdata->c_id.')" rel="tooltip" data-placement="top" data-original-Approve="Edit"><i class="glyphicon glyphicon-check"></i></button>

                            <button class="btn btn-success" onclick="detail('.$getdata->c_id.')" rel="tooltip" data-placement="top" data-original-Approve="Edit"><i class="fa fa-list-alt"></i></button>                    
                                    
                            <button class="btn btn-danger" onclick="hapus('.$getdata->c_id.')" rel="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button>';


	                })	                
	                ->rawColumns(['action'])
	    			->make(true);
}


}
