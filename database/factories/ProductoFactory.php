<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
            // database/factories/ProductoFactory.php
        return [
            'nombre' => $this->faker->word(),
            'precio' => $this->faker->randomFloat(2, 100, 10000),
            'descuento' => $this->faker->numberBetween(0, 20),
            'foto' => $this->faker->imageUrl(640, 480, 'products', true),
            'descripcion' => $this->faker->sentence(10),

            'unidad_medida_id' => null, // Asignar en el seeder
            'proveedor_id' => null,
            'categoria_id' => null,
            'tipo_articulos_id' => null,
        ];

    }
}
