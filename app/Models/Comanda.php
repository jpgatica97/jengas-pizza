<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'estado',
        'rut_encargado',
        'id_venta'

    ];

    public function cocinero()
    { //relacion con id personalizada;
        return $this->hasOne(User::class, 'rut_encargado');
    }


    public function venta()
    { //relacion con id personalizada;
        return $this->hasOne(Venta::class, 'id_venta');
    }
}
