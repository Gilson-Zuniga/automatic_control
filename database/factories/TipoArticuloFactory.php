<?php

namespace Database\Factories;

use App\Models\TipoArticulo;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipoArticuloFactory extends Factory
{
    protected $model = TipoArticulo::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word(),
            'categoria_id' => Categoria::factory(), // 
        ];
    }
}

