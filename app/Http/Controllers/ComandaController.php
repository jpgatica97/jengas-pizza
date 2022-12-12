<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComandaFinalizarRequest;
use App\Http\Requests\ComandaRequest;
use App\Models\Comanda;
use App\Models\PromocionesVentas;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComandaController extends Controller
{
    //Configura la autenticación para acceder a este módulo
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Muestra las comandas a preparar
    public function index(){
        return view('plataforma.comandas.index')->with([
            'comandas' => DB::table('comandas')->where('estado', 'en espera')->get(),
        ]);

    }


    //Función que muestra los detalles de una comanda
    public function show(Comanda $comanda){
        $ventas = Venta::where("id", $comanda->id_venta)->get();
        $productos = PromocionesVentas::where("id_venta", $comanda->id_venta)->get();
        return view('plataforma.comandas.show')->with([
            'comanda'=> $comanda, 'productos' =>$productos,
        ]);
    }


    //Función que actualiza el estado de la comanda
    public function update(ComandaFinalizarRequest $request, Comanda $comanda){

        $comanda->update($request->validated());
        return redirect()->route('plataforma.comandas.index')->with('finalizado', 'ok');
    }


}
