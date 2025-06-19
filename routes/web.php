<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\DashboardController; 
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Carrito solo accesible con login
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::get('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/carrito/comprar', [CarritoController::class, 'comprar'])->name('carrito.comprar');
});

// Ruta pública para agregar al carrito desde el ecommerce (si quieres permitirlo)
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar.public');

//  Incluye rutas de autenticación (login, registro, etc.)
require __DIR__.'/auth.php';
