<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Promocion;
use App\Services\CarritoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PromocionCarritoController extends Controller
{
    public $carritoService;

    public function __construct(CarritoService $carritoService)
    {
        $this->carritoService = $carritoService;
    }

    //Funcion que almacena promociones al carrito
    public function store(Request $request, Promocion $promocion)
    {
        //Busca un carrito existente en las cookies
        $carrito = $this->carritoService->getFromCookieOrCreate();

        //Rescata la cantidad de promos, si no hay promo en el carrito se asigna cantidad 0
        $cantidad = $carrito->promociones()->find($promocion->codigo)->pivot->cantidad ?? 0;

        //Inserta las promos y su cantidad en el carrito
        $carrito->promociones()->syncWithoutDetaching([$promocion->codigo => ['cantidad' => $cantidad + 1], ]);

        //Crea una cookie del carrito con duracion de 1 semana
        $cookie = cookie()->make('carrito', $carrito->id, 7 * 24 * 60);

        return redirect()->back()->cookie($cookie);
    }

    //Funcion que elimina promos del carrito
    public function destroy(Promocion $promocion, Carrito $carrito)
    {
        $carrito->promociones()->detach($promocion->codigo);

        $cookie = $this->carritoService->makeCookie($carrito);

        return redirect()->back()->cookie($cookie);
    }

}
