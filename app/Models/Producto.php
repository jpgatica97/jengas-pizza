<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $primaryKey = "codigo";
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'descripcion',
        'stock',
        'precio'

    ];

    public function promociones()
    { //relacion con id personalizada;
        return $this->belongsToMany(Promocion::class, 'codigo_p');
    }
}
