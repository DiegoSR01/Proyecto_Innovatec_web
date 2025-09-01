<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios de prueba
        User::factory(10)->create();

        // Crear usuario de prueba específico
        User::factory()->create([
            'nombre' => 'Usuario',
            'apellido' => 'Prueba',
            'email' => 'test@example.com',
            'rol_id' => 2, // Organizador
        ]);

        // Crear usuario admin
        User::factory()->create([
            'nombre' => 'Admin',
            'apellido' => 'Sistema',
            'email' => 'admin@festispot.com',
            'rol_id' => 3, // Admin
        ]);
    }
}
