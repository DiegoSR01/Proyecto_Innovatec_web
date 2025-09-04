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
        // Agregar columnas solo si no existen
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'descripcion_corta')) {
                $table->string('descripcion_corta', 500)->nullable()->after('description');
            }
            if (!Schema::hasColumn('events', 'categoria_id')) {
                $table->foreignId('categoria_id')->nullable()->after('descripcion_corta')->constrained('categorias');
            }
            if (!Schema::hasColumn('events', 'ubicacion_id')) {
                $table->foreignId('ubicacion_id')->nullable()->after('categoria_id')->constrained('ubicaciones');
            }
            if (!Schema::hasColumn('events', 'hora_apertura_puertas')) {
                $table->time('hora_apertura_puertas')->nullable()->after('end_time');
            }
            if (!Schema::hasColumn('events', 'edad_minima')) {
                $table->integer('edad_minima')->default(0)->after('capacity');
            }
            if (!Schema::hasColumn('events', 'politicas_cancelacion')) {
                $table->text('politicas_cancelacion')->nullable()->after('edad_minima');
            }
            if (!Schema::hasColumn('events', 'instrucciones_especiales')) {
                $table->text('instrucciones_especiales')->nullable()->after('politicas_cancelacion');
            }
            if (!Schema::hasColumn('events', 'tags')) {
                $table->json('tags')->nullable()->after('instrucciones_especiales');
            }
            if (!Schema::hasColumn('events', 'fecha_creacion')) {
                $table->timestamp('fecha_creacion')->nullable()->after('tags');
            }
            if (!Schema::hasColumn('events', 'fecha_actualizacion')) {
                $table->timestamp('fecha_actualizacion')->nullable()->after('fecha_creacion');
            }
            if (!Schema::hasColumn('events', 'fecha_publicacion')) {
                $table->timestamp('fecha_publicacion')->nullable()->after('fecha_actualizacion');
            }
            if (!Schema::hasColumn('events', 'motivo_cambio')) {
                $table->text('motivo_cambio')->nullable()->after('fecha_publicacion');
            }
        });

        // Actualizar datos existentes ANTES de renombrar columnas
        DB::statement("UPDATE events SET fecha_creacion = created_at");
        DB::statement("UPDATE events SET fecha_actualizacion = updated_at");
        
        // Convertir estados existentes ANTES de renombrar
        DB::statement("UPDATE events SET status = CASE 
            WHEN status = 'draft' THEN 'borrador'
            WHEN status = 'published' THEN 'publicado'
            WHEN status = 'completed' THEN 'finalizado'
            WHEN status = 'cancelled' THEN 'cancelado'
            ELSE 'borrador'
        END");

        // Combinar fechas y horas ANTES de renombrar columnas
        DB::statement("UPDATE events SET start_date = STR_TO_DATE(CONCAT(start_date, ' ', start_time), '%Y-%m-%d %H:%i:%s') WHERE start_time IS NOT NULL");
        DB::statement("UPDATE events SET end_date = CASE 
            WHEN end_date IS NOT NULL AND end_time IS NOT NULL 
            THEN STR_TO_DATE(CONCAT(end_date, ' ', end_time), '%Y-%m-%d %H:%i:%s')
            ELSE NULL 
        END");

        // Renombrar columnas (excepto status que se manejará después)
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'name')) {
                $table->renameColumn('name', 'titulo');
            }
            if (Schema::hasColumn('events', 'description')) {
                $table->renameColumn('description', 'descripcion');
            }
            if (Schema::hasColumn('events', 'start_date')) {
                $table->renameColumn('start_date', 'fecha_inicio');
            }
            if (Schema::hasColumn('events', 'end_date')) {
                $table->renameColumn('end_date', 'fecha_fin');
            }
            if (Schema::hasColumn('events', 'capacity')) {
                $table->renameColumn('capacity', 'capacidad_total');
            }
            if (Schema::hasColumn('events', 'user_id')) {
                $table->renameColumn('user_id', 'organizador_id');
            }
        });

        // Cambiar tipos de datos
        Schema::table('events', function (Blueprint $table) {
            $table->datetime('fecha_inicio')->change();
            $table->datetime('fecha_fin')->nullable()->change();
            $table->string('titulo', 200)->change();
        });

        // Manejar el cambio de status a estado por separado
        if (Schema::hasColumn('events', 'status')) {
            // Primero cambiar a VARCHAR temporal
            DB::statement("ALTER TABLE events MODIFY COLUMN status VARCHAR(50) NOT NULL DEFAULT 'draft'");
            
            // Luego renombrar la columna
            Schema::table('events', function (Blueprint $table) {
                $table->renameColumn('status', 'estado');
            });
            
            // Finalmente cambiar a ENUM con los nuevos valores
            DB::statement("ALTER TABLE events MODIFY COLUMN estado ENUM('borrador', 'publicado', 'en_curso', 'finalizado', 'cancelado') NOT NULL DEFAULT 'borrador'");
        }
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
