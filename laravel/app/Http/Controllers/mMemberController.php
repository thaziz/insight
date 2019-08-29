<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Pengguna;
use App\d_access;
use Validator;
use DB;
use Session;
use Carbon\Carbon;

class mMemberController extends Controller {

    
    public function logout() {        
        $user = Pengguna::find(Auth::user()->m_id);                
        Session::flush();  
        Auth::logout();
        return Redirect('/');
    }



}
