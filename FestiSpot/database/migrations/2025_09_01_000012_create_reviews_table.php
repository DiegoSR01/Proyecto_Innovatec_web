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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('evento_id')->constrained('events');
            $table->integer('calificacion')->unsigned();
            $table->text('comentario')->nullable();
            $table->timestamp('fecha_review')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('moderado')->default(false);
            $table->boolean('visible')->default(true);
            $table->timestamps();
            
            $table->unique(['usuario_id', 'evento_id'], 'unique_review');
            // Note: Constraint check will be handled at application level
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
