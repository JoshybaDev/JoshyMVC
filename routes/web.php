<?php

use Joshyba\Joshymvc\Router\Route;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\SistemaController;

//echo "Carga de rutas<br>";

#Front
Route::get("/", SesionController::class);
Route::post("/", SesionController::class . "@login");
Route::post("/login2", SesionController::class . "@login2");
Route::post("/logout", SesionController::class . "@CerrarLaSesion");
#sistema
Route::get("/sistema", SistemaController::class . "@show");