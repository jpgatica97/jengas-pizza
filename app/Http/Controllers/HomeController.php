<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioHabilitarRequest;
use App\Http\Requests\UsuarioRequest;
use App\Models\Producto;
use App\Models\ProductosPromociones;
use App\Models\Promocion;
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
        //revisa si hay productos con 1 de stock, en caso de que existan,
        //los ocultan las promociones que utilizan ese producto
        $prod = Producto::where('stock', '<=', 1)->get();
        foreach($prod as $pro){
            $pps = ProductosPromociones::where('codigo_producto',$pro->codigo)->get();
            foreach($pps as $pp){
                DB::update("update promociones set visible = 'invisible' where codigo = ".$pp->codigo_promocion);
            }
        }
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

        $cantProdVentas = DB::table('ventas as a')
        ->join('promociones_ventas as b', 'b.id_venta', '=', 'a.id')
        ->join('promociones as c', 'b.codigo_promocion', '=', 'c.codigo')
        ->where('a.estado', '=', 'finalizado')
        ->whereYear('a.fecha', $anio)
        ->whereMonth('a.fecha', $mes)->select('c.nombre')
        ->selectRaw('count(c.nombre) as veces')->groupBy('c.nombre')->orderByDesc('veces')->take('5')
        ->get();
        $prod = Producto::where('stock', '<=', 1)->get();
        $deshabilitaciones = false;
        foreach($prod as $pro){
            $deshabilitaciones = true;
        }
        $promo = Promocion::where('visible', 'invisible')->get();
        $invisibles = false;
        foreach($promo as $pro){
            $invisibles = true;
        }

        //dd($cantProdVentas);
    if(Auth::user()->habilitacion == 'deshabilitado'){
        return view('inicio.inicio')->with([
            'promociones' => Promocion::where('visible', 'visible')->get(),
            'habilitacion' => 'deshabilitado',
        ]);

    }else if (Auth::user()->rol == 'cliente') {
            return view('inicio.inicio')->with([
                'promociones' => Promocion::where('visible', 'visible')->get(),
            ]);

    }else{
            return view('plataforma.inicio')->with([
                'cantVentasMes' => $cantVentasMes, 'cantOnline' => $cantOnline, 'cantPresencial' => $cantPresencial,
                'montoVentasMes' => $montoVentasMes, 'cantVentasMesOnline' => $cantVentasMesOnline, 'cantVentasMesPresencial' => $cantVentasMesPresencial,
                'cantProdVentas' => $cantProdVentas, 'deshabilitaciones' => $deshabilitaciones, 'invisibles' => $invisibles,
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
        $user = DB::table('usuarios')->where('rut', $usuario->rut)->update(['nombre_completo' => request()->nombre_completo], ['email' =>request()->email], ['rol' => request()->rol], ['telefono'=>request()->telefono],['direccion'=>request()->direccion], ['habilitacion' => request()->habilitacion]);
        dd($usuario);
        return redirect()->back()->with('actualizacion', 'ok');

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
