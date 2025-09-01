<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Review;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Obtener reseñas de un evento
     */
    public function eventReviews($eventId)
    {
        $event = Event::find($eventId);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento no encontrado'
            ], 404);
        }

        $reviews = Review::with('usuario:id,name')
            ->where('evento_id', $eventId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $averageRating = Review::where('evento_id', $eventId)->avg('calificacion');

        return response()->json([
            'success' => true,
            'data' => [
                'event' => $event->only(['id', 'titulo']),
                'average_rating' => round($averageRating, 1),
                'reviews_count' => Review::where('evento_id', $eventId)->count(),
                'reviews' => $reviews
            ]
        ]);
    }

    /**
     * Crear una nueva reseña
     */
    public function store(Request $request, $eventId)
    {
        $event = Event::find($eventId);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento no encontrado'
            ], 404);
        }

        // Verificar que el usuario haya asistido al evento
        $attendance = Asistencia::where('usuario_id', $request->user()->id)
            ->where('evento_id', $eventId)
            ->first();

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Solo puedes reseñar eventos a los que hayas asistido'
            ], 403);
        }

        // Verificar que el evento ya haya finalizado
        if ($event->fecha_fin > now()) {
            return response()->json([
                'success' => false,
                'message' => 'Solo puedes reseñar eventos que ya hayan finalizado'
            ], 400);
        }

        // Verificar si ya existe una reseña del usuario para este evento
        $existingReview = Review::where('usuario_id', $request->user()->id)
            ->where('evento_id', $eventId)
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'Ya has reseñado este evento'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'calificacion' => 'required|integer|between:1,5',
            'comentario' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $review = Review::create([
            'usuario_id' => $request->user()->id,
            'evento_id' => $eventId,
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
        ]);

        $review->load('usuario:id,name');

        return response()->json([
            'success' => true,
            'message' => 'Reseña creada exitosamente',
            'data' => $review
        ], 201);
    }

    /**
     * Actualizar una reseña
     */
    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Reseña no encontrada'
            ], 404);
        }

        // Verificar que el usuario sea el propietario de la reseña
        if ($review->usuario_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos para editar esta reseña'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'calificacion' => 'sometimes|integer|between:1,5',
            'comentario' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $review->update($request->only(['calificacion', 'comentario']));
        $review->load('usuario:id,name');

        return response()->json([
            'success' => true,
            'message' => 'Reseña actualizada exitosamente',
            'data' => $review
        ]);
    }

    /**
     * Eliminar una reseña
     */
    public function destroy(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Reseña no encontrada'
            ], 404);
        }

        // Verificar que el usuario sea el propietario de la reseña
        if ($review->usuario_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos para eliminar esta reseña'
            ], 403);
        }

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reseña eliminada exitosamente'
        ]);
    }

    /**
     * Obtener reseñas del usuario
     */
    public function userReviews(Request $request)
    {
        $reviews = Review::with(['evento:id,titulo', 'usuario:id,name'])
            ->where('usuario_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $reviews
        ]);
    }
}
