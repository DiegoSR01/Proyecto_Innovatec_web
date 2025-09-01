<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanSuscripcion extends Model
{
    use HasFactory;

    protected $table = 'planes_suscripcion';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_mensual',
        'precio_anual',
        'max_eventos',
        'max_imagenes_por_evento',
        'features',
        'activo',
    ];

    protected $casts = [
        'precio_mensual' => 'decimal:2',
        'precio_anual' => 'decimal:2',
        'features' => 'array',
        'activo' => 'boolean',
    ];

    /**
     * Relación con las suscripciones
     */
    public function suscripciones()
    {
        return $this->hasMany(SuscripcionOrganizador::class, 'plan_id');
    }

    /**
     * Scope para planes activos
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Verificar si el plan tiene una característica específica
     */
    public function tieneFeature($feature)
    {
        return in_array($feature, $this->features ?? []);
    }

    /**
     * Obtener el descuento anual en porcentaje
     */
    public function getDescuentoAnualAttribute()
    {
        if (!$this->precio_mensual || !$this->precio_anual) {
            return 0;
        }

        $precioAnualCalculado = $this->precio_mensual * 12;
        return round((($precioAnualCalculado - $this->precio_anual) / $precioAnualCalculado) * 100);
    }
}
