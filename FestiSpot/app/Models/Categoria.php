<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'descripcion',
        'icono',
        'color',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Relación con los eventos
     */
    public function eventos()
    {
        return $this->hasMany(Event::class, 'categoria_id');
    }

    /**
     * Scope para categorías activas
     */
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }
}
