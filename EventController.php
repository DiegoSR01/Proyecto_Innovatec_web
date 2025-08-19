<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class EventController extends Controller
{
    public function __construct()
    {
        // Configurar Carbon para español
        Carbon::setLocale('es');
    }
    
    /**
     * Mostrar el formulario para crear un nuevo evento
     */
    public function create()
    {
        // Mantener los datos de la sesión al editar
        return view('create_event');
    }

    /**
     * Procesar y guardar el nombre del evento
     */
    public function storeName(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_description' => 'required|string|max:250',
            'event_category' => 'required|string',
        ]);

        // Guardar en sesión para el flujo
        Session::put('event_basic', [
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'event_category' => $request->event_category,
        ]);
        
        // Redirigir al siguiente paso: fecha
        return redirect()->route('event.date');
    }

    /**
     * Mostrar formulario de fechas
     */
    public function date()
    {
        // Mantener los datos de la sesión al editar
        return view('event_date');
    }

    /**
     * Guardar fechas y horarios
     */
    public function storeDate(Request $request)
    {
        $request->validate([
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'repetir_horario' => 'boolean'
        ]);

        // Guardar en sesión con la clave que usa el resumen y mantener compatibilidad
        Session::put('event_date', [
            'hora_inicio' => $request->hora_inicio,
            'hora_fin'    => $request->hora_fin,
            'fecha_inicio'=> $request->fecha_inicio,
            'fecha_fin'   => $request->fecha_fin,
            'repetir_horario' => $request->boolean('repetir_horario'),
        ]);

        return redirect()->route('event.location');
    }

    /**
     * Alias que coincide con la ruta GET /event/location
     */
    public function showLocation()
    {
        return view('event_location');
    }
    
    /**
     * Almacena los datos de ubicación y redirige a la página de media
     */
    public function storeLocation(Request $request)
    {
        // Validar datos básicos
        $request->validate([
            'tipo_evento' => 'required|in:Presencial,Virtual,Híbrido',
        ]);
        
        // Validaciones específicas según el tipo de evento
        if ($request->tipo_evento == 'Presencial' || $request->tipo_evento == 'Híbrido') {
            $request->validate([
                'nombre_lugar' => 'required',
                'direccion_completa' => 'required',
                'ciudad' => 'required',
                'estado' => 'required',
            ]);
        }
        
        if ($request->tipo_evento == 'Virtual' || $request->tipo_evento == 'Híbrido') {
            $request->validate([
                'event_link' => 'required|url',
            ]);
        }
        
        // Guardar todos los datos en la sesión
        Session::put('event_location', [
            'tipo_evento' => $request->tipo_evento,
            'nombre_lugar' => $request->nombre_lugar,
            'direccion_completa' => $request->direccion_completa,
            'ciudad' => $request->ciudad,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'codigo_postal' => $request->codigo_postal,
            'detalles_ubicacion' => $request->detalles_ubicacion,
            'capacidad' => $request->capacidad,
            'accesible' => $request->boolean('accesible'),
            'plataforma_virtual' => $request->plataforma_virtual,
            'event_link' => $request->event_link,
            'codigo_acceso' => $request->codigo_acceso,
            'password_virtual' => $request->password_virtual,
            'instrucciones_virtuales' => $request->instrucciones_virtuales,
        ]);
        
        return redirect()->route('event.media')->with('success', 'Información de ubicación guardada correctamente');
    }
    
    /**
     * Muestra el formulario de media del evento
     */
    public function showMediaForm()
    {
        $previousData = Session::get('event_location');
        return view('event_media', ['previousData' => $previousData]);
    }
    
    /**
     * Almacena los archivos de media y redirige al resumen
     */
    public function storeMedia(Request $request)
    {
        // Validar archivos de media
        $validated = $request->validate([
            'banner_image' => 'nullable|image|max:5120',
            'gallery_images.*' => 'nullable|image|max:5120',
            'videos.*' => 'nullable|mimes:mp4,avi,mov,wmv|max:51200',
        ]);
        
        // Obtener media existente
        $existingMedia = Session::get('event_media', []);
        
        // Procesar nueva imagen principal
        if ($request->hasFile('banner_image')) {
            $bannerFile = $request->file('banner_image');
            $existingMedia['has_banner'] = true;
            $existingMedia['banner_name'] = $bannerFile->getClientOriginalName();
            // Aquí guardarías el archivo físicamente
            // $bannerPath = $bannerFile->store('events/banners', 'public');
            // $existingMedia['banner_path'] = $bannerPath;
        }
        
        // Procesar nuevas imágenes de galería
        if ($request->hasFile('gallery_images')) {
            if (!isset($existingMedia['gallery_files'])) {
                $existingMedia['gallery_files'] = [];
            }
            
            foreach ($request->file('gallery_images') as $file) {
                $existingMedia['gallery_files'][] = $file->getClientOriginalName();
                // Aquí guardarías cada archivo físicamente
                // $filePath = $file->store('events/gallery', 'public');
            }
            $existingMedia['gallery_count'] = count($existingMedia['gallery_files']);
        }
        
        // Procesar nuevos videos
        if ($request->hasFile('videos')) {
            if (!isset($existingMedia['video_files'])) {
                $existingMedia['video_files'] = [];
            }
            
            foreach ($request->file('videos') as $file) {
                $existingMedia['video_files'][] = $file->getClientOriginalName();
                // Aquí guardarías cada archivo físicamente
                // $filePath = $file->store('events/videos', 'public');
            }
            $existingMedia['video_count'] = count($existingMedia['video_files']);
        }
        
        // Guardar en sesión
        Session::put('event_media', $existingMedia);
        
        return redirect()->route('event.summary')->with('success', 'Media guardada correctamente');
    }
    
    /**
     * Remover tipo completo de media (banner, gallery, videos)
     */
    public function removeMedia(Request $request)
    {
        $tipo = $request->input('tipo');
        $mediaData = Session::get('event_media', []);
        
        switch ($tipo) {
            case 'banner':
                unset($mediaData['has_banner'], $mediaData['banner_name'], $mediaData['banner_path']);
                break;
            case 'gallery':
                unset($mediaData['gallery_files'], $mediaData['gallery_count']);
                break;
            case 'videos':
                unset($mediaData['video_files'], $mediaData['video_count']);
                break;
        }
        
        Session::put('event_media', $mediaData);
        
        return response()->json(['success' => true, 'message' => 'Archivos removidos correctamente']);
    }
    
    /**
     * Remover archivo individual de galería o videos
     */
    public function removeMediaItem(Request $request)
    {
        $tipo = $request->input('tipo');
        $index = $request->input('index');
        $mediaData = Session::get('event_media', []);
        
        if ($tipo === 'gallery' && isset($mediaData['gallery_files'][$index])) {
            unset($mediaData['gallery_files'][$index]);
            $mediaData['gallery_files'] = array_values($mediaData['gallery_files']); // Reindexar
            $mediaData['gallery_count'] = count($mediaData['gallery_files']);
            
            if (empty($mediaData['gallery_files'])) {
                unset($mediaData['gallery_files'], $mediaData['gallery_count']);
            }
        }
        
        if ($tipo === 'videos' && isset($mediaData['video_files'][$index])) {
            unset($mediaData['video_files'][$index]);
            $mediaData['video_files'] = array_values($mediaData['video_files']); // Reindexar
            $mediaData['video_count'] = count($mediaData['video_files']);
            
            if (empty($mediaData['video_files'])) {
                unset($mediaData['video_files'], $mediaData['video_count']);
            }
        }
        
        Session::put('event_media', $mediaData);
        
        return response()->json(['success' => true, 'message' => 'Archivo removido correctamente']);
    }

    /**
     * Muestra el resumen del evento con TODA la información
     */
    public function showSummary()
    {
        // Obtener TODOS los datos de las sesiones
        $basicData = Session::get('event_basic', []);
        $dateData = Session::get('event_date', []);
        $locationData = Session::get('event_location', []);
        $mediaData = Session::get('event_media', []);
        
        // Debug: log de los datos para verificar
        \Log::info('=== DATOS DEL RESUMEN ===');
        \Log::info('Básicos: ', $basicData);
        \Log::info('Fechas: ', $dateData);
        \Log::info('Ubicación: ', $locationData);
        \Log::info('Media: ', $mediaData);
        
        return view('event_summary', [
            'basic' => $basicData,
            'date' => $dateData,
            'location' => $locationData,
            'media' => $mediaData,
            'eventBasic' => $basicData,      // Alias para compatibilidad
            'eventDate' => $dateData,        // Alias para compatibilidad
            'eventLocation' => $locationData, // Alias para compatibilidad
            'eventMedia' => $mediaData       // Alias para compatibilidad
        ]);
    }

    /**
     * Mostrar vista de preview del evento
     */
    public function showPreview()
    {
        // Obtener TODOS los datos de las sesiones
        $basicData = Session::get('event_basic', []);
        $dateData = Session::get('event_date', []);
        $locationData = Session::get('event_location', []);
        $mediaData = Session::get('event_media', []);
        
        // Configurar idioma español para las fechas
        Carbon::setLocale('es');
        
        return view('event_preview', [
            'eventBasic' => $basicData,
            'eventDate' => $dateData,
            'eventLocation' => $locationData,
            'eventMedia' => $mediaData
        ]);
    }
    
    /**
     * Limpiar datos básicos del evento
     */
    public function clearBasic()
    {
        Session::forget('event_basic');
        return response()->json(['success' => true, 'message' => 'Datos básicos limpiados']);
    }
    
    /**
     * Limpiar datos de fecha del evento
     */
    public function clearDate()
    {
        Session::forget('event_date');
        Session::forget('event_date_data'); // Por compatibilidad
        return response()->json(['success' => true, 'message' => 'Datos de fecha limpiados']);
    }
    
    /**
     * Limpiar datos de ubicación del evento
     */
    public function clearLocation()
    {
        Session::forget('event_location');
        return response()->json(['success' => true, 'message' => 'Datos de ubicación limpiados']);
    }
    
    /**
     * Limpiar datos de media del evento
     */
    public function clearMedia()
    {
        Session::forget('event_media');
        return response()->json(['success' => true, 'message' => 'Datos de media limpiados']);
    }
    
    /**
     * Limpiar TODOS los datos del evento y empezar desde cero
     */
    public function clearAll()
    {
        // Limpiar todas las claves de sesión relacionadas con eventos
        $sessionKeys = [
            'event_basic',
            'event_date', 
            'event_date_data',
            'event_location',
            'event_media',
            // Por si hay otras claves que se agreguen en el futuro
            'event_temp',
            'event_draft'
        ];
        
        foreach ($sessionKeys as $key) {
            Session::forget($key);
        }
        
        // Log para debug
        \Log::info('🆕 Nuevo evento - Todas las sesiones limpiadas', [
            'keys_cleared' => $sessionKeys,
            'timestamp' => now()
        ]);
        
        return response()->json([
            'success' => true, 
            'message' => 'Todos los datos del evento limpiados - Listo para nuevo evento',
            'cleared_keys' => count($sessionKeys)
        ]);
    }
}