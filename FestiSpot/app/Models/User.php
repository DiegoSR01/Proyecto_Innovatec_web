<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nombre',
        'apellido',
        'email',
        'password',
        'telefono',
        'fecha_nacimiento',
        'genero',
        'avatar_url',
        'rol_id',
        'estado',
        'ultimo_acceso',
        'token_verificacion',
        'email_verificado',
        'tipo_usuario',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'token_verificacion',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'fecha_registro' => 'datetime',
            'ultimo_acceso' => 'datetime',
            'email_verificado' => 'boolean',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con el rol del usuario
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    /**
     * Relación con los eventos organizados por el usuario
     */
    public function eventosOrganizados()
    {
        return $this->hasMany(Event::class, 'organizador_id');
    }

    /**
     * Relación con las asistencias del usuario
     */
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'usuario_id');
    }

    /**
     * Relación con los eventos favoritos del usuario
     */
    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'usuario_id');
    }

    /**
     * Relación con las notificaciones del usuario
     */
    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'usuario_id');
    }

    /**
     * Relación con las reviews del usuario
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'usuario_id');
    }

    /**
     * Relación con las configuraciones del usuario
     */
    public function configuraciones()
    {
        return $this->hasOne(ConfiguracionUsuario::class, 'usuario_id');
    }

    /**
     * Relación con las suscripciones (solo para organizadores)
     */
    public function suscripciones()
    {
        return $this->hasMany(SuscripcionOrganizador::class, 'organizador_id');
    }

    /**
     * Verificar si el usuario es organizador
     */
    public function esOrganizador()
    {
        return $this->rol && $this->rol->nombre === 'organizador';
    }

    /**
     * Verificar si el usuario es admin
     */
    public function esAdmin()
    {
        return $this->rol && $this->rol->nombre === 'admin';
    }

    /**
     * Obtener el nombre completo del usuario
     */
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    /**
     * Mantener compatibilidad con el campo 'name' legacy
     */
    public function getNameAttribute()
    {
        return $this->nombre;
    }

    // Alias para compatibilidad hacia atrás
    public function events()
    {
        return $this->eventosOrganizados();
    }
}
