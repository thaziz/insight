<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 't_id';
    protected $fillable = array('t_id',
								't_kode',
								't_group',
								't_group_dt',);
    
	
    const CREATED_AT = 't_created_at';
    const UPDATED_AT = 't_updated_at';
	

}
