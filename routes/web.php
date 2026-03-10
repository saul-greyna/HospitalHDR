<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

Route::get('/', function () {
    return view('home.index');
})->name('inicio');

Route::get('/directorio-medico', function () {
    return view('directorio_medico.index');
})->name('directorio.medico');

Route::get('/servicios', function () {
    return view('servicios.index');
})->name('servicios');

Route::get('/quienes-somos', function () {
    return view('nosotros.index');
})->name('quienes.somos');

Route::get('/google-reviews', [GoogleController::class, 'reviews']);