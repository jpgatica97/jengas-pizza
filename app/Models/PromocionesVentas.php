<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromocionesVentas extends Model
{
    use HasFactory;
    protected $table = "promociones_ventas";
    public $timestamps = false;
    protected $fillable = [
        'codigo_promocion',
        'id_venta',
        'cantidad',
        'subtotal',
    ];
    public function promocion()
    { //relacion con id personalizada;
        return $this->hasOne(Promocion::class, 'codigo_promocion');
    }
    public function venta()
    { //relacion con id personalizada;
        return $this->hasOne(Venta::class, 'id_venta');
    }


}
