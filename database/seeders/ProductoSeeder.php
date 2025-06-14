<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\TipoArticulo;
use App\Models\UnidadMedida;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurar datos base
        if (Proveedor::count() === 0) {
            Proveedor::factory()->count(5)->create();
        }

        if (Categoria::count() === 0) {
            Categoria::factory()->count(3)->create();
        }

        if (TipoArticulo::count() === 0) {
            Categoria::all()->each(function ($categoria) {
                TipoArticulo::factory()->count(2)->create([
                    'categoria_id' => $categoria->id,
                ]);
            });
        }



    Producto::factory()->count(20)->make()->each(function ($producto) {
        $producto->proveedor_id = Proveedor::inRandomOrder()->first()->id;
        $producto->categoria_id = Categoria::inRandomOrder()->first()->id;

        $tipo = TipoArticulo::where('categoria_id', $producto->categoria_id)
            ->inRandomOrder()
            ->first();

        if (!$tipo) {
            $tipo = TipoArticulo::factory()->create([
                'categoria_id' => $producto->categoria_id
            ]);
        }

        $producto->tipo_articulos_id = $tipo->id;
        $producto->unidad_medida_id = UnidadMedida::inRandomOrder()->first()->id;

        $producto->save();
    });

    }
}
