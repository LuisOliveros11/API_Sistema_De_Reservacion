<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservacion', function (Blueprint $table) {
            $table->id();
            $table->date("fecha_reservacion");
            $table->integer("id_cliente");
            $table->time("hora_inicio");
            $table->time("hora_final");
            $table->integer("numero_mesa");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservacion');
    }
};
