<?php

namespace App\Models;
use App\Models\FacturaProveedor;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacturaProveedorItem extends Model
{
    use HasFactory;

    protected $fillable = [

        'factura_id',
        'producto_id',
        'unidad_medida',
        'cantidad',
        'precio_unitario',
        'impuesto',
        'subtotal',
    ];

    public function factura()
    {
        return $this->belongsTo(FacturaProveedor::class, 'factura_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    

    protected static function booted()
{
    static::created(function ($item) {
        $factura = $item->factura; // Asegúrate de tener la relación factura() en este modelo
        $proveedorid = $factura->proveedor_id;

        $inventario = \App\Models\Inventario::firstOrNew([
            'producto_id' => $item->producto_id,
            'proveedor_id' => $proveedorid,
        ]);

        // Sumar la cantidad y actualizar el precio
        $inventario->cantidad += $item->cantidad;
        $inventario->precio_unitario = $item->precio_unitario; // Si deseas mantener el último precio
        $inventario->save();
    });

    // También puedes manejar el evento deleted si se elimina un item
    static::deleted(function ($item) {
        $factura = $item->factura;
        $proveedorid = $factura->proveedor_id;

        $inventario = \App\Models\Inventario::where([
            'producto_id' => $item->producto_id,
            'proveedor_id' => $proveedorid,
        ])->first();

        if ($inventario) {
            $inventario->cantidad -= $item->cantidad;
            $inventario->cantidad = max(0, $inventario->cantidad);
            $inventario->save();
        }
    });
}

}
