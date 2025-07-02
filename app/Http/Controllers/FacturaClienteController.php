<?php

namespace App\Http\Controllers;
use App\Models\FacturaCliente;

use Illuminate\Support\Facades\Auth;

class FacturaClienteController extends Controller
{
    public function index()
    {
        // Obtener el ID del cliente autenticado
        $clienteId = Auth::id();

        // Obtener las facturas del cliente autenticado
        $facturas = FacturaCliente::where('cliente_id', $clienteId)
            ->with(['productos'])
            ->get();

        // Retornar la vista con las facturas
        return view('admin.reportes.facturas-clientes.index', compact('facturas'));
    }
}