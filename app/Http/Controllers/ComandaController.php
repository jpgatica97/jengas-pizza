<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComandaFinalizarRequest;
use App\Http\Requests\ComandaRequest;
use App\Models\Comanda;
use App\Models\ProductosPromociones;
use App\Models\Promocion;
use App\Models\PromocionesVentas;
use App\Models\Reparto;
use App\Models\User;
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

    public function tomar()
    {
        $ventas = Venta::where('estado', 'pagado')->get();
        return view('plataforma.comandas.tomaPedidos')->with([
            'ventas' => $ventas,
        ]);

    }
    //Muestra las comandas a preparar
    public function index(){
        return view('plataforma.comandas.index')->with([
            'comandas' => Comanda::where('estado', 'pendiente')->get(),
            'cocineros' => User::where('rol', 'cocinero')->get(),
        ]);

    }
    public function store(ComandaRequest $request)
    {

        $comanda = Comanda::create($request->validated());
        $venta = Venta::where("id", request()->id_venta)->update(["estado"=> "en comanda"]);
        $promosV = PromocionesVentas::where('id_venta', request()->id_venta)->get();
        foreach($promosV as $pv){
            $pps = ProductosPromociones::where('codigo_promocion', $pv->codigo_promocion)->get();
            foreach($pps as $pp){
                DB::update('update productos set stock = stock -'.$pp->cantidad.' where codigo = '.$pp->codigo_producto);
            }
        }
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
        //Venta a revisar
        $ventaRevisar = Venta::where("id", $comanda->id_venta)->get();
        //dd($ventaRevisar);
        if($ventaRevisar[0]->medio_venta == "online"){
            $venta = Venta::where("id", $comanda->id_venta)->update(["estado"=> "preparado"]);
            //$reparto = Reparto::create($request->validated());
            //$venta = Venta::where("id", request()->id_venta)->update(["estado"=> "en reparto"]);
        }else{
            $venta = Venta::where("id", request()->id_venta)->update(["estado"=> "finalizado"]);
        }
        $comanda->update($request->validated());
        return redirect()->route('plataforma.comandas.index')->with('finalizado', 'ok');
    }
    public function rechazar(ComandaFinalizarRequest $request, Comanda $comanda){
        $venta = Venta::where("id", $comanda->id_venta)->update(["estado"=> "rechazado comanda"]);
        $comanda->update($request->validated());
        return redirect()->route('plataforma.comandas.index')->with('rechazado', 'ok');
    }


}
