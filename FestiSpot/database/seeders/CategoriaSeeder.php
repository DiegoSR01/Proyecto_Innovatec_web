<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Música', 'descripcion' => 'Eventos musicales y conciertos'],
            ['nombre' => 'Tecnología', 'descripcion' => 'Conferencias y eventos tecnológicos'],
            ['nombre' => 'Arte', 'descripcion' => 'Exposiciones y eventos artísticos'],
            ['nombre' => 'Deportes', 'descripcion' => 'Eventos deportivos y competencias'],
            ['nombre' => 'Educativo', 'descripcion' => 'Talleres y eventos educativos'],
            ['nombre' => 'Gastronómico', 'descripcion' => 'Eventos culinarios y gastronómicos'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
