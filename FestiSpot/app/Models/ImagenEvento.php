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
}
