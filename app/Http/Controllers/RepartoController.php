<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComandaFinalizarRequest;
use App\Http\Requests\RepartoRequest;
use App\Models\Promocion;
use App\Models\PromocionesVentas;
use App\Models\Reparto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepartoController extends Controller
{
    //Configura la autenticación para acceder a este módulo
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Muestra los repartos
    public function index(){
        return view('plataforma.repartos.index')->with([
            'repartos' => Reparto::all(),
            'clientes' => User::all(),
        ]);

    }
    public function create(){
        return view('plataforma.repartos.create')->with([
            'ventas' => Venta::where('estado', 'preparado')->get(),
            'clientes' => User::all(),
        ]);
    }

    public function tomar(Reparto $reparto){

        return view('plataforma.productos.edit')->with([
            'reparto'=> $reparto,
        ]);
    }
    public function store(RepartoRequest $request)
    {

        $reparto = Reparto::create($request->validated());
        $venta = Venta::where("id", request()->id_venta)->update(["estado"=> "en reparto"]);
        return redirect()->back()->with('reparto', 'ok');
    }

    //Función que muestra los detalles de un reparto
    public function show(Reparto $reparto){
        $ventas = Venta::where("id", $reparto->id_venta)->get();
        $promos = PromocionesVentas::where("id_venta", $reparto->id_venta)->get();
        $clientes = User::where("rol", "cliente")->get();
        $promociones = Promocion::all();
        return view('plataforma.repartos.show')->with([
            'reparto'=> $reparto, 'promos' =>$promos, 'promociones' => $promociones, 'clientes' => $clientes, 'ventas' => $ventas
        ]);
    }


    //Función que actualiza el despacho
    public function update(RepartoRequest $request, Reparto $reparto){

        $reparto->update($request->validated());
        return redirect()->route('plataforma.repartos.index')->with('finalizado', 'ok');
    }
    //Función que actualiza el estado del despacho
    public function finalizar(ComandaFinalizarRequest $request, Reparto $reparto){
        $venta = Venta::where("id", $reparto->id_venta)->update(["estado"=> "finalizado"]);
        $reparto->update($request->validated());
        return redirect()->route('plataforma.repartos.index')->with('finalizado', 'ok');
    }
}
