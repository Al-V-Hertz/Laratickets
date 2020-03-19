<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        if(Auth::user()->user_type!='client')
            return redirect()->route('admin');
        else
            return view('/client');
    }
}
