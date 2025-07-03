<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use App\Models\Empresa;
use App\Models\FacturaProveedor;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReporteFacturaProveedorController extends Controller
{
    public function index(Request $request)
    {
        $proveedores = Proveedor::pluck('nombre', 'id');
        $facturas = collect();

        // Si hay filtros aplicados
        if ($request->filled(['fecha_inicio', 'fecha_fin'])) {
            $query = FacturaProveedor::with('empresa', 'proveedor')
                ->whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin]);

            if ($request->filled('proveedor_id')) {
                $query->where('proveedor_id', $request->proveedor_id);
            }

            $facturas = $query->get();
        }

        return view('admin.reportes.facturas_proveedores.index', compact('proveedores', 'facturas'));
    }
    public function exportarExcel(Request $request): StreamedResponse
    {
        $request->validate([
            'proveedor_id' => 'nullable|exists:empresas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $facturas = FacturaProveedor::with('proveedor', 'empresa')
            ->when($request->proveedor_id, fn($q) => $q->where('proveedor_id', $request->proveedor_id))
            ->whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin])
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Facturas proveedores');

        // Cabeceras
        $sheet->fromArray([
            ['ID', 'Número Factura', 'proveedores', 'Empresa', 'Fecha', 'Total']
        ], null, 'A1');

        // Contenido
        $fila = 2;
        foreach ($facturas as $factura) {
            $sheet->fromArray([
                $factura->id,
                $factura->numero_factura,
                $factura->proveedor->nombre ?? 'N/A',
                $factura->empresa->nombre ?? 'N/A',
                $factura->created_at->format('Y-m-d'),
                $factura->total,
            ], null, 'A' . $fila++);
        }

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, 'reporte_facturas_proveedores.xlsx');
    }
}
