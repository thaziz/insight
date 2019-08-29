<?php

namespace App\Modules\master\model;

use Illuminate\Database\Eloquent\Model;

class m_kategori extends Model
{
    protected $table = 'm_kategori';
    protected $primaryKey = 'k_id';
    const CREATED_AT = 'k_created';
    const UPDATED_AT = 'k_updated';

    protected $fillable = ['k_id','k_name','k_status','k_created'];

}
