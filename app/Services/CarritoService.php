<?php
namespace App\Services;

use App\Models\Carrito;
use Illuminate\Support\Facades\Cookie;

class CarritoService{
    //Funcion que revisa si hay una cookie del carrito en el navegador del usuario
    public function getFromCookie()
    {
        //busca el id de un carrito existente
        $idCarrito = Cookie::get('carrito');
        $carrito = Carrito::find($idCarrito);

        return $carrito ;
    }
    public function getFromCookieOrCreate()
    {

        $carrito = $this->getFromCookie();

        //Si no encuentra el carrito en las cookies, se crea uno
        return $carrito ?? Carrito::create();
    }

    public function makeCookie(Carrito $carrito){
        return Cookie::make('carrito', $carrito->id, 7 * 24 * 60);
    }

    public function contarPromos(){
        $carrito = $this->getFromCookie();
        if($carrito != null){
            return $carrito->promociones->pluck('pivot.cantidad')->sum();
        }
        return 0;
    }
}

?>
