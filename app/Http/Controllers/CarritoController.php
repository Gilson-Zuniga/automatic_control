<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index() {
        $carritos = Carrito::with('producto')->where('user_id', Auth::id())->get();
        return view('carrito.index', compact('carritos'));
    }

    public function agregar($id) {
        $producto = Producto::findOrFail($id);

        // Buscar si ya está en el carrito
        $carrito = Carrito::where('user_id', Auth::id())
                          ->where('producto_id', $id)
                          ->first();

        if ($carrito) {
            $carrito->cantidad += 1;
        } else {
            $carrito = new Carrito();
            $carrito->user_id = Auth::id();
            $carrito->producto_id = $id;
            $carrito->cantidad = 1;
        }

        $carrito->save();

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function eliminar($id) {
        $carrito = Carrito::findOrFail($id);
        $carrito->delete();
        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    public function comprar() {
        $carritos = Carrito::with('producto')->where('user_id', Auth::id())->get();

        if ($carritos->isEmpty()) {
            return redirect()->back()->with('error', 'El carrito está vacío');
        }

        // Crear orden
        $orden = new \App\Models\Orden();
        $orden->user_id = Auth::id();
        $orden->total = 0;
        $orden->save();

        $total = 0;

        foreach ($carritos as $item) {
            // Descontar stock
            if ($item->producto->stock < $item->cantidad) {
                return redirect()->back()->with('error', "No hay suficiente stock de {$item->producto->nombre}");
            }

            $item->producto->stock -= $item->cantidad;
            $item->producto->save();

            // Crear detalle de orden
            $orden->detalles()->create([
                'producto_id' => $item->producto_id,
                'cantidad' => $item->cantidad,
                'precio_unitario' => $item->producto->precio,
                'subtotal' => $item->cantidad * $item->producto->precio
            ]);

            $total += $item->cantidad * $item->producto->precio;
        }

        $orden->total = $total;
        $orden->save();

        // Vaciar carrito
        Carrito::where('user_id', Auth::id())->delete();

        return redirect()->route('ordenes.show', $orden->id)->with('success', 'Compra realizada con éxito');
    }
}
