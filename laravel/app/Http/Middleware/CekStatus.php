<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use App\Pengguna;
use Request;

class CekStatus
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
        $url=Request::segment(2); 
        $chekUrl=Request::segment(3); 
        $aksi=$request->aksi;
        if($chekUrl=='tambah' || $chekUrl=='simpan'){
            $aksi='mm_insert';
        }else if($chekUrl=='index' || $chekUrl=='data'){
            $aksi='mm_read';
        }
        
        
        if(Pengguna::punyaAkses($url,$aksi)==false){                                         
                return Redirect('/');
        }
        return $next($request);
    }
}
