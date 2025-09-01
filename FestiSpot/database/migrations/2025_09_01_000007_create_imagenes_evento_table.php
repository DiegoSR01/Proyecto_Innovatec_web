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
        Schema::create('imagenes_evento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('events')->onDelete('cascade');
            $table->string('url', 500);
            $table->enum('tipo', ['principal', 'galeria', 'thumbnail'])->default('galeria');
            $table->integer('orden')->default(0);
            $table->string('alt_text', 200)->nullable();
            $table->integer('tamaño_kb')->nullable();
            $table->string('formato', 10)->nullable();
            $table->timestamp('fecha_subida')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_evento');
    }
};
