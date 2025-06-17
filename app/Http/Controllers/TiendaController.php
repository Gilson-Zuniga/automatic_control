<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;

class TiendaController extends Controller
{
    public function mostrarEcommerce()
    {
        $productos = Producto::where('activo', 1)->get();
        return view('tienda.ecommerce', compact('productos'));

        
    }
}
