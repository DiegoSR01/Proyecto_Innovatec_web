<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Listar todas las categorías
     */
    public function index()
    {
        $categories = Categoria::all();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Mostrar una categoría específica
     */
    public function show($id)
    {
        $category = Categoria::with(['eventos' => function($query) {
            $query->with(['organizador', 'ubicacion'])->orderBy('fecha_inicio', 'desc');
        }])->find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }
}
