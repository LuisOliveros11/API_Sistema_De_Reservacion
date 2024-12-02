<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, Notifiable;
    protected $table = "usuario";
    protected $fillable = [
        "nombre",
        "apellidos",
        "correo_electronico",
        "contrasena",
        "fecha_registro",
        "rol"
    ];
}
