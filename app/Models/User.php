<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $table = "usuarios";
    protected $primaryKey = "rut";
    protected $keyType = 'string';
    protected $fillable = [
        'rut',
        'nombre_completo',
        'email',
        'password',
        'direccion',
        'rol',
        'habilitacion'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comandas()
    { //relacion con id personalizada;
        return $this->belongsToMany(Comanda::class, 'rut_encargado');
    }

    public function ventas()
    { //relacion con id personalizada;
        return $this->hasMany(Venta::class, 'rut_cliente');
    }

    public function repartos()
    { //relacion con id personalizada;
        return $this->belongsTo(Reparto::class, 'rut_repartidor');
    }
}
