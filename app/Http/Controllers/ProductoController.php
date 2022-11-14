<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    //Configura la autenticación para acceder a este módulo
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Muestra todos los datos de los productos
    public function index(){
        return view('plataforma.productos.index')->with([
            'productos' => DB::table('productos')->get(),
        ]);

    }

    //Redirige a la vista que crea un producto
    public function create(){
        return view('plataforma.productos.create');
    }

    //Función que almacena un nuevo producto
    public function store(ProductoRequest $request){

        $producto = Producto::create($request->validated());

        return redirect()->route('plataforma.productos.index')->withSuccess('El producto: '.$producto->nombre.' fué agregado exitosamente');
    }

    //Función que muestra los detalles de un producto
    public function show(Producto $producto){

        return view('plataforma.productos.show')->with([
            'producto'=> $producto,
            'html' => "<h2>Subtitle</h2>",
        ]);
    }

    //Función que muestra la vista para editar un producto
    public function edit(Producto $producto){

        return view('plataforma.productos.edit')->with([
            'producto'=> $producto,//Product::findOrFail($product),
        ]);
    }

    //Función que actualiza un producto existente
    public function update(ProductoRequest $request, Producto $producto){

        $producto->update(/*request()->all()*/$request->validated());
        return redirect()->route('plataforma.productos.index')->withSuccess('El producto: '.$producto->nombre.' fué editado exitosamente');
    }

    //Función que elimina un producto
    public function destroy(Producto $producto){
        $producto->delete();
        return redirect()->route('plataforma.productos.index')->withSuccess('El producto '.$producto->nombre.' fué eliminado exitosamente');
    }
}
