<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Favorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Listar todos los eventos (públicos)
     */
    public function index(Request $request)
    {
        $query = Event::with(['organizador', 'categoria', 'ubicacion']);

        // Filtros opcionales
        if ($request->has('fecha_inicio')) {
            $query->whereDate('fecha_inicio', '>=', $request->fecha_inicio);
        }

        if ($request->has('fecha_fin')) {
            $query->whereDate('fecha_fin', '<=', $request->fecha_fin);
        }

        if ($request->has('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->has('ubicacion_id')) {
            $query->where('ubicacion_id', $request->ubicacion_id);
        }

        if ($request->has('estado')) {
            $query->where('estado', $request->estado);
        }

        // Paginación
        $perPage = $request->get('per_page', 10);
        $events = $query->orderBy('fecha_inicio', 'desc')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    /**
     * Mostrar un evento específico
     */
    public function show($id)
    {
        $event = Event::with(['organizador', 'categoria', 'ubicacion', 'asistencias.usuario'])->find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }

    /**
     * Crear un nuevo evento
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date|after:now',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'categoria_id' => 'required|exists:categorias,id',
            'capacidad_maxima' => 'nullable|integer|min:1',
            'precio' => 'nullable|numeric|min:0',
            'imagen_url' => 'nullable|url',
            'estado' => 'required|in:activo,cancelado,finalizado',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $event = Event::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => Carbon::parse($request->fecha_inicio),
            'fecha_fin' => Carbon::parse($request->fecha_fin),
            'ubicacion_id' => $request->ubicacion_id,
            'categoria_id' => $request->categoria_id,
            'organizador_id' => $request->user()->id,
            'capacidad_maxima' => $request->capacidad_maxima,
            'precio' => $request->precio,
            'imagen_url' => $request->imagen_url,
            'estado' => $request->estado,
        ]);

        $event->load(['organizador', 'categoria', 'ubicacion']);

        return response()->json([
            'success' => true,
            'message' => 'Evento creado exitosamente',
            'data' => $event
        ], 201);
    }

    /**
     * Actualizar un evento
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento no encontrado'
            ], 404);
        }

        // Verificar que el usuario sea el organizador del evento
        if ($event->organizador_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos para editar este evento'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'fecha_inicio' => 'sometimes|date',
            'fecha_fin' => 'sometimes|date|after:fecha_inicio',
            'ubicacion_id' => 'sometimes|exists:ubicaciones,id',
            'categoria_id' => 'sometimes|exists:categorias,id',
            'capacidad_maxima' => 'nullable|integer|min:1',
            'precio' => 'nullable|numeric|min:0',
            'imagen_url' => 'nullable|url',
            'estado' => 'sometimes|in:activo,cancelado,finalizado',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $updateData = $request->only([
            'titulo', 'descripcion', 'fecha_inicio', 'fecha_fin',
            'ubicacion_id', 'categoria_id', 'capacidad_maxima',
            'precio', 'imagen_url', 'estado'
        ]);

        if (isset($updateData['fecha_inicio'])) {
            $updateData['fecha_inicio'] = Carbon::parse($updateData['fecha_inicio']);
        }

        if (isset($updateData['fecha_fin'])) {
            $updateData['fecha_fin'] = Carbon::parse($updateData['fecha_fin']);
        }

        $event->update($updateData);
        $event->load(['organizador', 'categoria', 'ubicacion']);

        return response()->json([
            'success' => true,
            'message' => 'Evento actualizado exitosamente',
            'data' => $event
        ]);
    }

    /**
     * Eliminar un evento
     */
    public function destroy(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento no encontrado'
            ], 404);
        }

        // Verificar que el usuario sea el organizador del evento
        if ($event->organizador_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos para eliminar este evento'
            ], 403);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Evento eliminado exitosamente'
        ]);
    }

    /**
     * Buscar eventos
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        if (empty($query)) {
            return response()->json([
                'success' => false,
                'message' => 'Parámetro de búsqueda requerido'
            ], 400);
        }

        $events = Event::with(['organizador', 'categoria', 'ubicacion'])
            ->where('titulo', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    /**
     * Eventos por categoría
     */
    public function byCategory($categoryId)
    {
        $events = Event::with(['organizador', 'categoria', 'ubicacion'])
            ->where('categoria_id', $categoryId)
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    /**
     * Eventos por ubicación
     */
    public function byLocation($locationId)
    {
        $events = Event::with(['organizador', 'categoria', 'ubicacion'])
            ->where('ubicacion_id', $locationId)
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    /**
     * Agregar evento a favoritos
     */
    public function addToFavorites(Request $request, $eventId)
    {
        $event = Event::find($eventId);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento no encontrado'
            ], 404);
        }

        $favorito = Favorito::firstOrCreate([
            'usuario_id' => $request->user()->id,
            'evento_id' => $eventId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Evento agregado a favoritos',
            'data' => $favorito
        ]);
    }

    /**
     * Remover evento de favoritos
     */
    public function removeFromFavorites(Request $request, $eventId)
    {
        $favorito = Favorito::where('usuario_id', $request->user()->id)
            ->where('evento_id', $eventId)
            ->first();

        if (!$favorito) {
            return response()->json([
                'success' => false,
                'message' => 'El evento no está en favoritos'
            ], 404);
        }

        $favorito->delete();

        return response()->json([
            'success' => true,
            'message' => 'Evento removido de favoritos'
        ]);
    }
}
