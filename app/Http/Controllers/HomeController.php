<?php

namespace App\Http\Controllers;

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
        // return view('home');
        // return redirect('/admin-angkatan');
        if (auth()->user()->role == 'admin') {
            # code...
            return redirect('/admin-dashboard');
        }elseif(auth()->user()->role == 'guru') {
            # code...
            return redirect('/home-lms-guru');
        }else {
            # code...
            return redirect('/home-lms');
        }
    }
}
