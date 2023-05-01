<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLogout extends Controller
{
    function logout(){
        
            Session::flush();
            
            Auth::logout();
    
            return redirect('/');
        
    }
}
