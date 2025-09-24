<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizador_id',
        'titulo',
        'descripcion',
        'descripcion_corta',
        'categoria_id',
        'ubicacion_id',
        'fecha_inicio',
        'fecha_fin',
        'hora_apertura_puertas',
        'capacidad_total',
        'edad_minima',
        'estado',
        'politicas_cancelacion',
        'instrucciones_especiales',
        'tags',
        'fecha_publicacion',
        'motivo_cambio',
        // Campos legacy para compatibilidad
        'category',
        'start_time',
        'end_time',
        'repeat_schedule',
        'event_type',
        'venue_name',
        'full_address',
        'city',
        'state',
        'country',
        'postal_code',
        'location_details',
        'accessible',
        'virtual_platform',
        'event_link',
        'access_code',
        'virtual_password',
        'virtual_instructions',
        'banner_image',
        'gallery_images',
        'videos',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime',
        'fecha_publicacion' => 'datetime',
        'tags' => 'array',
        'repeat_schedule' => 'boolean',
        'accessible' => 'boolean',
        'gallery_images' => 'array',
        'videos' => 'array',
    ];

    /**
     * Relación con el organizador (usuario)
     */
    public function organizador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizador_id');
    }

    /**
     * Relación con la categoría
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Relación con la ubicación
     */
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }

    /**
     * Relación con las imágenes del evento
     */
    public function imagenes()
    {
        return $this->hasMany(ImagenEvento::class, 'evento_id');
    }

    /**
     * Relación con las asistencias
     */
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'evento_id');
    }

    /**
     * Relación con los favoritos
     */
    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'evento_id');
    }

    /**
     * Relación con las notificaciones
     */
    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'evento_id');
    }

    /**
     * Relación con las reviews
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'evento_id');
    }

    /**
     * Relación con los analytics
     */
    public function analytics()
    {
        return $this->hasMany(AnalyticsEvento::class, 'evento_id');
    }

    /**
     * Scope para eventos publicados
     */
    public function scopePublicados($query)
    {
        return $query->where('estado', 'publicado');
    }

    /**
     * Scope para eventos del organizador
     */
    public function scopePorOrganizador($query, $organizadorId)
    {
        return $query->where('organizador_id', $organizadorId);
    }

    /**
     * Scope para eventos por categoría
     */
    public function scopePorCategoria($query, $categoriaId)
    {
        return $query->where('categoria_id', $categoriaId);
    }

    /**
     * Scope para eventos próximos
     */
    public function scopeProximos($query)
    {
        return $query->where('fecha_inicio', '>=', now());
    }

    /**
     * Scope para eventos en curso
     */
    public function scopeEnCurso($query)
    {
        return $query->where('fecha_inicio', '<=', now())
                    ->where('fecha_fin', '>=', now());
    }

    /**
     * Obtener la fecha formateada en español
     */
    public function getFormattedStartDateAttribute()
    {
        Carbon::setLocale('es');
        return $this->fecha_inicio->format('d \d\e F \d\e Y');
    }

    /**
     * Obtener el rango de fechas formateado
     */
    public function getDateRangeAttribute()
    {
        Carbon::setLocale('es');
        
        if ($this->fecha_inicio->toDateString() === $this->fecha_fin?->toDateString()) {
            return $this->fecha_inicio->format('d \d\e F \d\e Y');
        }
        
        return $this->fecha_inicio->format('d \d\e F') . ' - ' . $this->fecha_fin?->format('d \d\e F \d\e Y');
    }

    /**
     * Obtener el rango de horarios formateado
     */
    public function getTimeRangeAttribute()
    {
        $inicio = $this->fecha_inicio->format('H:i');
        $fin = $this->fecha_fin ? $this->fecha_fin->format('H:i') : null;
        
        return $fin ? "$inicio - $fin" : $inicio;
    }

    /**
     * Verificar si el evento está lleno
     */
    public function estaLleno()
    {
        if (!$this->capacidad_total) {
            return false;
        }

        $asistenciasConfirmadas = $this->asistencias()
            ->whereIn('estado', ['confirmada', 'asistio'])
            ->sum('numero_acompanantes') + $this->asistencias()
            ->whereIn('estado', ['confirmada', 'asistio'])
            ->count();

        return $asistenciasConfirmadas >= $this->capacidad_total;
    }

    /**
     * Obtener el promedio de calificaciones
     */
    public function getPromedioCalificacionAttribute()
    {
        return $this->reviews()->visibles()->avg('calificacion') ?? 0;
    }

    /**
     * Obtener el total de asistentes
     */
    public function getTotalAsistentesAttribute()
    {
        return $this->asistencias()
            ->whereIn('estado', ['confirmada', 'asistio'])
            ->sum('numero_acompanantes') + $this->asistencias()
            ->whereIn('estado', ['confirmada', 'asistio'])
            ->count();
    }

    /**
     * Compatibilidad hacia atrás - alias para organizador
     */
    public function user(): BelongsTo
    {
        return $this->organizador();
    }

    /**
     * Compatibilidad hacia atrás - alias para eventos publicados
     */
    public function scopePublished($query)
    {
        return $this->scopePublicados($query);
    }

    /**
     * Compatibilidad hacia atrás - alias para eventos por usuario
     */
    public function scopeByUser($query, $userId)
    {
        return $this->scopePorOrganizador($query, $userId);
    }

    /**
     * Obtener el campo name para compatibilidad
     */
    public function getNameAttribute()
    {
        return $this->titulo;
    }

    /**
     * Obtener el campo description para compatibilidad
     */
    public function getDescriptionAttribute()
    {
        return $this->descripcion;
    }

    /**
     * Obtener start_date para compatibilidad
     */
    public function getStartDateAttribute()
    {
        return $this->fecha_inicio->toDateString();
    }

    /**
     * Obtener end_date para compatibilidad
     */
    public function getEndDateAttribute()
    {
        return $this->fecha_fin?->toDateString();
    }

    /**
     * Obtener capacity para compatibilidad
     */
    public function getCapacityAttribute()
    {
        return $this->capacidad_total;
    }

    /**
     * Obtener status para compatibilidad
     */
    public function getStatusAttribute()
    {
        return match($this->estado) {
            'borrador' => 'draft',
            'publicado' => 'published',
            'finalizado' => 'completed',
            'cancelado' => 'cancelled',
            default => 'draft'
        };
    }

    /**
     * Verificar si el evento es virtual
     */
    public function isVirtual()
    {
        return in_array($this->event_type, ['Virtual', 'Híbrido']);
    }

    /**
     * Verificar si el evento es presencial
     */
    public function isPresential()
    {
        return in_array($this->event_type, ['Presencial', 'Híbrido']);
    }

    /**
     * Obtener la imagen principal del evento (BLOB)
     */
    public function getImagenPrincipalAttribute()
    {
        // Intentar obtener imagen desde la tabla imagenes_evento (BLOB)
        $imagen = $this->imagenes()->where('tipo', 'principal')->first();
        if ($imagen && $imagen->hasImageBlob()) {
            // Devolver imagen base64 directamente
            return $imagen->imagen_base64;
        }
        
        // Fallback a banner_image legacy si existe
        if ($this->banner_image) {
            // Verificar si es una ruta de archivo o una URL completa
            if (filter_var($this->banner_image, FILTER_VALIDATE_URL)) {
                return $this->banner_image;
            } else {
                // Es un nombre de archivo, construir la ruta
                $imagePath = storage_path('app/public/temp/' . $this->banner_image);
                if (file_exists($imagePath)) {
                    // Leer el archivo y convertir a base64 para mostrar
                    $imageData = file_get_contents($imagePath);
                    $mimeType = mime_content_type($imagePath);
                    return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
                } else {
                    // Intentar en otras rutas posibles
                    $possiblePaths = [
                        storage_path('app/public/events/banners/' . $this->banner_image),
                        storage_path('app/public/' . $this->banner_image),
                        public_path('storage/events/banners/' . $this->banner_image),
                        public_path('storage/' . $this->banner_image),
                    ];
                    
                    foreach ($possiblePaths as $path) {
                        if (file_exists($path)) {
                            $imageData = file_get_contents($path);
                            $mimeType = mime_content_type($path);
                            return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
                        }
                    }
                    
                    // Si no se encuentra el archivo, devolver asset URL como fallback
                    return asset('storage/events/banners/' . $this->banner_image);
                }
            }
        }
        
        return null;
    }

    /**
     * Obtener todas las imágenes de galería
     */
    public function getImagenesGaleriaAttribute()
    {
        return $this->imagenes()->where('tipo', 'galeria')->get();
    }

    /**
     * Verificar si tiene imagen principal
     */
    public function hasImagenPrincipal()
    {
        return $this->imagenes()->where('tipo', 'principal')->exists() || !empty($this->banner_image);
    }
}
