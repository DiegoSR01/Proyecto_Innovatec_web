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
        Schema::table('imagenes_evento', function (Blueprint $table) {
            $table->longText('imagen_data')->nullable()->after('url'); // Campo BLOB para la imagen
            $table->string('mime_type', 100)->nullable()->after('imagen_data'); // Tipo MIME
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('imagenes_evento', function (Blueprint $table) {
            $table->dropColumn(['imagen_data', 'mime_type']);
        });
    }
};
