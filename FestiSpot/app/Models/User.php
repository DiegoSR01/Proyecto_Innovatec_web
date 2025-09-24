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
        'avatar_data', // Datos binarios del avatar (BLOB)
        'avatar_mime_type', // Tipo MIME del avatar
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
     * Obtener la URL del avatar o una imagen por defecto
     */
    public function getAvatarImageAttribute()
    {
        // Prioridad: BLOB avatar -> archivo avatar -> null
        if ($this->hasAvatarBlob()) {
            return route('avatar.show', ['id' => $this->id]);
        }
        
        if ($this->avatar_url && file_exists(public_path($this->avatar_url))) {
            return asset($this->avatar_url);
        }
        return null; // Return null if no avatar, will use initials instead
    }

    /**
     * Obtener el avatar del usuario como base64 para mostrar en HTML
     */
    public function getAvatarBase64Attribute()
    {
        if ($this->avatar_data && $this->avatar_mime_type) {
            return 'data:' . $this->avatar_mime_type . ';base64,' . base64_encode($this->avatar_data);
        }
        return null;
    }

    /**
     * Verificar si el usuario tiene avatar BLOB
     */
    public function hasAvatarBlob()
    {
        return !empty($this->avatar_data) && !empty($this->avatar_mime_type);
    }

    /**
     * Obtener la inicial del usuario
     */
    public function getInitialAttribute()
    {
        return strtoupper(substr($this->nombre ?? $this->name ?? 'U', 0, 1));
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
