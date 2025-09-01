<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configuraciones_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->boolean('notificaciones_push')->default(true);
            $table->boolean('notificaciones_email')->default(true);
            $table->json('categorias_favoritas')->nullable();
            $table->integer('radio_busqueda_km')->default(50);
            $table->string('idioma', 5)->default('es');
            $table->enum('tema', ['claro', 'oscuro', 'auto'])->default('auto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuraciones_usuario');
    }
};
