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
        Schema::table('users', function (Blueprint $table) {
            $table->longText('avatar_data')->nullable()->after('avatar_url'); // Campo BLOB para avatar
            $table->string('avatar_mime_type', 100)->nullable()->after('avatar_data'); // Tipo MIME del avatar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar_data', 'avatar_mime_type']);
        });
    }
};
