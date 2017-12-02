<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Session;

class Admin extends Controller{
    
    public function index(){
    	if (Session::get('USER_ID')==1){
			return view('admin');
    	} else{
    		return redirect()->route('ViewSignin');
    	}
        
    }
}