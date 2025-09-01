<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';

    protected $fillable = [
        'usuario_id',
        'evento_id',
        'estado',
        'numero_acompanantes',
        'codigo_qr',
        'notas_usuario',
        'fecha_cancelacion',
        'motivo_cancelacion',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
        'fecha_cancelacion' => 'datetime',
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
     * Scope para asistencias confirmadas
     */
    public function scopeConfirmadas($query)
    {
        return $query->where('estado', 'confirmada');
    }

    /**
     * Scope para asistencias que efectivamente asistieron
     */
    public function scopeAsistieron($query)
    {
        return $query->where('estado', 'asistio');
    }

    /**
     * Generar código QR único
     */
    public static function generarCodigoQR()
    {
        do {
            $codigo = strtoupper(substr(md5(uniqid()), 0, 10));
        } while (self::where('codigo_qr', $codigo)->exists());

        return $codigo;
    }
}
