<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImagenEvento extends Model
{
    use HasFactory;

    protected $table = 'imagenes_evento';

    protected $fillable = [
        'evento_id',
        'url',
        'imagen_data', // Datos binarios de la imagen (BLOB)
        'mime_type', // Tipo MIME de la imagen
        'tipo',
        'orden',
        'alt_text',
        'tamaño_kb',
        'formato',
    ];

    protected $casts = [
        'fecha_subida' => 'datetime',
    ];

    /**
     * Relación con el evento
     */
    public function evento()
    {
        return $this->belongsTo(Event::class, 'evento_id');
    }

    /**
     * Scope para imagen principal
     */
    public function scopePrincipal($query)
    {
        return $query->where('tipo', 'principal');
    }

    /**
     * Scope para galería
     */
    public function scopeGaleria($query)
    {
        return $query->where('tipo', 'galeria')->orderBy('orden');
    }

    /**
     * Scope para thumbnails
     */
    public function scopeThumbnails($query)
    {
        return $query->where('tipo', 'thumbnail');
    }

    /**
     * Generar URL para mostrar la imagen desde BLOB
     */
    public function getImageUrlAttribute()
    {
        if ($this->imagen_data) {
            return route('imagen.mostrar', ['id' => $this->id]);
        }
        return $this->url; // Fallback a URL tradicional
    }

    /**
     * Verificar si tiene imagen BLOB
     */
    public function tieneImagenBlob()
    {
        return !empty($this->imagen_data);
    }

    /**
     * Obtener la imagen como base64 (útil para mostrar inline)
     */
    public function getImagenBase64Attribute()
    {
        if ($this->imagen_data && $this->mime_type) {
            // Los datos ya están en base64, solo agregar el prefijo data:
            return 'data:' . $this->mime_type . ';base64,' . $this->imagen_data;
        }
        return null;
    }

    /**
     * Verificar si tiene imagen BLOB válida
     */
    public function hasImageBlob()
    {
        return !empty($this->imagen_data) && !empty($this->mime_type);
    }
}
