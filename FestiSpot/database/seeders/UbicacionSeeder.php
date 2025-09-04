<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ubicacion;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ubicaciones = [
            [
                'nombre' => 'Auditorio Nacional',
                'direccion' => 'Paseo de la Reforma 50',
                'ciudad' => 'Ciudad de México',
                'estado' => 'Ciudad de México',
                'pais' => 'México',
                'codigo_postal' => '11560'
            ],
            [
                'nombre' => 'Centro de Convenciones',
                'direccion' => 'Av. Conscripto 311',
                'ciudad' => 'Ciudad de México',
                'estado' => 'Ciudad de México',
                'pais' => 'México',
                'codigo_postal' => '11200'
            ],
            [
                'nombre' => 'Palacio de los Deportes',
                'direccion' => 'Añil 635',
                'ciudad' => 'Ciudad de México',
                'estado' => 'Ciudad de México',
                'pais' => 'México',
                'codigo_postal' => '08400'
            ],
        ];

        foreach ($ubicaciones as $ubicacion) {
            Ubicacion::create($ubicacion);
        }
    }
}
