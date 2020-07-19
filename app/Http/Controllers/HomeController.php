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
    {   //if logged in
        if(Auth::check() && Auth::user()->role == "admin") 
        {   //admin user goes to users page to see list of users
            return redirect('/users'); 
        }else
        {   //else not logged in or employee goes to home page
            return view('home');
        }
    }
}
