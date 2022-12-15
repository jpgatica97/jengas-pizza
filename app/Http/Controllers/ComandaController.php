<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComandaFinalizarRequest;
use App\Http\Requests\ComandaRequest;
use App\Models\Comanda;
use App\Models\Promocion;
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
            'comandas' => DB::table('comandas')->where('estado', 'pendiente')->get(),
            'cocineros' => DB::table('usuarios')->where('rol', 'cocinero')->get(),
        ]);

    }
    public function store(ComandaRequest $request)
    {

        $comanda = Comanda::create($request->validated());
        $venta = Venta::where("id", request()->id_venta)->update(["estado"=> "en comanda"]);
        return redirect()->back()->with('comanda', 'ok');
    }

    //Función que muestra los detalles de una comanda
    public function show(Comanda $comanda){
        $ventas = Venta::where("id", $comanda->id_venta)->get();
        $promos = PromocionesVentas::where("id_venta", $comanda->id_venta)->get();
        $promociones = Promocion::all();
        return view('plataforma.comandas.show')->with([
            'comanda'=> $comanda, 'promos' =>$promos, 'promociones' => $promociones,
        ]);
    }


    //Función que actualiza el estado de la comanda
    public function update(ComandaFinalizarRequest $request, Comanda $comanda){
        $venta = Venta::where("id", $comanda->id_venta)->update(["estado"=> "preparado"]);
        $comanda->update($request->validated());
        return redirect()->route('plataforma.comandas.index')->with('finalizado', 'ok');
    }


}
