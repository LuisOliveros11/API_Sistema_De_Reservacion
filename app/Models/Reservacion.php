<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;
    protected $table = "reservacion";
    protected $fillable = [
        "fecha_reservacion",
        "id_cliente",
        "hora_inicio",
        "hora_final",
        "numero_mesa"
    ];
}
