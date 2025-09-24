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
        // Solo ejecutar seeders esenciales para el funcionamiento de la app
        $this->call([
            CategoriaSeeder::class,
            UbicacionSeeder::class,
        ]);

        // Los datos de prueba están comentados - descomenta si los necesitas
        // $this->call([
        //     TestUserSeeder::class,
        //     TestEventSeeder::class,
        // ]);
    }
}
