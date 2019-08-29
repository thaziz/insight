<?php

namespace App\Modules\master\model;

use Illuminate\Database\Eloquent\Model;

use Yajra\Datatables\Datatables;

class m_group extends Model
{
    protected $table = 'm_group';
    protected $primaryKey = 'g_id';
    const CREATED_AT = 'g_created';
    const UPDATED_AT = 'g_updated';

    protected $fillable = ['g_nama'];

static function datatables(){
	$getdata = m_group::get();
	    return Datatables::of($getdata)
	    			->addIndexColumn()
	    			->addColumn('action', function ($getdata) {
                    return '<center><div class="btn-group btn-group-sm">
                            <button class="btn btn-primary" onclick="edit('.$getdata->g_id.')" rel="tooltip" data-placement="top" data-original-Approve="Edit"><i class="glyphicon glyphicon-check"></i></button>
                            <button class="btn btn-danger" onclick="hapus('.$getdata->g_id.')" rel="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button>
                            <button class="btn btn-success" onclick="detail('.$getdata->g_id.')" rel="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-list"></i></button>';


	                })	                
	                ->rawColumns(['action'])
	    			->make(true);
}


}
