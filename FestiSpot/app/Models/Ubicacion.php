<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicaciones';

    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'estado',
        'codigo_postal',
        'pais',
        'latitud',
        'longitud',
        'capacidad_maxima',
        'tipo_venue',
        'facilidades',
        'contacto_venue',
        'telefono_venue',
    ];

    protected $casts = [
        'latitud' => 'decimal:8',
        'longitud' => 'decimal:8',
        'facilidades' => 'array',
    ];

    /**
     * Relación con los eventos
     */
    public function eventos()
    {
        return $this->hasMany(Event::class, 'ubicacion_id');
    }

    /**
     * Obtener la dirección completa
     */
    public function getDireccionCompletaAttribute()
    {
        $direccion = $this->direccion;
        if ($this->ciudad) {
            $direccion .= ', ' . $this->ciudad;
        }
        if ($this->estado) {
            $direccion .= ', ' . $this->estado;
        }
        if ($this->pais) {
            $direccion .= ', ' . $this->pais;
        }
        return $direccion;
    }

    /**
     * Verificar si tiene coordenadas GPS
     */
    public function tieneCoordenadasAttribute()
    {
        return !is_null($this->latitud) && !is_null($this->longitud);
    }
}
