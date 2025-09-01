<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConfiguracionUsuario extends Model
{
    use HasFactory;

    protected $table = 'configuraciones_usuario';

    protected $fillable = [
        'usuario_id',
        'notificaciones_push',
        'notificaciones_email',
        'categorias_favoritas',
        'radio_busqueda_km',
        'idioma',
        'tema',
    ];

    protected $casts = [
        'notificaciones_push' => 'boolean',
        'notificaciones_email' => 'boolean',
        'categorias_favoritas' => 'array',
    ];

    /**
     * Relación con el usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
