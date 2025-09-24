<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ImagenEvento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    /**
     * Mostrar una imagen desde la base de datos (BLOB)
     */
    public function mostrar($id)
    {
        $imagen = ImagenEvento::findOrFail($id);
        
        if (!$imagen->imagen_data) {
            // Si no hay datos BLOB, redirigir a la URL tradicional o mostrar imagen por defecto
            if ($imagen->url) {
                return redirect($imagen->url);
            }
            abort(404, 'Imagen no encontrada');
        }

        // Decodificar base64 a datos binarios para servir
        $binaryData = base64_decode($imagen->imagen_data);
        
        return response($binaryData)
            ->header('Content-Type', $imagen->mime_type ?? 'image/jpeg')
            ->header('Cache-Control', 'public, max-age=3600') // Cache por 1 hora
            ->header('Content-Disposition', 'inline');
    }

    /**
     * Subir una imagen y guardarla como BLOB
     */
    public function subir(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|max:5120', // Máximo 5MB
            'evento_id' => 'required|exists:events,id',
            'tipo' => 'required|in:principal,galeria,thumbnail',
            'alt_text' => 'nullable|string|max:200'
        ]);

        $file = $request->file('imagen');
        
        // Leer el archivo como datos binarios
        $imageData = file_get_contents($file->getPathname());
        $mimeType = $file->getMimeType();
        $size = $file->getSize();

        // Crear registro en la base de datos
        $imagen = ImagenEvento::create([
            'evento_id' => $request->evento_id,
            'imagen_data' => $imageData,
            'mime_type' => $mimeType,
            'tipo' => $request->tipo,
            'alt_text' => $request->alt_text,
            'tamaño_kb' => round($size / 1024),
            'formato' => $file->getClientOriginalExtension(),
        ]);

        return response()->json([
            'success' => true,
            'imagen_id' => $imagen->id,
            'url' => $imagen->image_url,
            'message' => 'Imagen subida exitosamente'
        ]);
    }

    /**
     * Eliminar una imagen
     */
    public function eliminar($id)
    {
        $imagen = ImagenEvento::findOrFail($id);
        $imagen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Imagen eliminada exitosamente'
        ]);
    }

    /**
     * Mostrar avatar de usuario desde BLOB
     */
    public function mostrarAvatar($id)
    {
        $user = User::findOrFail($id);
        
        if (!$user->avatar_data || !$user->avatar_mime_type) {
            // Devolver imagen por defecto o error 404
            if (file_exists(public_path('images/default-avatar.png'))) {
                return response()->file(public_path('images/default-avatar.png'));
            }
            abort(404, 'Avatar no encontrado');
        }
        
        return response($user->avatar_data)
            ->header('Content-Type', $user->avatar_mime_type)
            ->header('Cache-Control', 'public, max-age=3600'); // Cache por 1 hora
    }
}
