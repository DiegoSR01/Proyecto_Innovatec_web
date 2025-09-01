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
        // Primero agregar las nuevas columnas
        Schema::table('events', function (Blueprint $table) {
            $table->string('descripcion_corta', 500)->nullable()->after('description');
            $table->foreignId('categoria_id')->nullable()->after('descripcion_corta')->constrained('categorias');
            $table->foreignId('ubicacion_id')->nullable()->after('categoria_id')->constrained('ubicaciones');
            $table->time('hora_apertura_puertas')->nullable()->after('end_time');
            $table->integer('edad_minima')->default(0)->after('capacity');
            $table->text('politicas_cancelacion')->nullable()->after('edad_minima');
            $table->text('instrucciones_especiales')->nullable()->after('politicas_cancelacion');
            $table->json('tags')->nullable()->after('instrucciones_especiales');
            $table->timestamp('fecha_creacion')->nullable()->after('tags');
            $table->timestamp('fecha_actualizacion')->nullable()->after('fecha_creacion');
            $table->timestamp('fecha_publicacion')->nullable()->after('fecha_actualizacion');
            $table->text('motivo_cambio')->nullable()->after('fecha_publicacion');
        });

        // Actualizar datos existentes
        DB::statement("UPDATE events SET fecha_creacion = created_at");
        DB::statement("UPDATE events SET fecha_actualizacion = updated_at");
        
        // Convertir estados existentes
        DB::statement("UPDATE events SET status = CASE 
            WHEN status = 'draft' THEN 'borrador'
            WHEN status = 'published' THEN 'publicado'
            WHEN status = 'completed' THEN 'finalizado'
            WHEN status = 'cancelled' THEN 'cancelado'
            ELSE 'borrador'
        END");

        // Combinar fechas y horas para fecha_inicio y fecha_fin
        DB::statement("UPDATE events SET start_date = datetime(start_date || ' ' || start_time)");
        DB::statement("UPDATE events SET end_date = CASE 
            WHEN end_date IS NOT NULL AND end_time IS NOT NULL 
            THEN datetime(end_date || ' ' || end_time) 
            ELSE NULL 
        END");

        // Renombrar columnas
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('name', 'titulo');
            $table->renameColumn('description', 'descripcion');
            $table->renameColumn('start_date', 'fecha_inicio');
            $table->renameColumn('end_date', 'fecha_fin');
            $table->renameColumn('capacity', 'capacidad_total');
            $table->renameColumn('status', 'estado');
            $table->renameColumn('user_id', 'organizador_id');
        });

        // Cambiar tipos de datos
        Schema::table('events', function (Blueprint $table) {
            $table->datetime('fecha_inicio')->change();
            $table->datetime('fecha_fin')->nullable()->change();
            $table->string('titulo', 200)->change();
            $table->enum('estado', ['borrador', 'publicado', 'en_curso', 'finalizado', 'cancelado'])->default('borrador')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('titulo', 'name');
            $table->renameColumn('descripcion', 'description');
            $table->renameColumn('fecha_inicio', 'start_date');
            $table->renameColumn('fecha_fin', 'end_date');
            $table->renameColumn('capacidad_total', 'capacity');
            $table->renameColumn('estado', 'status');
            $table->renameColumn('organizador_id', 'user_id');
            
            $table->dropColumn([
                'descripcion_corta',
                'categoria_id',
                'ubicacion_id',
                'hora_apertura_puertas',
                'edad_minima',
                'politicas_cancelacion',
                'instrucciones_especiales',
                'tags',
                'fecha_creacion',
                'fecha_actualizacion',
                'fecha_publicacion',
                'motivo_cambio'
            ]);
        });
    }
};
