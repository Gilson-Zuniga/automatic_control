<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\FacturaCliente;
use App\Models\FacturaClienteItem;
use App\Models\Empresa;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class FacturaClienteController extends Controller
{
    public function index()
    {
        $facturas = FacturaCliente::with('empresa');
        return view('admin.facturas_clientes.index', compact('facturas'));
    }

    public function create()
    {
        $productos = \App\Models\Producto::with('inventario')->get();

        $inventario = $productos->map(function ($p) {
            return [
                'id' => $p->id,
                'valor' => $p->inventario->valor ?? 0,
                'descuento' => $p->inventario->descuento ?? 0,
                'cantidad' => $p->inventario->cantidad ?? 0,
                'producto' => [
                    'id' => $p->id,
                    'nombre' => $p->nombre,
                ],
            ];
        });

        $empresas = Empresa::all();

        return view('admin.facturas_clientes.create', [
            'productos' => $productos,
            'empresas' => $empresas,
            'inventario' => $inventario->values(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'empresa_id' => 'required|exists:perfil_empresas,nit',
            'items_json' => 'required|string',
        ]);

        $items = json_decode($request->items_json, true);
        if (!is_array($items) || count($items) === 0) {
            return redirect()->back()->withInput()->with('error', 'Debe agregar al menos un ítem a la factura.');
        }

        DB::beginTransaction();

        try {
            $numeroFactura = FacturaCliente::max('numero_factura') + 1;

            $factura = FacturaCliente::create([
                'empresa_id' => $request->empresa_id,
                'numero_factura' => $numeroFactura,
                'total' => 0,
            ]);

            $total = 0;

            foreach ($items as $item) {
                $inventario = inventario::where('producto_id', $item['producto_id'])->first();

                if (!$inventario) {
                    throw new \Exception("Producto ID {$item['producto_id']} no existe en el catálogo.");
                }

                if ($inventario->cantidad < $item['cantidad']) {
                    throw new \Exception("Stock insuficiente para el producto: {$inventario->producto->nombre}");
                }

                $precio_unitario = $item['precio_unitario'];
                $descuento = $item['descuento'] ?? 0;
                $cantidad = $item['cantidad'];
                $impuesto = $item['impuesto'] ?? 0;

                $subtotal = ($precio_unitario - $descuento) * $cantidad + $impuesto;
                $total += $subtotal;

                FacturaClienteItem::create([
                    'factura_cliente_id' => $factura->id,
                    'producto_id' => $inventario->producto_id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'descuento' => $descuento,
                    'impuesto' => $impuesto,
                    'subtotal' => $subtotal,
                ]);

                // Descontar del catálogo
                $inventario->cantidad -= $cantidad;
                $inventario->save();
            }

            $factura->total = $total;

            // Crear carpeta si no existe
            $carpetaPDF = public_path('facturas_ventas/pdf');
            if (!File::exists($carpetaPDF)) {
                File::makeDirectory($carpetaPDF, 0755, true);
            }

            $nombreArchivo = "factura_venta_{$factura->numero_factura}.pdf";
            $rutaPDF = "facturas_ventas/pdf/{$nombreArchivo}";

            // Generar PDF
            $pdf = Pdf::loadView('admin.facturas_clientes.pdf', [
                'factura' => $factura->load('items.producto', 'empresa')
            ]);

            $pdf->save(public_path($rutaPDF));
            $factura->pdf = $rutaPDF;
            $factura->save();

            DB::commit();
            return redirect()->route('admin.facturas_clientes.index')->with('success', 'Factura registrada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error al guardar la factura: ' . $e->getMessage());
        }
    }

    public function show(FacturaCliente $factura)
    {
        $factura->load('empresa', 'items.producto');
        return view('admin.facturas_clientes.show', compact('factura'));
    }
    
    public function destroy($id)
    {
        $factura = FacturaCliente::findOrFail($id);

        // Elimina los ítems relacionados, si los tienes
        $factura->items()->delete();

        // Elimina la factura
        $factura->delete();

        return redirect()->route('admin.facturas_clientes.index')->with('success', 'Factura eliminada correctamente.');
    }

    public function descargarPDF(FacturaCliente $factura)
    {
        if (!$factura->pdf || !file_exists(public_path($factura->pdf))) {
            return redirect()->back()->with('error', 'PDF no encontrado.');
        }

        return response()->download(public_path($factura->pdf));
    }
}
