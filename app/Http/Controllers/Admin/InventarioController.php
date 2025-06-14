<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $inventario = Inventario::with(['producto', 'proveedor']);


        return view('admin.inventario.index', compact('inventario'));
    }
}
