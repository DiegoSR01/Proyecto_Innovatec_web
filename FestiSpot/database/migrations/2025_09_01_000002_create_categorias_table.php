<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->string('icono', 100)->nullable();
            $table->string('color', 7)->nullable(); // Color hex
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // Insertar categorías por defecto
        DB::table('categorias')->insert([
            [
                'nombre' => 'Música',
                'descripcion' => 'Conciertos, festivales musicales',
                'icono' => 'music',
                'color' => '#FF6B6B',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Arte',
                'descripcion' => 'Exposiciones, galerías',
                'icono' => 'palette',
                'color' => '#4ECDC4',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Gastronomía',
                'descripcion' => 'Festivales culinarios, catas',
                'icono' => 'restaurant',
                'color' => '#45B7D1',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Deportes',
                'descripcion' => 'Eventos deportivos',
                'icono' => 'sports',
                'color' => '#96CEB4',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Tecnología',
                'descripcion' => 'Conferencias tech, workshops',
                'icono' => 'computer',
                'color' => '#FFEAA7',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Cultura',
                'descripcion' => 'Eventos culturales',
                'icono' => 'theater',
                'color' => '#DDA0DD',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
