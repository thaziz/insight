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
        
        if(Auth::user()->u_role=='admin'){        		

        		Session::flush();  
        		Auth::logout();        
        		return 'login/admin';	
        }
        else if(Auth::user()->u_role=='member'){        		
        		Session::flush();  
        		Auth::logout();        
        		return '/';	
        }
    }



}
