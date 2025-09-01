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
        Schema::create('planes_suscripcion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('precio_mensual', 10, 2)->nullable();
            $table->decimal('precio_anual', 10, 2)->nullable();
            $table->integer('max_eventos')->nullable();
            $table->integer('max_imagenes_por_evento')->nullable();
            $table->json('features')->nullable(); // ["analytics", "promocion_premium", "soporte_24_7"]
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // Insertar planes por defecto
        DB::table('planes_suscripcion')->insert([
            [
                'nombre' => 'Básico',
                'descripcion' => 'Plan básico para empezar',
                'precio_mensual' => 0.00,
                'precio_anual' => 0.00,
                'max_eventos' => 5,
                'max_imagenes_por_evento' => 3,
                'features' => json_encode(['eventos_basicos']),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Pro',
                'descripcion' => 'Plan profesional con más funciones',
                'precio_mensual' => 299.00,
                'precio_anual' => 2990.00,
                'max_eventos' => 50,
                'max_imagenes_por_evento' => 10,
                'features' => json_encode(['analytics', 'promocion_premium', 'soporte_prioritario']),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Premium',
                'descripcion' => 'Plan premium con todas las funciones',
                'precio_mensual' => 599.00,
                'precio_anual' => 5990.00,
                'max_eventos' => null, // Ilimitado
                'max_imagenes_por_evento' => null, // Ilimitado
                'features' => json_encode(['analytics', 'promocion_premium', 'soporte_24_7', 'api_access', 'white_label']),
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
        Schema::dropIfExists('planes_suscripcion');
    }
};
