<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Services\CarritoService;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public $carritoService;

    public function __construct(CarritoService $carritoService)
    {
        $this->carritoService = $carritoService;
    }

    public function index()
    {
        $carrito = $this->carritoService->getFromCookie();
        return view('inicio.carrito')->with([
            'carrito' => $carrito,
        ]);
    }


}
