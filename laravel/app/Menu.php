<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'm_menu';
    protected $primaryKey = 'm_id';
    protected $fillable = array('m_id', 'm_name',);
	  public $incrementing = false;



	//public $dateFormat = 'Y-m-d H:i:s+';

}
