<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('inicio');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->rol == 'cliente'){
            return view('inicio.inicio')->with([
                'promociones' => DB::table('promociones')->get(),
            ]);
        }else{
            return view('plataforma.inicio');
        }

    }
    public function inicio(){
        return view('inicio.inicio')->with([
            'promociones' => DB::table('promociones')->get(),
        ]);

    }
}
