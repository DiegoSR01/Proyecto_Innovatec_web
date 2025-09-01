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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('evento_id')->nullable()->constrained('events');
            $table->enum('tipo', ['nuevo_evento', 'recordatorio', 'cancelacion', 'actualizacion', 'promocion']);
            $table->string('titulo', 200);
            $table->text('mensaje');
            $table->boolean('leida')->default(false);
            $table->timestamp('fecha_envio')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('fecha_lectura')->nullable();
            $table->enum('canal', ['push', 'email', 'in_app'])->default('in_app');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
