<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Obtener notificaciones del usuario
     */
    public function index(Request $request)
    {
        $notifications = Notificacion::where('usuario_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $unreadCount = Notificacion::where('usuario_id', $request->user()->id)
            ->where('leida', false)
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'notifications' => $notifications,
                'unread_count' => $unreadCount
            ]
        ]);
    }

    /**
     * Marcar notificación como leída
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = Notificacion::where('id', $id)
            ->where('usuario_id', $request->user()->id)
            ->first();

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notificación no encontrada'
            ], 404);
        }

        $notification->update(['leida' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Notificación marcada como leída',
            'data' => $notification
        ]);
    }

    /**
     * Marcar todas las notificaciones como leídas
     */
    public function markAllAsRead(Request $request)
    {
        $updated = Notificacion::where('usuario_id', $request->user()->id)
            ->where('leida', false)
            ->update(['leida' => true]);

        return response()->json([
            'success' => true,
            'message' => "Se marcaron {$updated} notificaciones como leídas"
        ]);
    }

    /**
     * Eliminar notificación
     */
    public function destroy(Request $request, $id)
    {
        $notification = Notificacion::where('id', $id)
            ->where('usuario_id', $request->user()->id)
            ->first();

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notificación no encontrada'
            ], 404);
        }

        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notificación eliminada exitosamente'
        ]);
    }
}
