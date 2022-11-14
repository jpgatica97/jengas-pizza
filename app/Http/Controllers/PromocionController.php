<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromocionRequest;
use App\Models\Promocion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromocionController extends Controller
{
    //Configura la autenticación para acceder a este módulo
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Muestra todos los datos de las promociones
    public function index(){
        return view('plataforma.promociones.index')->with([
            'promociones' => DB::table('promociones')->get(),
        ]);

    }

    //Redirige a la vista que crea una promo
    public function create(){
        return view('plataforma.promociones.create');
    }

    //Función que almacena una nuevo promo
    public function store(PromocionRequest $request){

        $promocion = Promocion::create($request->validated());

        return redirect()->route('plataforma.promociones.index')->withSuccess('La promocion: '.$promocion->nombre.' fué agregado exitosamente');
    }

    //Función que muestra los detalles de una promo
    public function show(Promocion $promocion){

        return view('plataforma.promociones.show')->with([
            'promocion'=> $promocion,

        ]);
    }

    //Función que muestra la vista para editar una promo
    public function edit(Promocion $promocion){

        return view('plataforma.promociones.edit')->with([
            'promocion'=> $promocion,
        ]);
    }

    //Función que actualiza una promo existente
    public function update(PromocionRequest $request, Promocion $promocion){

        $promocion->update(/*request()->all()*/$request->validated());
        return redirect()->route('plataforma.promociones.index')->withSuccess('ELa promoción: '.$promocion->nombre.' fué actualizado exitosamente');
    }

    //Función que elimina una promo
    public function destroy(Promocion $promocion){
        $promocion->delete();
        return redirect()->route('plataforma.promocion.index')->withSuccess('La promocion '.$promocion->nombre.' fué eliminado exitosamente');
    }
}
