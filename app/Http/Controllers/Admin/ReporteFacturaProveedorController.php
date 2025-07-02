<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use App\Models\FacturaProveedor;
use Illuminate\Http\Request;

class ReporteFacturaProveedorController extends Controller
{
    public function index(Request $request)
    {
        $proveedores = Proveedor::pluck('nombre', 'id');
        $facturas = collect();

        // Si hay filtros aplicados
        if ($request->filled(['fecha_inicio', 'fecha_fin'])) {
            $query = FacturaProveedor::with('cliente', 'proveedor')
                ->whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin]);

            if ($request->filled('proveedor_id')) {
                $query->where('proveedor_id', $request->proveedor_id);
            }

            $facturas = $query->get();
        }

        return view('admin.reportes.facturas_proveedores.index', compact('proveedores', 'facturas'));
    }
}
