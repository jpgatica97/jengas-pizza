<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    public function promociones()
    {
        return $this->belongsToMany(Promocion::class)->withPivot('cantidad');
    }

    public function getTotalAttribute()
    {
        return $this->promociones->pluck('total')->sum();
    }
}
