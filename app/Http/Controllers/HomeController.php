<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $roles = Auth::user()->getRoleNames();

        if ( empty($roles) && $roles[0] == 'Cashier')
        {
            return redirect()->to('sale/pos');
        }
        else{
            return view('home');
        }
    }
}
