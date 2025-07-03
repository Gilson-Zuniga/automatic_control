<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\FacturaClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\OrdenController;



// Rutas públicas (no requieren login)
Route::get('/', [InicioController::class, 'index'])->name('home');
Route::get('/home', [InicioController::class, 'index'])->name('inicio.index');
Route::get('/tienda', [TiendaController::class, 'mostrarEcommerce'])->name('tienda.index');

// Rutas protegidas
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

Route::get('/productos', [App\Http\Controllers\TiendaController::class, 'mostrarProductos'])->name('productos.index');


Route::get('/productos', [TiendaController::class, 'mostrarEcommerce'])->name('productos.index');
Route::get('/productos/{id}', [TiendaController::class, 'mostrarProducto'])->name('productos.show');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito', [CarritoController::class, 'mostrar'])->name('carrito.mostrar');
Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');


Route::get('/paypal/cancel', [CompraController::class, 'cancel'])->name('paypal.cancel');
Route::get('/paypal/pay', [PayPalController::class, 'payWithPayPal'])->name('paypal.pay');
Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');

// Ruta final limpia para success de PayPal
Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');

Route::get('/carrito/dropdown-content', [CarritoController::class, 'dropdownContent']);
Route::post('/orden/contraentrega', [OrdenController::class, 'storeContraentrega'])->name('orden.contraentrega');
Route::get('/tienda', [TiendaController::class, 'mostrarEcommerce'])->name('tienda.index');


