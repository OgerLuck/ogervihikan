<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class PetaGempaIndonesia extends Controller{
    
    public function index(){
        return view('indo_map_eq');
    }
}