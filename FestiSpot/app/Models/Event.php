<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'category',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'repeat_schedule',
        'event_type',
        'venue_name',
        'full_address',
        'city',
        'state',
        'country',
        'postal_code',
        'location_details',
        'capacity',
        'accessible',
        'virtual_platform',
        'event_link',
        'access_code',
        'virtual_password',
        'virtual_instructions',
        'banner_image',
        'gallery_images',
        'videos',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'repeat_schedule' => 'boolean',
        'accessible' => 'boolean',
        'gallery_images' => 'array',
        'videos' => 'array',
    ];

    /**
     * Relación con el usuario creador del evento
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para eventos publicados
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope para eventos del usuario
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Obtener la fecha formateada en español
     */
    public function getFormattedStartDateAttribute()
    {
        Carbon::setLocale('es');
        return $this->start_date->format('d \d\e F \d\e Y');
    }

    /**
     * Obtener el rango de fechas formateado
     */
    public function getDateRangeAttribute()
    {
        Carbon::setLocale('es');
        
        if ($this->start_date->eq($this->end_date)) {
            return $this->start_date->format('d \d\e F \d\e Y');
        }
        
        return $this->start_date->format('d \d\e F') . ' - ' . $this->end_date->format('d \d\e F \d\e Y');
    }

    /**
     * Obtener el rango de horarios formateado
     */
    public function getTimeRangeAttribute()
    {
        return $this->start_time . ' - ' . $this->end_time;
    }

    /**
     * Verificar si el evento es virtual
     */
    public function isVirtual()
    {
        return in_array($this->event_type, ['Virtual', 'Híbrido']);
    }

    /**
     * Verificar si el evento es presencial
     */
    public function isPresential()
    {
        return in_array($this->event_type, ['Presencial', 'Híbrido']);
    }
}
