<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        if(auth::user()->user_type!='admin')
            return redirect()->route('client');
        else
            return view('/admin');
    }
}
