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
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('evento_id')->constrained('events');
            $table->timestamp('fecha_agregado')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
            
            $table->unique(['usuario_id', 'evento_id'], 'unique_favorite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
