<?php

namespace App\Modules\master\model;

use Illuminate\Database\Eloquent\Model;

use Yajra\Datatables\Datatables;

class m_vendor extends Model
{
    protected $table = 'm_vendor';
    protected $primaryKey = 'v_id';
    const CREATED_AT = 'v_created';
    const UPDATED_AT = 'v_updated';

    protected $fillable = ['v_id','v_nama','v_alamat','v_owner','v_hp','v_email','v_manager','v_k3'];

static function datatables(){
	$getdata = m_vendor::get();
	    return Datatables::of($getdata)
	    			->addIndexColumn()
	    			->addColumn('action', function ($getdata) {
                    return '<center><div class="btn-group btn-group-sm">
                            <button class="btn btn-primary" onclick="edit('.$getdata->v_id.')" rel="tooltip" data-placement="top" data-original-Approve="Edit"><i class="glyphicon glyphicon-check"></i></button>
                            <button class="btn btn-danger" onclick="hapus('.$getdata->v_id.')" rel="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button>';


	                })	                
	                ->rawColumns(['action'])
	    			->make(true);
}


}
