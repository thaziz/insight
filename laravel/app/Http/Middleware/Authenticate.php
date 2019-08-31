<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Redirect;

use Request;

Use Session;

use URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */    
    protected function redirectTo($request)
    {   
        // return route('login');
        // return redirect('login?safe=strict');
        /*$url=Request::getPathInfo(); */
        
        
        /*if($url=='/logout'){
            $url='/thoriq';
        }*/
        
        
        /*Session::flush();*/
        /*Session::put('url_login',$url);       */
          
        /*$this->redirectTo = '?url='.$url;*/
        return '/';
        
    }
}
