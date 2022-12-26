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
    public function producto()
    {
        return $this->belongsToMany(Producto::class)->withPivot('cantidad');
    }
    public function promocion()
    {
        return $this->belongsToMany(Promocion::class)->withPivot('cantidad');
    }
}
