<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador
        User::factory()->create([
            'name' => 'Gilson Zuñiga',
            'email' => 'gilsonzuniga@gmail.com',
            'password' => bcrypt('admin123'),
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Mostrador',
            'email' => 'yipiti@gmail.com',
            'password' => bcrypt('admin123'),
        ])->assignRole('cliente');

        // Usuarios auxiliares
        User::factory(9)->create()->each(function ($user) {
            $user->assignRole('aux');
        });
    }
}
