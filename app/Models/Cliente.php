<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasFactory;
    protected $table = "cliente";
    protected $fillable = [
        "nombre",
        "apellidos",
        "fecha_registro",
        "numero_telefonico",
        "correo_electronico",
        "contrasena"
    ];
}
