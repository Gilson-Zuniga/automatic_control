<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
        'nombre',
        'producto_id',
        'unidad_medida',
        'cantidad',
        'precio',
        'descuento',
        'empresa_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
