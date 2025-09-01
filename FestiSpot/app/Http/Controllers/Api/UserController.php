<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Asistencia;
use App\Models\Favorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Obtener perfil del usuario
     */
    public function profile(Request $request)
    {
        $user = $request->user();
        
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Actualizar perfil del usuario
     */
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'tipo_usuario' => 'sometimes|in:asistente,organizador,admin',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $user->update($request->only(['name', 'telefono', 'fecha_nacimiento', 'tipo_usuario']));

        return response()->json([
            'success' => true,
            'message' => 'Perfil actualizado exitosamente',
            'data' => $user
        ]);
    }

    /**
     * Obtener todos los eventos del usuario (como asistente y organizador)
     */
    public function myEvents(Request $request)
    {
        $user = $request->user();
        
        // Eventos organizados
        $organizedEvents = Event::with(['categoria', 'ubicacion'])
            ->where('organizador_id', $user->id)
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        // Eventos a los que asiste
        $attendedEventIds = Asistencia::where('usuario_id', $user->id)
            ->pluck('evento_id');
        
        $attendedEvents = Event::with(['categoria', 'ubicacion', 'organizador'])
            ->whereIn('id', $attendedEventIds)
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'organized_events' => $organizedEvents,
                'attended_events' => $attendedEvents
            ]
        ]);
    }

    /**
     * Obtener eventos organizados por el usuario
     */
    public function organizedEvents(Request $request)
    {
        $user = $request->user();
        
        $events = Event::with(['categoria', 'ubicacion', 'asistencias'])
            ->where('organizador_id', $user->id)
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    /**
     * Obtener eventos a los que asiste el usuario
     */
    public function attendedEvents(Request $request)
    {
        $user = $request->user();
        
        $attendedEventIds = Asistencia::where('usuario_id', $user->id)
            ->pluck('evento_id');
        
        $events = Event::with(['categoria', 'ubicacion', 'organizador'])
            ->whereIn('id', $attendedEventIds)
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    /**
     * Obtener eventos favoritos del usuario
     */
    public function favoriteEvents(Request $request)
    {
        $user = $request->user();
        
        $favoriteEventIds = Favorito::where('usuario_id', $user->id)
            ->pluck('evento_id');
        
        $events = Event::with(['categoria', 'ubicacion', 'organizador'])
            ->whereIn('id', $favoriteEventIds)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }
}
