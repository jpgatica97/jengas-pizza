<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnularVentaRequest;
use App\Http\Requests\ComandaRequest;
use App\Http\Requests\ProductoVentaRequest;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\VentaGuardarRequest;
use App\Http\Requests\VentaRequest;
use App\Models\Comanda;
use App\Models\Promocion;
use App\Models\PromocionesVentas;
use App\Models\User;
use App\Models\Venta;
use App\Services\CarritoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class VentaController extends Controller
{
    public $carritoService;
    //Configura la autenticación para acceder a este módulo
    public function __construct(CarritoService $carritoService)
    {
        $this->middleware('auth')->except(['createO', 'noRegistrado', 'storeO']);
        $this->carritoService = $carritoService;
    }


    //Muestra todos los datos de las ventas presenciales
    public function index()
    {
        return view('plataforma.ventas.index')->with([
            'ventas' => DB::table('ventas')->where('medio_venta', 'presencial')->get(),
            'cocineros' => DB::table('usuarios')->where('rol', 'cocinero')->get(),
        ]);
    }
    //Muestra todos los datos de las ventas online
    public function indexOnline()
    {
        return view('plataforma.ventas.indexOnline')->with([
            'ventas' => DB::table('ventas')->where('medio_venta', 'online')->get(),
            'cocineros' => DB::table('usuarios')->where('rol', 'cocinero')->get(),
        ]);
    }

    //Redirige a la vista que crea una venta presencial
    public function create(Venta $venta)
    {
        return view('plataforma.ventas.create')->with([
            'promociones_venta' => DB::table('promociones_ventas')->where('id_venta', $venta->id)->get(),
            'promociones' => DB::table('promociones')->get(),
            'venta' => $venta,
        ]);
    }

    //Redirige a la vista que crea una venta online
    public function createO()
    {
        $carrito = $this->carritoService->getFromCookie();
        if (!isset($carrito) || $carrito->promociones->isEmpty()) {
            return redirect()->back()->with('carro_vacio', 'error');
        }
        return view('plataforma.ventas.createO')->with(['carrito' => $carrito,]);
    }

    //Redirige a la vista que muestra los pedidos pagados
    public function tomaPedidos()
    {
        return view('plataforma.ventas.tomaPedidos')->with([
            'ventas' => DB::table('ventas')->where('estado', 'pagado')->get(),
        ]);
    }

    //Función que almacena una nueva venta presencial
    public function ventaLocal(){
        $fecha = Carbon::parse(Carbon::now());
        $estado = "creacion";
        $neto = 0;
        $iva = 0;
        $total = 0;
        $observaciones = "-";
        $medio_venta = "presencial";
        $metodo_pago = "-";
        $rut_cliente = Auth::user()->rut;
        $venta = Venta::create([
            'fecha' => $fecha,
            'estado' => $estado,
            'neto' => $neto,
            'iva' => $iva,
            'total' => $total,
            'observaciones' => $observaciones,
            'medio_venta' => $medio_venta,
            'metodo_pago' => $metodo_pago,
            'rut_cliente' =>$rut_cliente,
        ]);
        return redirect()->route('plataforma.ventas.create', ['venta' => $venta->id,]);
    }

    public function store(VentaRequest $request)
    {

        $venta = Venta::create($request->validated());

        return redirect()->route('plataforma.ventas.create', ['venta' => $venta->id,]);
    }
    public function storeO(VentaRequest $request)
    {

        $carrito = $this->carritoService->getFromCookie();

        $venta = Venta::create($request->validated());

        foreach ($carrito->promociones as $promo) {
            DB::table('promociones_ventas')->insert([
                'codigo_promocion' => $promo->codigo,
                'id_venta' => $venta->id,
                'cantidad' => $promo->pivot->cantidad,
                'subtotal' => $promo->pivot->cantidad * $promo->precio,
            ]);
        }

        return redirect()->route('ventasO.webpay', ['venta' => $venta->id,]);
    }

    public function noRegistrado(UsuarioRequest $request)
    {
        $carrito = $this->carritoService->getFromCookie();
        if (!isset(Auth::user()->rut) || Auth::user()->rut == null) {
            $usuario = DB::table('usuarios')->insert([
                'rut' => 'NoReg' . $carrito->id,
                'nombre_completo' => request()->nombre_completo,
                'email' => request()->email,
                'rol' => request()->rol,
                'direccion' => request()->direccion,
                'habilitacion' => request()->habilitacion,
            ]);
        }
        return view('ventasO.create')->with(['carrito' => $carrito, 'usuario' => $usuario, ]);
    }

    //Función que muestra los detalles de una venta
    public function show(Venta $venta)
    {
        $promo_ventas = PromocionesVentas::where("id_venta", $venta->id)->get();
        return view('plataforma.ventas.show')->with([
            'venta' => $venta, 'promo_ventas' => PromocionesVentas::all(), 'promociones' => Promocion::all(),

        ]);
    }
    //Función que anula una venta
    public function anular(AnularVentaRequest $request, Venta $venta)
    {
        $venta->update($request->validated());
        return redirect()->route('plataforma.ventas.index');
    }
    //Función que toma un pedido para enviarlo a comanda
    public function tomar(ComandaRequest $request, Venta $venta)
    {
        $venta->update($request->validated());
        $comanda = Comanda::create($request->validated());
        return redirect()->route('plataforma.ventas.indexOnline');
    }
    //Función que actualiza los valores de una venta y los almacena
    public function guardar(VentaGuardarRequest $request, Venta $venta)
    {

        $neto = $venta->total - ($venta->total * 0.19);
        $iva = ($venta->total * 0.19);

        $total = $neto + $iva;
        $venta_g = Venta::where("id", $venta->id)->update(["neto" => $neto, "iva" => $iva, "total" => $total, "metodo_pago" => $request->metodo_pago, "estado" => $request->estado]);

        return redirect()->route('plataforma.ventas.show', [
            'venta' => $venta->id
        ]);
    }
    //Funcion que inserta una promo a la venta
    public function insertarPromo(ProductoVentaRequest $request)
    {
        $promos = Promocion::all();

        foreach ($promos as $promo) {
            if ($request->codigo_promocion == $promo->codigo) {
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
        foreach ($pv as $p) {
            if ($p->id_venta == $promo_venta->id_venta) {
                $total = $total + $p->subtotal;
            }
        }
        $iva = ($total) * 0.19;
        $neto = $total - $iva;
        $venta = Venta::where("id", $promo_venta->id_venta)->update(["neto" => $neto, "iva" => $iva, "total" => $total]);

        return redirect()->route('plataforma.ventas.create', [
            'venta' => $promo_venta->id_venta,
        ]);
    }
    public function eliminarP(PromocionesVentas $promo_venta)
    {

        $id = $promo_venta->id_venta;
        $promo_venta->delete();
        $total = 0;
        $pv = PromocionesVentas::all();
        foreach ($pv as $p) {
            if ($p->id_venta == $promo_venta->id_venta) {
                $total = $total + $p->subtotal;
            }
        }
        $iva = ($total) * 0.19;
        $neto = $total - $iva;
        $venta = Venta::where("id", $promo_venta->id_venta)->update(["neto" => $neto, "iva" => $iva, "total" => $total]);


        return redirect()->route('plataforma.ventas.create', [
            'venta' => $id,
        ]);
    }
    public function destroy(Venta $venta)
    {
        $pv = PromocionesVentas::all();
        foreach ($pv as $p) {
            if ($p->id_venta == $venta->id) {
                $p->delete();
            }
        }
        $venta->delete();
        return redirect()->route('plataforma.ventas.index');
    }
    public function Boleta(Venta $venta)
    {
        $promos = PromocionesVentas::where("id_venta", $venta->id);
        $promociones = Promocion::all();
        $data = ['ventas' => $venta, 'promos' => $promos , 'promociones' => $promociones];

        $pdf = Pdf::loadView('plataforma.boleta.export', $data);
        return $pdf->download('Boleta.pdf');
    }
    public function webpay(Venta $venta)
    {
        $carrito = $this->carritoService->getFromCookie();
        return view('inicio.webpayFalso')->with([
            'venta' => $venta,
        ]);
    }
    public function confirmacion(Venta $venta)
    {
        $venta = Venta::where("id", $venta->id)->update(["estado"=> "pagado"]);
        return view('inicio.confirmar')->with([
            'venta' => $venta,
        ]);
        cookie()->delete();
    }
    public function reporteMensual(Request $request){
        $ventas = Venta::join("promociones_ventas", "ventas.id","=", "promociones_ventas.id_venta")->whereMonth('ventas.fecha', request()->mes)->whereYear('ventas.fecha', request()->anio)->get();
        $mes = request()->mes;
        $anio = request()->anio;
        //dd($ventas);
        //$data = ['ventas' => $ventas, 'mes' => $mes , 'anio' => $anio];
        $data = ['mes' => $mes , 'anio' => $anio];
        $pdf = Pdf::loadView('plataforma.pdf.reporteM', $data);
        return $pdf->download('Reporte_mensual_'.$mes.'-'.$anio.'.pdf');
    }
    public function reporteDiario(Request $request){

    }

}
