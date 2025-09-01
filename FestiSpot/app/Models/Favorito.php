<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorito extends Model
{
    use HasFactory;

    protected $table = 'favoritos';

    protected $fillable = [
        'usuario_id',
        'evento_id',
    ];

    protected $casts = [
        'fecha_agregado' => 'datetime',
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
}
