<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Listar todas las ubicaciones
     */
    public function index()
    {
        $locations = Ubicacion::all();

        return response()->json([
            'success' => true,
            'data' => $locations
        ]);
    }

    /**
     * Mostrar una ubicación específica
     */
    public function show($id)
    {
        $location = Ubicacion::with(['eventos' => function($query) {
            $query->with(['organizador', 'categoria'])->orderBy('fecha_inicio', 'desc');
        }])->find($id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Ubicación no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $location
        ]);
    }
}
