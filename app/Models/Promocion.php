<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;
    protected $table = "promociones";
    protected $primaryKey = "codigo";
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria',
        'visible'

    ];
    public function productos()
    { //relacion con id personalizada;
        return $this->belongsToMany(Producto::class, 'codigo_prod');
    }
    public function ventas()
    { //relacion con id personalizada;
        return $this->belongsToMany(Venta::class, 'codigo_promocion')->withPivot(['cantidad', 'subtotal']);
    }
    public function carritos()
    {//RElacion muchos a muchos
        return $this->belongsToMany(Carrito::class)->withPivot('cantidad');
    }
}
