<?php

namespace App\Modules\master\model;

use Illuminate\Database\Eloquent\Model;

use Yajra\Datatables\Datatables;

use DB;

class m_kode extends Model
{
    protected $table = 'm_kode';
    protected $primaryKey = 'kode_id';
    const CREATED_AT = 'kode_created';
    const UPDATED_AT = 'kode_updated';

    protected $fillable = ['masa_berlaku','jumlah_main','kode','group'];
static function chekKode($kode){
        return DB::select(DB::raw('SELECT  m_kode.`group`,m_kode.`group_dt`,time_to_sec(TIMEDIFF(TIME_FORMAT(concat(masa_berlaku,":00:00"),"%H:%i:%s"),TIMEDIFF(NOW(),kode_created))) as total FROM m_kode WHERE kode=?
        AND TIMEDIFF(NOW(),kode_created)<=TIME_FORMAT(concat(masa_berlaku,":00:00"),"%H:%i:%s")
        AND COALESCE(main,0) <jumlah_main
        '),[$kode]);
}
static function datatables(){
	$getdata = m_kode::join('m_group','g_id','=','group')->get();
	    return Datatables::of($getdata)
	    			->addIndexColumn()
	    			->addColumn('action', function ($getdata) {
                    return '<center><div class="btn-group btn-group-sm">
                            <button class="btn btn-primary" onclick="edit('.$getdata->kode_id.')" rel="tooltip" data-placement="top" data-original-Approve="Edit"><i class="glyphicon glyphicon-check"></i></button>
                            <button class="btn btn-danger" onclick="hapus('.$getdata->kode_id.')" rel="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash-o"></i></button>';


	                })	                
	                ->rawColumns(['action'])
	    			->make(true);
}


}
