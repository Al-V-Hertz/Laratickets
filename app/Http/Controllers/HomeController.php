<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(Auth::user()->user_type == 'client'){
            return redirect('client');
            // return view('client');
        }
        else if(Auth::user()->user_type == 'admin'){
            return redirect('admin');
            // return view('admin');
        }
        // return view('/home');
    }
}
