<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'descripcion',
        'permisos',
    ];

    protected $casts = [
        'permisos' => 'array',
    ];

    /**
     * Relación con los usuarios
     */
    public function usuarios()
    {
        return $this->hasMany(User::class, 'rol_id');
    }

    /**
     * Verificar si el rol tiene un permiso específico
     */
    public function tienePermiso($permiso)
    {
        if (in_array('*', $this->permisos ?? [])) {
            return true;
        }

        return in_array($permiso, $this->permisos ?? []);
    }
}
