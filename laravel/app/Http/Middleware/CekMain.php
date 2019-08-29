<?php

namespace App\Http\Middleware;

use Closure;

use App\Modules\master\model\m_kode;

use Session;

use DB;

class CekMain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

        $kode=Session::get('kode');
        $data=m_kode::chekKode($kode);
        /*$data=DB::select(DB::raw('SELECT TIMEDIFF(TIME_FORMAT(concat(masa_berlaku,":00:00"),"%H:%i:%s"),TIMEDIFF(NOW(),kode_created)) as total FROM m_kode WHERE kode=?
                        AND TIMEDIFF(NOW(),kode_created)<=TIME_FORMAT(concat(masa_berlaku,":00:00"),"%H:%i:%s")
                        '),[$kode]);*/

        if(!$data){                                         
                session()->forget('kode');
                Session::flash('message', 'Kode Sudah Expired / Sudah Digunakan'); 
                return Redirect('kode_user');
        }
        return $next($request);
    }
}
