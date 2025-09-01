<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class SuscripcionOrganizador extends Model
{
    use HasFactory;

    protected $table = 'suscripciones_organizador';

    protected $fillable = [
        'organizador_id',
        'plan_id',
        'fecha_inicio',
        'fecha_vencimiento',
        'estado',
        'precio_pagado',
        'metodo_pago',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_vencimiento' => 'date',
        'precio_pagado' => 'decimal:2',
    ];

    /**
     * Relación con el organizador
     */
    public function organizador()
    {
        return $this->belongsTo(User::class, 'organizador_id');
    }

    /**
     * Relación con el plan
     */
    public function plan()
    {
        return $this->belongsTo(PlanSuscripcion::class, 'plan_id');
    }

    /**
     * Scope para suscripciones activas
     */
    public function scopeActivas($query)
    {
        return $query->where('estado', 'activa')
                    ->where('fecha_vencimiento', '>=', now());
    }

    /**
     * Scope para suscripciones vencidas
     */
    public function scopeVencidas($query)
    {
        return $query->where('fecha_vencimiento', '<', now())
                    ->where('estado', '!=', 'cancelada');
    }

    /**
     * Verificar si la suscripción está activa
     */
    public function estaActiva()
    {
        return $this->estado === 'activa' && $this->fecha_vencimiento >= now();
    }

    /**
     * Obtener días restantes
     */
    public function getDiasRestantesAttribute()
    {
        if (!$this->estaActiva()) {
            return 0;
        }

        return Carbon::now()->diffInDays($this->fecha_vencimiento);
    }

    /**
     * Renovar suscripción
     */
    public function renovar($duracionMeses = 1)
    {
        $this->update([
            'fecha_vencimiento' => Carbon::parse($this->fecha_vencimiento)->addMonths($duracionMeses),
            'estado' => 'activa'
        ]);
    }
}
