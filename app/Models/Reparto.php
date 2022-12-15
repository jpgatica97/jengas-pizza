<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'estado',
        'rut_repartidor',
        'id_venta'

    ];
    public function venta()
    { //relacion con id personalizada;
        return $this->hasOne(Venta::class, 'id');
    }
    public function repartidor()
    { //relacion con id personalizada;
        return $this->hasOne(User::class, 'rut_repartidor');
    }
}
