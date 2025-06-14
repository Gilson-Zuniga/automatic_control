<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    protected $model = Proveedor::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company,
            'nit' => $this->faker->unique()->numerify('##########'), // 10 dígitos
            'telefono' => $this->faker->unique()->numerify('3#########'), // Ej: 3 seguido de 9 dígitos
            'email' => $this->faker->unique()->safeEmail,
            'direccion' => $this->faker->address,
            'ubicacion' => $this->faker->city,
        ];
    }
}
