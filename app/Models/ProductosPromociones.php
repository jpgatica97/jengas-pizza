<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosPromociones extends Model
{
    use HasFactory;
    protected $table = "productos_promociones";
    protected $fillable = [
        'codigo_producto',
        'cantidad',
        'codigo_promocion',
    ];
}
