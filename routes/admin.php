<?php
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\TipoArticuloController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\FacturaProveedorController;
use App\Http\Controllers\Admin\InventarioController;
use Illuminate\Support\Facades\Route;

Route::resource('categorias',CategoriaController::class);
Route::resource('tipos_articulos',TipoArticuloController::class)->parameters([
    'tipos_articulos' => 'tipoArticulo']);
Route::resource('proveedores',ProveedorController::class)->parameters([
    'proveedores' => 'proveedor']);
Route::resource('productos',ProductoController::class);
Route::resource('empresas',EmpresaController::class);
Route::resource('facturas_proveedores',FacturaProveedorController::class);
Route::resource('inventarios',InventarioController::class);



