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
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 200);
            $table->text('direccion');
            $table->string('ciudad', 100);
            $table->string('estado', 100)->nullable();
            $table->string('codigo_postal', 20)->nullable();
            $table->string('pais', 100)->default('México');
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
            $table->integer('capacidad_maxima')->nullable();
            $table->enum('tipo_venue', ['interior', 'exterior', 'mixto'])->nullable();
            $table->json('facilidades')->nullable(); // ["estacionamiento", "acceso_discapacitados", "wifi"]
            $table->string('contacto_venue', 200)->nullable();
            $table->string('telefono_venue', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicaciones');
    }
};
