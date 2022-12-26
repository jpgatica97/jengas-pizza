<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ProductosPromociones;
use App\Models\Promocion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoPromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function index(Producto $producto)
    {
        $obtenerTotal = DB::table('productos_promociones')
        ->selectRaw('count(codigo_promocion) as total')
        ->groupBy('codigo_promocion')
        ->get();
        //dd($obtenerTotal);
        return view('plataforma.ingredientes.index')->with([
            'promociones' => Promocion::all(),
            'total' => $obtenerTotal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function create(Promocion $promocion)
    {
        return view('plataforma.ingredientes.create')->with([
            'productos' => Producto::all(),
            'promocion' =>Promocion::where('codigo' , $promocion->codigo)->get(),
            'pp' =>ProductosPromociones::where('codigo_promocion', $promocion->codigo)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Promocion $promocion)
    {
        $ppi = ProductosPromociones::insert([
            'codigo_promocion' => $promocion->codigo,
            'cantidad' => request()->cantidad,
            'codigo_producto' => request()->codigo_producto,
        ]);
        $pp = ProductosPromociones::where('codigo_promocion', $promocion->codigo);
        return redirect()->route('plataforma.ingredientes.create', [
            'promocion' => $promocion->codigo,
            'pp' => $pp,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function show(Promocion $promocion)
    {
        return view('plataforma.ingredientes.show')->with([
            'productos' => Producto::all(),
            'promocion' =>Promocion::where('codigo' , $promocion->codigo)->get(),
            'pp' =>ProductosPromociones::where('codigo_promocion', $promocion->codigo)->get(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promocion $promocion, Producto $producto)
    {
        $pp = ProductosPromociones::where('codigo_promocion', $promocion->codigo)->where('codigo_producto', $producto->codigo)->delete();
        return redirect()->back();
    }
}
