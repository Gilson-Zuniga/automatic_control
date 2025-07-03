<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function mostrarEcommerce(Request $request)
    {
        // Configuración para el modal de login
        $showLoginModal = false;
        $redirectTo = null;
        
        if ($request->has('show_login')) {
            $showLoginModal = true;
            $redirectTo = $request->input('redirect_to', route('tienda'));
        }

        // Obtener productos de la categoría Hogar con relaciones
        $productosHogar = Producto::with(['categoria', 'inventario'])
            ->whereHas('categoria', function($query) {
                $query->where('nombre', 'Hogar');
            })
            ->get();

        // Otros datos necesarios
        $productos = Producto::all();
        $categorias = Categoria::all();

        return view('tienda.index', [
            'productosHogar' => $productosHogar,
            'productos' => $productos,
            'categorias' => $categorias,
            'showLoginModal' => $showLoginModal,
            'redirectTo' => $redirectTo
        ]);
    }
}