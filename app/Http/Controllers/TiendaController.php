<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Models\Producto;

class TiendaController extends Controller
{
    public function mostrarProductos()
    {
        // Puedes seleccionar solo las columnas que necesitas mostrar
        $productos = Producto::select('id', 'nombre', 'precio', 'foto')->get();

        return view('tienda.index', compact('productos'));
}};
