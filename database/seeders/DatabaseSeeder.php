<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categoria;
use App\Models\TipoArticulo;
use App\Models\Proveedor;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Gilson Zuñiga',
            'email' => 'gilsonzuniga@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        
        

        $this->call([
        ProveedorSeeder::class,
        CategoriaSeeder::class,
        TipoArticuloSeeder::class,
        UnidadMedidaSeeder::class,
        ProductoSeeder::class,
    ]);

    }
}
