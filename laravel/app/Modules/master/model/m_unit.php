<?php

namespace App\Modules\master\model;

use Illuminate\Database\Eloquent\Model;

use Yajra\Datatables\Datatables;

class m_unit extends Model
{
    protected $table = 'm_unit';
    protected $primaryKey = 'u_id';
    const CREATED_AT = 'u_created';
    const UPDATED_AT = 'u_updated';

    protected $fillable = ['u_id','u_induk','u_nama_unit','u_alamat','u_manager','u_k3'];

static function datatables(){
	$getdata = m_unit::leftjoin('m_induk','i_id','=','u_induk')->get();
	    return Datatables::of($getdata)
	    			->addIndexColumn()
	    			->addColumn('action', function ($getdata) {
                    return '<center><div class="btn-group btn-group-sm">
                            <button class="btn btn-primary" onclick="edit('.$getdata->u_id.')" rel="tooltip" data-placement="top" data-original-Approve="Edit"><i class="glyphicon glyphicon-check"></i></button>
                            <button class="btn btn-danger" onclick="hapus('.$getdata->u_id.')" rel="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button>';


	                })	                
	                ->rawColumns(['action'])
	    			->make(true);
}


}
