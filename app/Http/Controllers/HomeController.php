<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index(Request $request)
    {
        $role = $request->route()->parameter('user'); // Fetch the 'user' parameter from the route
        dd( $role);
        return view('home');
    }
 
    public function adminHome(Request $request)
    {
        $role = $request->route()->parameter('admin'); // Fetch the 'user' parameter from the route
        dd( $role);
        return view('dashboard');
    }
}
