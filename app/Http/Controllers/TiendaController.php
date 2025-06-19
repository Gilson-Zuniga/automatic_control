<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventario;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function mostrarEcommerce()
    {
        $productos = Inventario::with(['inventario', 'producto'])->get();
        return view('tienda.index', compact('productos'));
    }
}
