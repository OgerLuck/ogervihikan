<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User as Users;
use Session;

class Signin extends Controller{
    
    public function index(){
    	if (Session::get('USER_ID')==1){
			return redirect()->route('ViewAdmin');
    	} else{
    		return view('signin');
    	}
    }

    public function signin(Request $request){
    	$user = Users::where('username', $request->email)
    				->where('password', $request->password)->first();
    	if (!empty($user)){
    		$userID = $user->ID;
    		if ($userID==1){
    			Session::put('USER_ID', $userID);
    			return redirect()->route('ViewAdmin');
    		} else{
    			//User lain.
    		}
    	} else{
    		return redirect()->route('ViewSignin');
    		//return view('signin');
    	} 
    }

    public function signout(){
    	Session::forget('USER_ID');
    	return redirect()->route('ViewSignin');
    }
}