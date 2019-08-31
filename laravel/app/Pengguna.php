<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;
use Auth;
use Yajra\Datatables\Datatables;

class Pengguna extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

    protected $table = 'user';
    protected $primaryKey = 'u_id';
    public $incrementing = false;
    public $remember_token = false;
    //public $timestamps = false;

    const UPDATED_AT = 'u_update';
    const CREATED_AT = 'u_insert';

    protected $fillable = ['u_id', 'u_member','u_username', 'u_password','u_email','u_hp' ,'u_token', 'u_status','u_role'];


    public function setUpdatedAtAttribute($value) {
        //$this->attributes['a_updated'] = $value;
        // this may not work, depends if it's a Carbon instance, and may also break the above - you may have to clone the instance
        $this->attributes['u_update'] = $value->setTimezone('UTC');
    }

    public function setCreatedAtAttribute($value) {
        
    }

    

    public function access(){
        return $this->belongsToMany('App\d_access', 'd_meu_access', 'ma_member', 'ma_access');
    }


    static function datatables(){
        $getdata = mMember::get();
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


    static function punyaAkses(){
        
        if( Auth::user()->u_role=='admin')
            return true;
        else
            return false;
    }

     static function notif(){        
        return DB::table('notif')->where('n_read','N')->count();
    }

    static function datanotif(){        
        return DB::table('notif')->where('n_read','N')->get();
    }

     static function namaUser($id){        
        return DB::table('member')->select('m_username')->where('m_id',$id)->first()->m_username;
    }

}
