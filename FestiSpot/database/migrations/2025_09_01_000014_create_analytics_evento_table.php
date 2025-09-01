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
        Schema::create('analytics_evento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('events');
            $table->date('fecha');
            $table->integer('vistas_totales')->default(0);
            $table->integer('vistas_unicas')->default(0);
            $table->integer('clicks_reserva')->default(0);
            $table->integer('compartidos')->default(0);
            $table->integer('favoritos_agregados')->default(0);
            $table->timestamps();
            
            $table->unique(['evento_id', 'fecha'], 'unique_event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_evento');
    }
};
