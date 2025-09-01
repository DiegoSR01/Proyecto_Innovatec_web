<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Registrar asistencia a un evento
     */
    public function attend(Request $request, $eventId)
    {
        $event = Event::find($eventId);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento no encontrado'
            ], 404);
        }

        // Verificar si el evento ya finalizó
        if ($event->fecha_fin < now()) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes registrarte a un evento que ya finalizó'
            ], 400);
        }

        // Verificar si el evento está cancelado
        if ($event->estado === 'cancelado') {
            return response()->json([
                'success' => false,
                'message' => 'No puedes registrarte a un evento cancelado'
            ], 400);
        }

        // Verificar capacidad máxima
        if ($event->capacidad_maxima) {
            $currentAttendees = Asistencia::where('evento_id', $eventId)->count();
            if ($currentAttendees >= $event->capacidad_maxima) {
                return response()->json([
                    'success' => false,
                    'message' => 'El evento ha alcanzado su capacidad máxima'
                ], 400);
            }
        }

        // Verificar si ya está registrado
        $existingAttendance = Asistencia::where('usuario_id', $request->user()->id)
            ->where('evento_id', $eventId)
            ->first();

        if ($existingAttendance) {
            return response()->json([
                'success' => false,
                'message' => 'Ya estás registrado para este evento'
            ], 400);
        }

        // Crear asistencia
        $attendance = Asistencia::create([
            'usuario_id' => $request->user()->id,
            'evento_id' => $eventId,
            'fecha_registro' => now(),
            'estado' => 'confirmado'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Te has registrado exitosamente al evento',
            'data' => $attendance
        ], 201);
    }

    /**
     * Cancelar asistencia a un evento
     */
    public function unattend(Request $request, $eventId)
    {
        $attendance = Asistencia::where('usuario_id', $request->user()->id)
            ->where('evento_id', $eventId)
            ->first();

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'No estás registrado para este evento'
            ], 404);
        }

        $attendance->delete();

        return response()->json([
            'success' => true,
            'message' => 'Has cancelado tu asistencia al evento'
        ]);
    }

    /**
     * Obtener asistentes de un evento
     */
    public function eventAttendees($eventId)
    {
        $event = Event::find($eventId);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento no encontrado'
            ], 404);
        }

        $attendees = Asistencia::with('usuario:id,name,email')
            ->where('evento_id', $eventId)
            ->orderBy('fecha_registro', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'event' => $event->only(['id', 'titulo', 'capacidad_maxima']),
                'attendees_count' => $attendees->count(),
                'attendees' => $attendees
            ]
        ]);
    }

    /**
     * Verificar estado de asistencia del usuario para un evento
     */
    public function attendanceStatus(Request $request, $eventId)
    {
        $attendance = Asistencia::where('usuario_id', $request->user()->id)
            ->where('evento_id', $eventId)
            ->first();

        return response()->json([
            'success' => true,
            'data' => [
                'is_attending' => $attendance ? true : false,
                'attendance' => $attendance
            ]
        ]);
    }
}
