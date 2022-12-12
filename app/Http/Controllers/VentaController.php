<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnularVentaRequest;
use App\Http\Requests\ComandaRequest;
use App\Http\Requests\ProductoVentaRequest;
use App\Http\Requests\VentaGuardarRequest;
use App\Http\Requests\VentaRequest;
use App\Models\Comanda;
use App\Models\Promocion;
use App\Models\PromocionesVentas;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class VentaController extends Controller
{
//Configura la autenticación para acceder a este módulo
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Muestra todos los datos de las ventas presenciales
    public function index(){
        return view('plataforma.ventas.index')->with([
            'ventas' => DB::table('ventas')->where('medio_venta', 'presencial')->get(),
        ]);

    }
    //Muestra todos los datos de las ventas online
    public function indexOnline(){
        return view('plataforma.ventas.indexOnline')->with([
            'ventas' => DB::table('ventas')->where('medio_venta', 'online')->get(),
        ]);

    }

    //Redirige a la vista que crea una venta presencial
    public function create(Venta $venta){
        return view('plataforma.ventas.create')->with([
            'promociones_venta' => DB::table('promociones_ventas')->get(),
            'promociones' => DB::table('promociones')->get(),
            'venta' => $venta,
        ]);
    }

    //Redirige a la vista que muestra los pedidos pagados
    public function tomaPedidos(){
        return view('plataforma.ventas.tomaPedidos')->with([
            'ventas' => DB::table('ventas')->where('estado', 'pagado')->get(),
        ]);
    }

    //Función que almacena una nueva venta presencial
    public function store(VentaRequest $request){

        $venta = Venta::create($request->validated());

        return redirect()->route('plataforma.ventas.create', ['venta' => $venta->id, ]);
    }

    //Función que muestra los detalles de una venta
    public function show(Venta $venta){

        $promo_ventas = PromocionesVentas::where("id_venta", $venta->id)->get();
        return view('plataforma.ventas.show')->with([
            'venta'=> $venta, 'promo_ventas' => PromocionesVentas::all(), 'promociones' => Promocion::all(),

        ]);
    }
    //Función que anula una venta
    public function anular(AnularVentaRequest $request,Venta $venta){
        $venta->update($request->validated());
        return redirect()->route('plataforma.ventas.index');
    }
    //Función que toma un pedido para enviarlo a comanda
    public function tomar(ComandaRequest $request,Venta $venta){
        $venta->update($request->validated());
        $comanda = Comanda::create($request->validated());
        return redirect()->route('plataforma.ventas.indexOnline');
    }
    //Función que actualiza los valores de una venta y los almacena
    public function guardar(VentaGuardarRequest $request, Venta $venta){

        $neto = $venta->total- ($venta->total * 0.19);
        $iva = ($venta->total * 0.19);

        $total = $neto + $iva;
        $venta_g = Venta::where("id", $venta->id )->update(["neto" => $neto, "iva" =>$iva, "total"=>$total, "metodo_pago" =>$request->metodo_pago, "estado"=>$request->estado]);

        return redirect()->route('plataforma.ventas.show', [
            'venta' => $venta->id ]);
    }
    public function insertarPromo(ProductoVentaRequest $request){
        $promos = Promocion::all();

        foreach($promos as $promo){
            if($request->codigo_promocion == $promo->codigo){
                $request->subtotal = ($request->cantidad) * ($promo->precio);
            }
        }

        $promo_venta = new PromocionesVentas();
        $promo_venta->id_venta = $request->id_venta;
        $promo_venta->codigo_promocion = $request->codigo_promocion;
        $promo_venta->cantidad = $request->cantidad;
        $promo_venta->subtotal = $request->subtotal;
        $promo_venta->save();

        $total = 0;
        $pv = PromocionesVentas::all();
        foreach($pv as $p){
            if($p->id_cotizacion == $promo_venta->id_venta){
                $total = $total + $p->subtotal;
            }
        }
        $iva = ($total)*0.19;
        $neto = $total - $iva;
        $venta = Venta::where("id", $promo_venta->id_venta )->update(["neto" => $neto, "iva" =>$iva, "total"=>$total]);

        return redirect()->route('plataforma.ventas.create',[
            'venta'=> $promo_venta->id_venta,
        ]);
    }
    public function eliminarP(PromocionesVentas $promo_venta){

        $id = $promo_venta->id_venta;
        $promo_venta->delete();
        $total = 0;
        $pv = PromocionesVentas::all();
        foreach($pv as $p){
            if($p->id_venta == $promo_venta->id_venta){
                $total = $total + $p->subtotal;
            }
        }
        $iva = ($total)*0.19;
        $neto = $total - $iva;
        $venta = Venta::where("id", $promo_venta->id_venta )->update(["neto" => $neto, "iva" =>$iva, "total"=>$total]);


        return redirect()->route('plataforma.ventas.create',[
            'venta'=> $id,
        ]);
    }
    public function destroy(Venta $venta){
        $pv = PromocionesVentas::all();
        foreach($pv as $p){
            if($p->id_venta == $venta->id){
                $p->delete();
            }
        }
        $venta->delete();
        return redirect()->route('plataforma.ventas.index');
    }
    public function Boleta(Venta $venta){
        $promos = PromocionesVentas::where("id_venta", $venta->id);
        $data = ['ventas' => $venta, 'promos' =>$promos];
        //dd($data);
        $pdf = Pdf::loadView('plataforma.ot.export', $data);
     return $pdf->download('Boleta.pdf');
    }
}
