<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un usuario organizador de prueba si no existe
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'organizador@festispot.com'],
            [
                'nombre' => 'Organizador',
                'apellido' => 'Prueba',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Crear eventos de prueba
        $events = [
            [
                'organizador_id' => $user->id,
                'titulo' => 'Festival de Música Electrónica 2025',
                'descripcion' => 'Un festival increíble con los mejores DJs del mundo.',
                'category' => 'Festival',
                'start_time' => '20:00:00',
                'end_time' => '23:59:00',
                'fecha_inicio' => \Carbon\Carbon::now()->addDays(15)->setTime(20, 0),
                'fecha_fin' => \Carbon\Carbon::now()->addDays(15)->setTime(23, 59),
                'event_type' => 'Presencial',
                'venue_name' => 'Explanada Central',
                'city' => 'Ciudad de México',
                'capacidad_total' => 5000,
                'estado' => 'publicado',
            ],
            [
                'organizador_id' => $user->id,
                'titulo' => 'Conferencia de Tecnología Web',
                'descripcion' => 'Conferencia sobre las últimas tendencias en desarrollo web.',
                'category' => 'Conferencia',
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
                'fecha_inicio' => \Carbon\Carbon::now()->addDays(7)->setTime(9, 0),
                'fecha_fin' => \Carbon\Carbon::now()->addDays(7)->setTime(18, 0),
                'event_type' => 'Híbrido',
                'venue_name' => 'Centro de Convenciones',
                'city' => 'Guadalajara',
                'capacidad_total' => 300,
                'estado' => 'publicado',
            ]
        ];

        foreach ($events as $eventData) {
            \App\Models\Event::create($eventData);
        }
    }
}
