<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoArticulo;
use App\Models\Categoria;

class TipoArticuloSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurarse de que existan categorías
        if (Categoria::count() === 0) {
            Categoria::factory()->count(5)->create();
        }

        // A cada categoría, asignarle varios tipos de artículos
        Categoria::all()->each(function ($categoria) {
            TipoArticulo::factory()->count(3)->create([
                'categoria_id' => $categoria->id,
            ]);
        });
    }
}
