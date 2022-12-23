<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioHabilitarRequest;
use App\Http\Requests\UsuarioRequest;
use App\Models\Producto;
use App\Models\User;
use Carbon\Carbon;
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
        $fecha = Carbon::parse(Carbon::now())->format('Y-m-d');
        $mes = Carbon::parse($fecha)->format('m');
        $anio = Carbon::parse($fecha)->format('Y');

        $cantVentasMes = DB::table('ventas')
        ->selectRaw("DATE_FORMAT(fecha, '%d-%m-%Y') as dia")
        ->selectRaw("count(DATE_FORMAT(fecha, '%d-%m-%Y')) as veces")
        ->where('estado', '=', 'finalizado')
        ->whereMonth('fecha', $mes)
        ->whereYear('fecha', $anio)
        ->groupBy("dia")
        ->get();

        $cantVentasMesOnline = DB::table('ventas')
        ->selectRaw("DATE_FORMAT(fecha, '%d-%m-%Y') as dia")
        ->selectRaw("count(DATE_FORMAT(fecha, '%d-%m-%Y')) as veces")
        ->where('estado', '=', 'finalizado')
        ->where('medio_venta', '=', 'online')
        ->whereMonth('fecha', $mes)
        ->whereYear('fecha', $anio)
        ->groupBy("dia")
        ->get();

        $cantVentasMesPresencial = DB::table('ventas')
        ->selectRaw("DATE_FORMAT(fecha, '%d-%m-%Y') as dia")
        ->selectRaw("count(DATE_FORMAT(fecha, '%d-%m-%Y')) as veces")
        ->where('estado', '=', 'finalizado')
        ->where('medio_venta', '=', 'presencial')
        ->whereMonth('fecha', $mes)
        ->whereYear('fecha', $anio)
        ->groupBy("dia")
        ->get();

        $montoVentasMes = DB::table('ventas')
        ->where('estado', '=', 'finalizado')
        ->whereMonth('fecha', $mes)
        ->whereYear('fecha', $anio)
        ->selectRaw("DATE_FORMAT(fecha, '%d-%m-%Y') as dia")
        ->selectRaw("sum(total) as total")->groupBy("dia")
        ->get();

        $cantPresencial = DB::table('ventas')
        ->where('estado', '=', 'finalizado')
        ->where('medio_venta', '=', 'presencial')
        ->whereMonth('fecha', $mes)
        ->whereYear('fecha', $anio)
        ->selectRaw('count(medio_venta) as veces')->groupBy('medio_venta')
        ->get();

        $cantOnline = DB::table('ventas')
        ->where('estado', '=', 'finalizado')
        ->where('medio_venta', '=', 'online')
        ->whereMonth('fecha', $mes)
        ->whereYear('fecha', $anio)
        ->selectRaw('count(id) as veces')->groupBy('medio_venta')
        ->get();

        //dd($cantVentasMesOnline);
        if (Auth::user()->rol == 'cliente') {
            return view('inicio.inicio')->with([
                'promociones' => DB::table('promociones')->get(),
            ]);
        } else {
            return view('plataforma.inicio')->with([
                'cantVentasMes' => $cantVentasMes, 'cantOnline' => $cantOnline, 'cantPresencial' => $cantPresencial,
                'montoVentasMes' => $montoVentasMes, 'cantVentasMesOnline' => $cantVentasMesOnline, 'cantVentasMesPresencial' => $cantVentasMesPresencial,

            ]);
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
        if (Auth::user()->rol == 'cliente') {
            return view('inicio.inicio')->with([
                'promociones' => DB::table('promociones')->get(),
            ]);
        }
        return view('plataforma.usuarios.index')->with([
            'usuarios' => DB::table('usuarios')->get(),
        ]);

    }

    public function edit(User $usuario)
    {
        if (Auth::user()->rol == 'cliente') {
            return view('inicio.inicio')->with([
                'promociones' => DB::table('promociones')->get(),
            ]);
        }
        return view('plataforma.usuarios.edit')->with([
            'usuario' => $usuario,
        ]);
    }

    public function update(UsuarioRequest $request, User $usuario)
    {
        if (Auth::user()->rol == 'cliente') {
            return view('inicio.inicio')->with([
                'promociones' => DB::table('promociones')->get(),
            ]);
        }
        $user = DB::table('usuarios')->where('rut', $usuario->rut)->update(['nombre_completo' => request()->nombre_completo], ['email' =>request()->email], ['rol' => request()->rol], ['direccion'=>request()->direccion], ['habilitacion' => request()->habilitacion ]);
        return redirect()->route('plataforma.usuarios.index')->with('actualizacion', 'ok');
    }
    public function show(User $usuario){
        if (Auth::user()->rol == 'cliente') {
            return view('inicio.inicio')->with([
                'promociones' => DB::table('promociones')->get(),
            ]);
        }
        return view('plataforma.usuarios.show')->with([
            'usuario'=> $usuario,
        ]);
    }
    public function habilitaciones()
    {
        if (Auth::user()->rol == 'cliente') {
            return view('inicio.inicio')->with([
                'promociones' => DB::table('promociones')->get(),
            ]);
        }
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
