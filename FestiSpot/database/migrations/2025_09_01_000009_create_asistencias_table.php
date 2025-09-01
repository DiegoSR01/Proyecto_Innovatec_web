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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('evento_id')->constrained('events');
            $table->timestamp('fecha_registro')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('estado', ['confirmada', 'pendiente', 'cancelada', 'asistio', 'no_asistio'])->default('confirmada');
            $table->integer('numero_acompanantes')->default(0);
            $table->string('codigo_qr', 100)->unique()->nullable();
            $table->text('notas_usuario')->nullable();
            $table->timestamp('fecha_cancelacion')->nullable();
            $table->text('motivo_cancelacion')->nullable();
            $table->timestamps();
            
            $table->unique(['usuario_id', 'evento_id'], 'unique_user_event');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
