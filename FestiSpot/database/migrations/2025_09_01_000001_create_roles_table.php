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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique();
            $table->text('descripcion')->nullable();
            $table->json('permisos')->nullable();
            $table->timestamps();
        });

        // Insertar roles por defecto
        DB::table('roles')->insert([
            [
                'nombre' => 'asistente',
                'descripcion' => 'Usuario que asiste a eventos',
                'permisos' => json_encode(['view_events', 'register_events', 'rate_events']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'organizador',
                'descripcion' => 'Usuario que crea y gestiona eventos',
                'permisos' => json_encode(['view_events', 'create_events', 'edit_events', 'manage_events', 'view_analytics']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'admin',
                'descripcion' => 'Administrador del sistema',
                'permisos' => json_encode(['*']),
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
        Schema::dropIfExists('roles');
    }
};
