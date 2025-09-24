<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Categoria;
use App\Models\ImagenEvento;

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
        // Obtener categorías activas de la base de datos
        $categorias = Categoria::where('activo', true)->get();
        
        return view('create_event', compact('categorias'));
    }
    
    /**
     * Mostrar mis eventos
     */
    public function myEvents()
    {
        // Usar usuario fijo para pruebas (ID 1)
        $userId = 1;

        // Obtener los eventos del usuario usando la nueva estructura, incluyendo las imágenes
        $events = Event::where('organizador_id', $userId)
                      ->with(['imagenes' => function($query) {
                          $query->where('tipo', 'principal');
                      }])
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        // Migrar imágenes legacy a BLOB automáticamente
        foreach ($events as $event) {
            if ($event->banner_image && !$event->imagenes->where('tipo', 'principal')->count()) {
                Log::info("Detectado evento con imagen legacy, migrando: Evento {$event->id}");
                $this->migrarImagenLegacyABlob($event);
            }
        }
        
        // Recargar eventos después de posibles migraciones
        $events = Event::where('organizador_id', $userId)
                      ->with(['imagenes' => function($query) {
                          $query->where('tipo', 'principal');
                      }])
                      ->orderBy('created_at', 'desc')
                      ->get();
                      
        // Obtener categorías activas para los filtros
        $categorias = Categoria::where('activo', true)->get();

        return view('mis_eventos_new', compact('events', 'categorias'));
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
        Log::info('=== storeMedia iniciado ===');
        Log::info('Archivos recibidos en request:', [
            'has_banner_image' => $request->hasFile('banner_image'),
            'has_gallery_images' => $request->hasFile('gallery_images'),
            'has_videos' => $request->hasFile('videos'),
            'all_files' => $request->allFiles()
        ]);
        
        // Validar archivos de media
        try {
            $validated = $request->validate([
                'banner_image' => 'nullable|image|max:5120',
                'gallery_images.*' => 'nullable|image|max:5120',
                'videos.*' => 'nullable|mimes:mp4,avi,mov,wmv|max:51200',
            ]);
            Log::info('Validación exitosa');
        } catch (\Exception $e) {
            Log::error('Error de validación: ' . $e->getMessage());
            return back()->withErrors('Error de validación: ' . $e->getMessage())->withInput();
        }
        
        // Obtener media existente
        $existingMedia = Session::get('event_media', []);
        Log::info('Media existente en sesión:', $existingMedia);
        
        // Procesar nueva imagen principal
        if ($request->hasFile('banner_image')) {
            $banner = $request->file('banner_image');
            Log::info('Procesando banner image:', [
                'name' => $banner->getClientOriginalName(),
                'size' => $banner->getSize(),
                'mime' => $banner->getMimeType()
            ]);
            
            $existingMedia['banner_name'] = $banner->getClientOriginalName();
            $bannerPath = $banner->store('temp', 'public');
            $existingMedia['banner_path'] = $bannerPath;
            $existingMedia['has_banner'] = true;
            
            Log::info('Banner guardado en:', [
                'path' => $bannerPath,
                'full_path' => storage_path('app/public/' . $bannerPath)
            ]);
        } else {
            Log::warning('No se recibió banner_image en el request');
        }
        
        // Procesar nuevas imágenes de galería
        if ($request->hasFile('gallery_images')) {
            if (!isset($existingMedia['gallery_files'])) {
                $existingMedia['gallery_files'] = [];
            }
            if (!isset($existingMedia['gallery_paths'])) {
                $existingMedia['gallery_paths'] = [];
            }
            
            foreach ($request->file('gallery_images') as $file) {
                $existingMedia['gallery_files'][] = $file->getClientOriginalName();
                // Guardar archivo temporalmente para convertir a BLOB después
                $galleryPath = $file->store('events/gallery', 'public');
                $existingMedia['gallery_paths'][] = $galleryPath;
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
        
        Log::info('=== storeMedia completado ===');
        Log::info('Datos finales guardados en sesión:', $existingMedia);
        
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
        Log::info('=== DATOS DEL RESUMEN ===');
        Log::info('Básicos: ', $basicData);
        Log::info('Fechas: ', $dateData);
        Log::info('Ubicación: ', $locationData);
        Log::info('Media: ', $mediaData);
        
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
     * Limpiar TODA la información del evento de la sesión
     */
    public function clearAll(Request $request)
    {
        try {
            // Limpiar todas las sesiones relacionadas con eventos
            $request->session()->forget([
                'event_basic',
                'event_date', 
                'event_location',
                'event_media'
            ]);
            
            // Opcional: limpiar toda la sesión si prefieres
            // $request->session()->flush();
            
            return response()->json([
                'success' => true,
                'message' => 'Toda la información del evento ha sido limpiada correctamente'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al limpiar la información: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Guardar el evento final en la base de datos
     */
    public function store(Request $request)
    {
        try {
            // Verificar que hay datos en sesión
            $basicData = Session::get('event_basic', []);
            $dateData = Session::get('event_date', []);
            $locationData = Session::get('event_location', []);
            $mediaData = Session::get('event_media', []);

            if (empty($basicData) || empty($dateData) || empty($locationData)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Faltan datos del evento. Por favor completa todos los pasos.'
                ], 400);
            }

            // Debug temporal - verificar datos
            if (empty($basicData['event_category'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'La categoría del evento es requerida. Datos recibidos: ' . json_encode($basicData)
                ], 400);
            }

            // Usar usuario fijo para pruebas (ID 1)
            $userId = 1; // User::first()->id;

            // Preparar los datos para guardar
            $eventData = [
                'organizador_id' => $userId,
                'titulo' => $basicData['event_name'],
                'descripcion' => $basicData['event_description'],
                'category' => $basicData['event_category'] ?? 'General',
                'fecha_inicio' => $dateData['fecha_inicio'] . ' ' . $dateData['hora_inicio'],
                'fecha_fin' => $dateData['fecha_fin'] . ' ' . $dateData['hora_fin'],
                'start_time' => $dateData['hora_inicio'],
                'end_time' => $dateData['hora_fin'],
                'repeat_schedule' => $dateData['repetir_horario'] ?? false,
                'event_type' => $locationData['tipo_evento'],
                'venue_name' => $locationData['nombre_lugar'] ?? null,
                'full_address' => $locationData['direccion_completa'] ?? null,
                'city' => $locationData['ciudad'] ?? null,
                'state' => $locationData['estado'] ?? null,
                'country' => $locationData['pais'] ?? null,
                'postal_code' => $locationData['codigo_postal'] ?? null,
                'location_details' => $locationData['detalles_ubicacion'] ?? null,
                'capacity' => $locationData['capacidad'] ?? null,
                'accessible' => $locationData['accesible'] ?? false,
                'virtual_platform' => $locationData['plataforma_virtual'] ?? null,
                'event_link' => $locationData['event_link'] ?? null,
                'access_code' => $locationData['codigo_acceso'] ?? null,
                'virtual_password' => $locationData['password_virtual'] ?? null,
                'virtual_instructions' => $locationData['instrucciones_virtuales'] ?? null,
                'status' => $request->input('status', 'published')
            ];

            // Procesar archivos de media si existen
            if (!empty($mediaData)) {
                $eventData['banner_image'] = $mediaData['banner_name'] ?? null;
                $eventData['gallery_images'] = $mediaData['gallery_files'] ?? null;
                $eventData['videos'] = $mediaData['video_files'] ?? null;
            }

            // Crear el evento
            $event = Event::create($eventData);

            // Debug: Log de datos de media
            Log::info('Datos de media recibidos:', $mediaData);

            // Procesar y guardar imágenes como BLOB (base64)
            if (!empty($mediaData['banner_path'])) {
                // Leer el archivo banner desde el storage temporal
                $bannerPath = storage_path('app/public/' . $mediaData['banner_path']);
                if (file_exists($bannerPath)) {
                    try {
                        // Optimizar la imagen antes de guardarla
                        $imagenOptimizada = $this->optimizarImagen($bannerPath, $mediaData['banner_name'] ?? '');
                        
                        if ($imagenOptimizada) {
                            // Crear registro en imagenes_evento con imagen optimizada
                            ImagenEvento::create([
                                'evento_id' => $event->id,
                                'imagen_data' => $imagenOptimizada['base64'],
                                'mime_type' => $imagenOptimizada['mime_type'],
                                'tipo' => 'principal',
                                'tamaño_kb' => $imagenOptimizada['size_kb'],
                                'formato' => $imagenOptimizada['extension'],
                            ]);
                        } else {
                            // Fallback: usar imagen original pero verificar tamaño
                            $imageData = file_get_contents($bannerPath);
                            $imagenBase64 = base64_encode($imageData);
                            
                            // Verificar tamaño antes de guardar
                            if (strlen($imagenBase64) > 16000000) { // ~16MB limit
                                Log::warning("Imagen demasiado grande, saltando: " . $bannerPath);
                            } else {
                                $mimeType = mime_content_type($bannerPath);
                                
                                ImagenEvento::create([
                                    'evento_id' => $event->id,
                                    'imagen_data' => $imagenBase64,
                                    'mime_type' => $mimeType,
                                    'tipo' => 'principal',
                                    'tamaño_kb' => round(filesize($bannerPath) / 1024),
                                    'formato' => pathinfo($bannerPath, PATHINFO_EXTENSION),
                                ]);
                            }
                        }
                    } catch (\Exception $e) {
                        Log::error('Error al procesar imagen principal: ' . $e->getMessage());
                        // Continuar sin imagen en caso de error
                    }
                    
                    // Eliminar archivo temporal
                    if (file_exists($bannerPath)) {
                        unlink($bannerPath);
                    }
                }
            }
            
            // Procesar imágenes de galería si existen
            if (!empty($mediaData['gallery_paths'])) {
                foreach ($mediaData['gallery_paths'] as $galleryPath) {
                    $fullPath = storage_path('app/public/' . $galleryPath);
                    if (file_exists($fullPath)) {
                        try {
                            // Optimizar cada imagen de galería
                            $imagenOptimizada = $this->optimizarImagen($fullPath);
                            
                            if ($imagenOptimizada) {
                                ImagenEvento::create([
                                    'evento_id' => $event->id,
                                    'imagen_data' => $imagenOptimizada['base64'],
                                    'mime_type' => $imagenOptimizada['mime_type'],
                                    'tipo' => 'galeria',
                                    'tamaño_kb' => $imagenOptimizada['size_kb'],
                                    'formato' => $imagenOptimizada['extension'],
                                ]);
                            } else {
                                // Fallback: usar imagen original pero verificar tamaño
                                $imageData = file_get_contents($fullPath);
                                $imagenBase64 = base64_encode($imageData);
                                
                                // Verificar tamaño antes de guardar
                                if (strlen($imagenBase64) <= 16000000) { // ~16MB limit
                                    $mimeType = mime_content_type($fullPath);
                                    
                                    ImagenEvento::create([
                                        'evento_id' => $event->id,
                                        'imagen_data' => $imagenBase64,
                                        'mime_type' => $mimeType,
                                        'tipo' => 'galeria',
                                        'tamaño_kb' => round(filesize($fullPath) / 1024),
                                        'formato' => pathinfo($fullPath, PATHINFO_EXTENSION),
                                    ]);
                                } else {
                                    Log::warning("Imagen de galería demasiado grande, saltando: " . $fullPath);
                                }
                            }
                        } catch (\Exception $e) {
                            Log::error('Error al procesar imagen de galería: ' . $e->getMessage());
                            // Continuar con la siguiente imagen
                        }
                        
                        // Eliminar archivo temporal
                        if (file_exists($fullPath)) {
                            unlink($fullPath);
                        }
                    }
                }
            }

            // Limpiar las sesiones después de guardar exitosamente
            Session::forget(['event_basic', 'event_date', 'event_location', 'event_media']);

            return response()->json([
                'success' => true,
                'message' => 'Evento creado exitosamente',
                'event_id' => $event->id,
                'redirect_url' => route('mis.eventos')
            ]);

        } catch (\Exception $e) {
            Log::error('Error al crear evento: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el evento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar un evento específico
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    /**
     * Dashboard - mostrar eventos activos dinámicos
     */
    public function dashboard()
    {
        // Obtener eventos activos (próximos y en curso)
        $eventosActivos = Event::where('fecha_inicio', '>=', now())
                               ->orWhere(function($query) {
                                   $query->where('fecha_inicio', '<=', now())
                                         ->where('fecha_fin', '>=', now());
                               })
                               ->orderBy('fecha_inicio', 'asc')
                               ->take(6) // Mostrar solo los primeros 6
                               ->get();
                               
        // Contar total de eventos activos
        $totalEventosActivos = Event::where('fecha_inicio', '>=', now())
                                   ->orWhere(function($query) {
                                       $query->where('fecha_inicio', '<=', now())
                                             ->where('fecha_fin', '>=', now());
                                   })
                                   ->count();

        return view('welcome', compact('eventosActivos', 'totalEventosActivos'));
    }

    /**
     * Eliminar un evento
     */
    public function destroy(Event $event)
    {
        try {
            // Verificar que el usuario es el propietario del evento (para pruebas usamos ID 1)
            if ($event->organizador_id !== 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'No tienes permiso para eliminar este evento.'
                ], 403);
            }

            // Eliminar archivos asociados si existen
            if ($event->banner_image) {
                Storage::disk('public')->delete('events/banners/' . $event->banner_image);
            }

            if ($event->gallery_images) {
                foreach ($event->gallery_images as $image) {
                    Storage::disk('public')->delete('events/gallery/' . $image);
                }
            }

            if ($event->videos) {
                foreach ($event->videos as $video) {
                    Storage::disk('public')->delete('events/videos/' . $video);
                }
            }

            $event->delete();

            return response()->json([
                'success' => true,
                'message' => 'Evento eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el evento: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Optimizar imagen para reducir su tamaño antes de almacenarla como base64
     */
    private function optimizarImagen($imagePath, $originalName = '')
    {
        try {
            // Verificar que el archivo existe
            if (!file_exists($imagePath)) {
                return false;
            }
            
            // Obtener información de la imagen
            $imageInfo = getimagesize($imagePath);
            if (!$imageInfo) {
                return false;
            }
            
            $mimeType = $imageInfo['mime'];
            $width = $imageInfo[0];
            $height = $imageInfo[1];
            
            // Determinar si necesita redimensionado (máximo 1200x800)
            $maxWidth = 1200;
            $maxHeight = 800;
            $needsResize = ($width > $maxWidth || $height > $maxHeight);
            
            // Crear imagen desde el archivo original
            $sourceImage = null;
            switch ($mimeType) {
                case 'image/jpeg':
                    $sourceImage = imagecreatefromjpeg($imagePath);
                    $extension = 'jpg';
                    break;
                case 'image/png':
                    $sourceImage = imagecreatefrompng($imagePath);
                    $extension = 'png';
                    break;
                case 'image/gif':
                    $sourceImage = imagecreatefromgif($imagePath);
                    $extension = 'gif';
                    break;
                case 'image/webp':
                    $sourceImage = imagecreatefromwebp($imagePath);
                    $extension = 'webp';
                    break;
                default:
                    return false;
            }
            
            if (!$sourceImage) {
                return false;
            }
            
            // Calcular nuevas dimensiones si es necesario
            if ($needsResize) {
                $aspectRatio = $width / $height;
                
                if ($width > $height) {
                    $newWidth = min($width, $maxWidth);
                    $newHeight = intval($newWidth / $aspectRatio);
                } else {
                    $newHeight = min($height, $maxHeight);
                    $newWidth = intval($newHeight * $aspectRatio);
                }
            } else {
                $newWidth = $width;
                $newHeight = $height;
            }
            
            // Crear nueva imagen redimensionada
            $optimizedImage = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preservar transparencia para PNG y GIF
            if ($mimeType === 'image/png' || $mimeType === 'image/gif') {
                imagecolortransparent($optimizedImage, imagecolorallocatealpha($optimizedImage, 0, 0, 0, 127));
                imagealphablending($optimizedImage, false);
                imagesavealpha($optimizedImage, true);
            }
            
            // Redimensionar la imagen
            imagecopyresampled(
                $optimizedImage, $sourceImage,
                0, 0, 0, 0,
                $newWidth, $newHeight, $width, $height
            );
            
            // Generar la imagen optimizada en memoria
            ob_start();
            switch ($mimeType) {
                case 'image/jpeg':
                    imagejpeg($optimizedImage, null, 85); // 85% calidad
                    break;
                case 'image/png':
                    imagepng($optimizedImage, null, 6); // Compresión nivel 6
                    break;
                case 'image/gif':
                    imagegif($optimizedImage, null);
                    break;
                case 'image/webp':
                    imagewebp($optimizedImage, null, 85);
                    break;
            }
            $optimizedImageData = ob_get_clean();
            
            // Limpiar memoria
            imagedestroy($sourceImage);
            imagedestroy($optimizedImage);
            
            // Convertir a base64
            $base64 = base64_encode($optimizedImageData);
            
            // Verificar que el resultado sea más pequeño que el límite
            if (strlen($base64) > 16000000) { // ~16MB limit
                Log::warning("Imagen optimizada aún es demasiado grande: " . strlen($base64) . " bytes");
                return false;
            }
            
            return [
                'base64' => $base64,
                'mime_type' => $mimeType,
                'size_kb' => round(strlen($optimizedImageData) / 1024, 2),
                'extension' => $extension,
                'original_size' => filesize($imagePath),
                'optimized_size' => strlen($optimizedImageData),
                'compression_ratio' => round((1 - strlen($optimizedImageData) / filesize($imagePath)) * 100, 1)
            ];
            
        } catch (\Exception $e) {
            Log::error('Error en optimizarImagen: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Migrar imagen legacy a BLOB
     */
    public function migrarImagenLegacyABlob($event)
    {
        if (!$event->banner_image) {
            return false;
        }
        
        // Verificar si ya tiene imagen BLOB
        if ($event->imagenes()->where('tipo', 'principal')->exists()) {
            return false; // Ya tiene imagen BLOB, no migrar
        }
        
        try {
            $possiblePaths = [
                storage_path('app/public/temp/' . $event->banner_image),
                storage_path('app/public/events/banners/' . $event->banner_image),
                storage_path('app/public/' . $event->banner_image),
                public_path('storage/events/banners/' . $event->banner_image),
                public_path('storage/' . $event->banner_image),
            ];
            
            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    Log::info("Migrando imagen legacy a BLOB: " . $path);
                    
                    // Optimizar la imagen antes de guardarla como BLOB
                    $imagenOptimizada = $this->optimizarImagen($path, $event->banner_image);
                    
                    if ($imagenOptimizada) {
                        // Crear registro BLOB
                        ImagenEvento::create([
                            'evento_id' => $event->id,
                            'imagen_data' => $imagenOptimizada['base64'],
                            'mime_type' => $imagenOptimizada['mime_type'],
                            'tipo' => 'principal',
                            'tamaño_kb' => $imagenOptimizada['size_kb'],
                            'formato' => $imagenOptimizada['extension'],
                        ]);
                        
                        Log::info("Imagen migrada exitosamente. Compresión: {$imagenOptimizada['compression_ratio']}%");
                        
                        // Eliminar archivo original después de migrar
                        if (file_exists($path)) {
                            unlink($path);
                        }
                        
                        // Limpiar el campo legacy
                        $event->banner_image = null;
                        $event->save();
                        
                        return true;
                    }
                }
            }
            
            Log::warning("No se pudo encontrar archivo para migrar: " . $event->banner_image);
            return false;
            
        } catch (\Exception $e) {
            Log::error('Error al migrar imagen legacy: ' . $e->getMessage());
            return false;
        }
    }
}