<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\mesaController;
use App\Http\Controllers\Api\reservacionController;

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

