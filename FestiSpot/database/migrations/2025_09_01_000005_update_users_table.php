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
        Schema::table('users', function (Blueprint $table) {
            // Agregar nuevas columnas como nullable primero
            $table->string('apellido', 100)->nullable()->after('name');
            $table->string('telefono', 20)->nullable()->after('email');
            $table->date('fecha_nacimiento')->nullable()->after('telefono');
            $table->enum('genero', ['masculino', 'femenino', 'otro', 'prefiero_no_decir'])->nullable()->after('fecha_nacimiento');
            $table->string('avatar_url')->nullable()->after('genero');
            $table->foreignId('rol_id')->default(1)->after('avatar_url')->constrained('roles');
            $table->enum('estado', ['activo', 'inactivo', 'suspendido'])->default('activo')->after('rol_id');
            $table->timestamp('fecha_registro')->nullable()->after('estado');
            $table->timestamp('ultimo_acceso')->nullable()->after('fecha_registro');
            $table->string('token_verificacion')->nullable()->after('ultimo_acceso');
            $table->boolean('email_verificado')->default(false)->after('token_verificacion');
        });

        // Actualizar datos existentes
        DB::statement("UPDATE users SET email_verificado = CASE WHEN email_verified_at IS NOT NULL THEN 1 ELSE 0 END");
        DB::statement("UPDATE users SET fecha_registro = created_at");
        DB::statement("UPDATE users SET apellido = 'Sin especificar' WHERE apellido IS NULL");
        
        // Asignar rol de organizador a usuarios existentes que tengan eventos
        DB::statement("
            UPDATE users 
            SET rol_id = (SELECT id FROM roles WHERE nombre = 'organizador') 
            WHERE id IN (SELECT DISTINCT user_id FROM events)
        ");

        // Ahora renombrar la columna name a nombre
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'nombre');
        });

        // Hacer apellido NOT NULL después de asignar valores
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellido', 100)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('nombre', 'name');
            $table->dropColumn([
                'apellido',
                'telefono',
                'fecha_nacimiento',
                'genero',
                'avatar_url',
                'rol_id',
                'estado',
                'fecha_registro',
                'ultimo_acceso',
                'token_verificacion',
                'email_verificado'
            ]);
        });
    }
};
