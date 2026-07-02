<?php

use Illuminate\Support\Facades\Route;

// Todas las rutas devuelven la misma vista; Vue Router maneja la navegación en el cliente
Route::get('/{any?}', function () {
    return view('home.index');
})->where('any', '.*');
