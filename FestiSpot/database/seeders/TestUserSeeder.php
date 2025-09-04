<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario de prueba
        User::create([
            'nombre' => 'Usuario de Prueba',
            'apellido' => 'Apellido Test',
            'email' => 'test@festispot.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
