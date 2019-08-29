<?php

namespace App\Modules\master\model;

use Illuminate\Database\Eloquent\Model;

use Yajra\Datatables\Datatables;

class m_inspeksi_dt extends Model
{
    protected $table = 'm_inspeksi_dt';
    protected $primaryKey = 'idt_detailid';
    public $timestamps=false;

                            
                     
    protected $fillable = [
                            'idt_inspeksi',                             
                            'idt_detailid',                           
                            'idt_nama',                
                            'idt_jumlah',
                            'idt_satuan',
                            'idt_ada',
                            'idt_tidak',
                            'idt_rusak',
                            'idt_ket',
                            'idt_presentase',
                            'idt_foto',
                             ];


}
