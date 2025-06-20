<?php

namespace Database\Seeders;

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

        
        
        
        $this->call([
        RolesYPermisosSeeder::class,
        UserSeeder::class,
        ProveedorSeeder::class,
        CategoriaSeeder::class,
        TipoArticuloSeeder::class,
        UnidadMedidaSeeder::class,
        ProductoSeeder::class,

        
    ]);
    
   

    }
}
