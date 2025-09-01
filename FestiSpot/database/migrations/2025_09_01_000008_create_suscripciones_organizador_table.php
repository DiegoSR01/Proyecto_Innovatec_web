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
        Schema::create('suscripciones_organizador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizador_id')->constrained('users');
            $table->foreignId('plan_id')->constrained('planes_suscripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_vencimiento');
            $table->enum('estado', ['activa', 'vencida', 'cancelada', 'suspendida'])->default('activa');
            $table->decimal('precio_pagado', 10, 2)->nullable();
            $table->string('metodo_pago', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscripciones_organizador');
    }
};
