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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Información básica del evento
            $table->string('name');
            $table->text('description');
            $table->string('category');
            
            // Información de fechas y horarios
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('repeat_schedule')->default(false);
            
            // Información de ubicación
            $table->enum('event_type', ['Presencial', 'Virtual', 'Híbrido']);
            $table->string('venue_name')->nullable();
            $table->text('full_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('location_details')->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('accessible')->default(false);
            
            // Información virtual
            $table->string('virtual_platform')->nullable();
            $table->string('event_link')->nullable();
            $table->string('access_code')->nullable();
            $table->string('virtual_password')->nullable();
            $table->text('virtual_instructions')->nullable();
            
            // Media
            $table->string('banner_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('videos')->nullable();
            
            // Estado del evento
            $table->enum('status', ['draft', 'published', 'cancelled', 'completed'])->default('draft');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
