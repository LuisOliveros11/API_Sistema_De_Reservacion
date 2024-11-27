<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\mesaController;
use App\Http\Controllers\Api\reservacionController;
use App\Http\Controllers\Api\clienteController;

#CRUD MESAS
Route::get("/mesas", [mesaController::class, 'index']);

Route::get("/mesas/{id}", [mesaController::class,"show"]);

Route::post("/mesas", [mesaController::class,"store"]);

Route::put("/mesas/{id}", [mesaController::class,"update"]);

Route::delete("/mesas/{id}", [mesaController::class,"destroy"]);

#CRUD RESERVACIONES

Route::get("/reservaciones", [reservacionController::class, 'index']);

Route::get("/reservaciones/{id}", [reservacionController::class,"show"]);

Route::post("/reservaciones", [reservacionController::class,"store"]);

Route::put("/reservaciones/{id}", [reservacionController::class,"update"]);

Route::delete("/reservaciones/{id}", [reservacionController::class,"destroy"]);

#CRUD CLIENTES

Route::get("/clientes", [clienteController::class, 'index']);

Route::get("/clientes/{id}", [clienteController::class,"show"]);

Route::post("/clientes", [clienteController::class,"store"]);

Route::put("/clientes/{id}", [clienteController::class,"update"]);

Route::delete("/clientes/{id}", [clienteController::class,"destroy"]);

