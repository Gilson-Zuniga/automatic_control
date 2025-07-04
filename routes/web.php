<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\{
    TiendaController,
    CarritoController,
    InicioController,
    DashboardController,
    ContactoController,
    CompraController,
    PayPalController,
    OrdenController
};

// Página principal
Route::get('/', [InicioController::class, 'index'])->name('home');
Route::get('/home', [InicioController::class, 'index'])->name('inicio.index');

// Tienda
Route::get('/tienda', [TiendaController::class, 'mostrarEcommerce'])->name('tienda.index');
Route::get('/productos', [TiendaController::class, 'mostrarEcommerce'])->name('productos.index');
Route::get('/productos/{id}', [TiendaController::class, 'mostrarProducto'])->name('productos.show');

// Carrito (algunos públicos y otros protegidos)
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::get('/carrito/dropdown-content', [CarritoController::class, 'dropdownContent'])->name('carrito.dropdown');
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');


// Compra
Route::post('/carrito/comprar', [CarritoController::class, 'comprar'])->name('carrito.comprar');

// PayPal
Route::get('/paypal/cancel', [CompraController::class, 'cancel'])->name('paypal.cancel');
Route::get('/paypal/pay', [PayPalController::class, 'payWithPayPal'])->name('paypal.pay');
Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');

// Orden
Route::post('/orden/contraentrega', [OrdenController::class, 'storeContraentrega'])->name('orden.contraentrega');

// Otros
Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');
Route::get('/login-tienda', [TiendaController::class, 'login'])->name('tienda.login');

// Rutas protegidas (requieren login)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Auth routes
require __DIR__.'/auth.php';
