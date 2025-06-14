<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FacturaProveedor;
use App\Models\FacturaProveedorItem;
use App\Models\Inventario;
use App\Models\Proveedor;
use App\Models\Empresa;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class FacturaProveedorController extends Controller
{
    public function index()
    {
        $facturas = FacturaProveedor::with('proveedor', 'empresa')->latest()->paginate(10);
        return view('admin.facturas_proveedores.index', compact('facturas'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $empresas = Empresa::all();
        $productos = Producto::with('unidadMedida')->get();

        return view('admin.facturas_proveedores.create', compact('proveedores', 'empresas', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
    'numero_factura' => 'required|unique:facturas_proveedores',
    'proveedor_id' => 'required|exists:proveedores,id',
    'empresa_id' => 'required|exists:empresas,id',
    'fecha_pago' => 'required|date',
    'items_json' => 'required|string',
]);

$items = json_decode($request->items_json, true);

DB::transaction(function () use ($request, $items) {
    $factura = FacturaProveedor::create($request->only([
        'numero_factura', 'proveedor_id', 'empresa_id', 'fecha_pago',
    ]) + ['total' => collect($items)->sum('subtotal')]);

    foreach ($items as $itemData) {
        $item = new FacturaProveedorItem($itemData);
        $item->factura_id = $factura->id;
        $item->save();

        $inventario = Inventario::where('producto_id', $item->producto_id)
            ->where('empresa_id', $factura->empresa_id)
            ->first();

        if ($inventario) {
            $inventario->cantidad += $item->cantidad;
            $inventario->save();
        } else {
            Inventario::create([
                'nombre'        => 'Ingreso Factura #' . $factura->numero_factura,
                'producto_id'   => $item->producto_id,
                'unidad_medida' => $item->unidad_medida,
                'cantidad'      => $item->cantidad,
                'precio'        => $item->precio_unitario,
                'descuento'     => $item->descuento ?? 0,
                'empresa_id'    => $factura->empresa_id,
            ]);
        }
    }

    // PDF
    $pdf = Pdf::loadView('admin.facturas_proveedores.pdf', compact('factura'));
    $pdfPath = 'facturas/pdf/factura_proveedor_' . $factura->id . '.pdf';
    Storage::put('public/' . $pdfPath, $pdf->output());

    $factura->update(['pdf_path' => $pdfPath]);
});


        return redirect()->route('admin.facturas_proveedores.index')
            ->with('success', 'Factura registrada correctamente.');
    }

    public function edit(FacturaProveedor $facturaProveedor)
    {
        abort(403, 'La edición de facturas no está permitida.');
    }

    public function update(Request $request, FacturaProveedor $facturaProveedor)
    {
        abort(403, 'La actualización de facturas no está permitida.');
    }
}
