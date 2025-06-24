<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacturaCliente;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReporteFacturaClienteController extends Controller
{
    public function index()
    {
        $empresas = \App\Models\Empresa::pluck('nombre', 'id');
        return view('admin.reportes.facturas-clientes.index', compact('empresas'));
    }

    public function exportarExcel(Request $request): StreamedResponse
    {
        $request->validate([
            'empresa_id' => 'nullable|exists:empresas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $facturas = FacturaCliente::query()
            ->when($request->empresa_id, fn($q) => $q->where('empresa_id', $request->empresa_id))
            ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Facturas Clientes');

        // Cabeceras
        $sheet->fromArray([
            ['ID', 'Número Factura', 'Cliente', 'Empresa', 'Fecha', 'Total']
        ], null, 'A1');

        // Contenido
        $fila = 2;
        foreach ($facturas as $factura) {
            $sheet->fromArray([
                $factura->id,
                $factura->numero_factura,
                $factura->cliente->nombre ?? 'N/A',
                $factura->empresa->nombre ?? 'N/A',
                $factura->fecha,
                $factura->total,
            ], null, 'A' . $fila++);
        }

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, 'reporte_facturas_clientes.xlsx');
    }
}
