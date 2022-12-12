<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioHabilitarRequest;
use App\Http\Requests\UsuarioRequest;
use App\Models\Producto;
use App\Models\User;
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
        if (Auth::user()->rol == 'cliente') {
            return view('inicio.inicio')->with([
                'promociones' => DB::table('promociones')->get(),
            ]);
        } else {
            return view('plataforma.inicio');
        }

    }

    public function inicio()
    {
        return view('inicio.inicio')->with([
            'promociones' => DB::table('promociones')->get(),
        ]);

    }

    public function empleados()
    {
        return view('plataforma.usuarios.index')->with([
            'usuarios' => DB::table('usuarios')->get(),
        ]);

    }

    public function edit(User $usuario)
    {

        return view('plataforma.usuarios.edit')->with([
            'usuario' => $usuario,
        ]);
    }

    public function update(UsuarioRequest $request, User $usuario)
    {
        $user = DB::table('usuarios')->where('rut', $usuario->rut)->update(['nombre_completo' => $usuario->nombre_completo], ['email' =>$usuario->email], ['rol' => $usuario->rol], ['direccion'=>$usuario->direccion], ['habilitacion' => $usuario->habilitacion ]);
        return redirect()->route('plataforma.usuarios.index')->with('actualizacion', 'ok');
    }
    public function show(User $usuario){

        return view('plataforma.usuarios.show')->with([
            'usuario'=> $usuario,
        ]);
    }
    public function habilitaciones()
    {
        return view('plataforma.usuarios.habilitaciones')->with([
            'usuarios' => DB::table('usuarios')->get(),
        ]);

    }
    public function habilitar(UsuarioHabilitarRequest $request, User $usuario){

        $usuario->update($request->validated());
        return redirect()->route('plataforma.usuarios.habilitaciones')->with('habilitacion', 'ok');
    }

    public function deshabilitar(UsuarioHabilitarRequest $request, User $usuario){

        $usuario->update($request->validated());
        return redirect()->route('plataforma.usuarios.habilitaciones')->with('deshabilitacion', 'ok');
    }
}
