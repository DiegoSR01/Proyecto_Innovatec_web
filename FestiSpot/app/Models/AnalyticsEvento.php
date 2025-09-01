<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnalyticsEvento extends Model
{
    use HasFactory;

    protected $table = 'analytics_evento';

    protected $fillable = [
        'evento_id',
        'fecha',
        'vistas_totales',
        'vistas_unicas',
        'clicks_reserva',
        'compartidos',
        'favoritos_agregados',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    /**
     * Relación con el evento
     */
    public function evento()
    {
        return $this->belongsTo(Event::class, 'evento_id');
    }

    /**
     * Incrementar vistas totales
     */
    public function incrementarVistas($unica = false)
    {
        $this->increment('vistas_totales');
        
        if ($unica) {
            $this->increment('vistas_unicas');
        }
    }

    /**
     * Incrementar clicks de reserva
     */
    public function incrementarClicksReserva()
    {
        $this->increment('clicks_reserva');
    }

    /**
     * Incrementar compartidos
     */
    public function incrementarCompartidos()
    {
        $this->increment('compartidos');
    }

    /**
     * Incrementar favoritos
     */
    public function incrementarFavoritos()
    {
        $this->increment('favoritos_agregados');
    }

    /**
     * Obtener analytics por rango de fechas
     */
    public static function porRangoFechas($eventoId, $fechaInicio, $fechaFin)
    {
        return static::where('evento_id', $eventoId)
                    ->whereBetween('fecha', [$fechaInicio, $fechaFin])
                    ->get();
    }
}
