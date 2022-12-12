<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'estado',
        'neto',
        'iva',
        'total',
        'observaciones',
        'medio_venta',
        'metodo_pago',
        'rut_cliente'

    ];
    public function cliente()
    { //relacion con id personalizada;
        return $this->belongsTo(User::class, 'rut_cliente');
    }
    public function promociones()
    { //relacion con id personalizada;
        return $this->hasMany(Promocion::class, 'codigo_p');
    }
}
