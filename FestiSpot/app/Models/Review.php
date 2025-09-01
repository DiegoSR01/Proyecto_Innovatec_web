<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'usuario_id',
        'evento_id',
        'calificacion',
        'comentario',
        'moderado',
        'visible',
    ];

    protected $casts = [
        'fecha_review' => 'datetime',
        'moderado' => 'boolean',
        'visible' => 'boolean',
    ];

    /**
     * Relación con el usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Relación con el evento
     */
    public function evento()
    {
        return $this->belongsTo(Event::class, 'evento_id');
    }

    /**
     * Scope para reviews visibles
     */
    public function scopeVisibles($query)
    {
        return $query->where('visible', true);
    }

    /**
     * Scope para reviews moderadas
     */
    public function scopeModeradas($query)
    {
        return $query->where('moderado', true);
    }

    /**
     * Obtener reviews por calificación
     */
    public function scopePorCalificacion($query, $calificacion)
    {
        return $query->where('calificacion', $calificacion);
    }
}
