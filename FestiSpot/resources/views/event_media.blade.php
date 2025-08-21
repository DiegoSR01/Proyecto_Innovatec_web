<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Media del Evento</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link rel="stylesheet" as="style" onload="this.rel='stylesheet'" 
          href="https://fonts.googleapis.com/css2?display=swap&family=Inter:wght@400;500;700;900&family=Noto+Sans:wght@400;500;700;900" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              // Paleta modo oscuro elegante con vibra festival
              background: '#0a0a0f',           // Negro azulado muy oscuro
              card: '#16213e',                // Azul naval profundo
              cardLight: '#1e2749',           // Azul naval más claro
              accent: '#ff4081',              // Rosa vibrante
              secondary: '#00e5ff',            // Cyan eléctrico
              tertiary: '#7c4dff',            // Púrpura vibrante
              success: '#00c853',             // Verde brillante
              warning: '#ffc107',             // Ámbar dorado
              info: '#2196f3',                // Azul brillante
              purple: '#9c27b0',              // Magenta
              text: '#ffffff',                // Blanco puro
              textMuted: '#b0bec5',           // Gris azulado claro
              textDark: '#78909c',            // Gris azulado medio
              glow: '#ff4081'                 // Color para efectos glow
            }
          }
        }
      }
    </script>

    <style>
      .header {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f0f23 100%);
        border-bottom: 1px solid rgba(255, 64, 129, 0.2);
        backdrop-filter: blur(20px);
      }
      .nav-link {
        color: #ffffff;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: 500;
        opacity: 0.8;
      }
      .nav-link:hover {
        color: #ff4081;
        opacity: 1;
        background: rgba(255, 64, 129, 0.1);
      }
      .nav-link.active {
        color: #ff4081;
        opacity: 1;
        background: rgba(255, 64, 129, 0.15);
        font-weight: 600;
      }
    </style>
</head>
<body class="bg-background text-text min-h-screen">
    @php
        $eventMedia = session('event_media', []);
    @endphp

    <!-- Efectos de fondo con gradientes sutiles -->
    <div class="fixed inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="relative flex size-full min-h-screen flex-col bg-background z-10">
        <!-- Encabezado unificado -->
        <header class="w-full bg-gradient-to-r from-card to-cardLight/80 border-b border-cardLight/30 shadow-lg backdrop-blur-xl">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between px-4 md:px-10 py-4 gap-2">
                <div class="flex items-center gap-6">
                    <span class="text-2xl font-black bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent tracking-tight select-none">FestiSpot</span>
                    <nav class="flex items-center gap-2 text-textMuted text-base font-medium">
                        <a href="/" class="hover:text-accent transition-colors flex items-center gap-1">
                            <i class="fa-solid fa-house"></i> <span class="hidden sm:inline">Inicio</span>
                        </a>
                        <span class="mx-2 text-accent">/</span>
                        <span class="text-text font-bold">Creación</span>
                    </nav>
                </div>
                <a href="/perfil" class="flex items-center gap-2 text-text hover:text-accent font-semibold transition-colors">
                    <i class="fa-solid fa-user-circle text-2xl"></i>
                    <span class="hidden sm:inline">Mi perfil</span>
                </a>
            </div>
        </header>
        <!-- Main Content -->
        <div class="flex-1 px-8 md:px-20 lg:px-40 py-6">
            <div class="max-w-4xl mx-auto">
                
                <!-- Title Section -->
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-bold leading-tight mb-4 bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">
                        🎬 Media del Evento
                    </h1>
                    <p class="text-textMuted text-lg leading-relaxed max-w-3xl mx-auto">
                        📸 Dale vida a tu evento con imágenes y videos impactantes. El contenido multimedia ayuda a los asistentes a visualizar la experiencia.
                    </p>
                </div>

                <!-- Mostrar mensaje si se está editando -->
                @if(!empty($eventMedia))
                    <div class="mb-8 p-6 bg-gradient-to-r from-info/20 to-tertiary/20 border-2 border-info/40 text-info rounded-2xl backdrop-blur-lg shadow-2xl shadow-info/20">
                        <div class="font-bold text-xl">🎬 Editando archivos multimedia existentes</div>
                        <div class="text-base mt-2 text-textMuted">Los archivos ya subidos se mantendrán y puedes agregar más</div>
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/20 border border-red-500/30 text-red-400 rounded-lg">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Resumen de archivos existentes -->
                @if(!empty($eventMedia))
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-6 bg-gradient-to-r from-warning to-info bg-clip-text text-transparent text-center">
                            📁 Archivos Actuales
                        </h3>
                        
                        <div class="bg-gradient-to-br from-card/60 to-cardLight/40 backdrop-blur-xl rounded-3xl p-8 border border-cardLight/30 shadow-2xl">
                            <div class="space-y-6">
                                @if(isset($eventMedia['banner_name']) && $eventMedia['banner_name'])
                                    <div class="bg-gradient-to-br from-success/20 to-success/5 border-2 border-success/30 rounded-2xl p-6 backdrop-blur-lg">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <span class="text-4xl mr-4">🖼️</span>
                                                <div>
                                                    <div class="text-success font-bold text-xl">Imagen Principal</div>
                                                    <div class="text-textMuted">{{ $eventMedia['banner_name'] }}</div>
                                                </div>
                                            </div>
                                            <button type="button" onclick="removerArchivo('banner')" 
                                                    class="px-4 py-2 border-2 border-red-400 text-red-400 rounded-xl font-bold hover:bg-red-400 hover:text-white transition-all duration-300">
                                                🗑️ Quitar
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($eventMedia['gallery_files']) && count($eventMedia['gallery_files']) > 0)
                                    <div class="bg-gradient-to-br from-info/20 to-info/5 border-2 border-info/30 rounded-2xl p-6 backdrop-blur-lg">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center">
                                                <span class="text-4xl mr-4">📸</span>
                                                <div>
                                                    <div class="text-info font-bold text-xl">Galería de Imágenes</div>
                                                    <div class="text-textMuted">{{ count($eventMedia['gallery_files']) }} imagen(es)</div>
                                                </div>
                                            </div>
                                            <button type="button" onclick="removerArchivo('gallery')" 
                                                    class="px-4 py-2 border-2 border-red-400 text-red-400 rounded-xl font-bold hover:bg-red-400 hover:text-white transition-all duration-300">
                                                🗑️ Limpiar
                                            </button>
                                        </div>
                                        <div class="grid grid-cols-2 gap-2 ml-16">
                                            @foreach($eventMedia['gallery_files'] as $index => $file)
                                                <div class="bg-cardLight/40 rounded-lg p-3 flex items-center justify-between">
                                                    <span class="text-sm text-textMuted truncate">{{ $file }}</span>
                                                    <button type="button" onclick="removerArchivoIndividual('gallery', {{ $index }})" 
                                                            class="text-red-400 hover:text-red-300 ml-2">
                                                        ✕
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if(isset($eventMedia['video_files']) && count($eventMedia['video_files']) > 0)
                                    <div class="bg-gradient-to-br from-purple/20 to-purple/5 border-2 border-purple/30 rounded-2xl p-6 backdrop-blur-lg">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center">
                                                <span class="text-4xl mr-4">🎥</span>
                                                <div>
                                                    <div class="text-purple font-bold text-xl">Videos</div>
                                                    <div class="text-textMuted">{{ count($eventMedia['video_files']) }} video(s)</div>
                                                </div>
                                            </div>
                                            <button type="button" onclick="removerArchivo('videos')" 
                                                    class="px-4 py-2 border-2 border-red-400 text-red-400 rounded-xl font-bold hover:bg-red-400 hover:text-white transition-all duration-300">
                                                🗑️ Limpiar
                                            </button>
                                        </div>
                                        <div class="grid grid-cols-2 gap-2 ml-16">
                                            @foreach($eventMedia['video_files'] as $index => $file)
                                                <div class="bg-cardLight/40 rounded-lg p-3 flex items-center justify-between">
                                                    <span class="text-sm text-textMuted truncate">{{ $file }}</span>
                                                    <button type="button" onclick="removerArchivoIndividual('videos', {{ $index }})" 
                                                            class="text-red-400 hover:text-red-300 ml-2">
                                                        ✕
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('event.storeMedia') }}" enctype="multipart/form-data" id="media-form">
                    @csrf
                    
                    <!-- Imagen principal -->
                    <div class="mb-10">
                        <h3 class="text-3xl font-bold mb-8 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent text-center">
                            🖼️ Imagen Principal del Evento
                        </h3>
                        
                        <div class="bg-gradient-to-br from-card/60 to-cardLight/40 backdrop-blur-xl rounded-3xl p-10 border border-cardLight/30 shadow-2xl">
                            <div class="bg-gradient-to-br from-cardLight/60 to-card/40 backdrop-blur-lg rounded-2xl p-8 border border-cardLight/20">
                                <label class="block text-text font-bold mb-4 text-xl">
                                    📷 Sube una imagen que represente tu evento (recomendado)
                                    @if(isset($eventMedia['banner_name']) && $eventMedia['banner_name'])
                                        <span class="text-success text-lg ml-2">✅ Ya tienes: {{ $eventMedia['banner_name'] }}</span>
                                    @endif
                                </label>
                                <input
                                    type="file"
                                    id="banner-input"
                                    name="banner_image"
                                    accept="image/*"
                                    class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text focus:border-accent focus:ring-4 focus:ring-accent/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                />
                                <div class="text-textMuted text-sm mt-2">Formatos: JPG, PNG, GIF. Tamaño máximo: 5MB</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Galería de imágenes -->
                    <div class="mb-10">
                        <h3 class="text-3xl font-bold mb-8 bg-gradient-to-r from-info to-tertiary bg-clip-text text-transparent text-center">
                            📸 Galería de Imágenes
                        </h3>
                        
                        <div class="bg-gradient-to-br from-card/60 to-cardLight/40 backdrop-blur-xl rounded-3xl p-10 border border-cardLight/30 shadow-2xl">
                            <div class="bg-gradient-to-br from-cardLight/60 to-card/40 backdrop-blur-lg rounded-2xl p-8 border border-cardLight/20">
                                <label class="block text-text font-bold mb-4 text-xl">
                                    🏞️ Imágenes adicionales del evento (opcional)
                                    @if(isset($eventMedia['gallery_files']) && count($eventMedia['gallery_files']) > 0)
                                        <span class="text-info text-lg ml-2">✅ Tienes {{ count($eventMedia['gallery_files']) }} imagen(es)</span>
                                    @endif
                                </label>
                                <input
                                    type="file"
                                    id="gallery-input"
                                    name="gallery_images[]"
                                    accept="image/*"
                                    multiple
                                    class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text focus:border-info focus:ring-4 focus:ring-info/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                />
                                <div class="text-textMuted text-sm mt-2">Puedes seleccionar múltiples imágenes. Máximo 5MB cada una.</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Videos -->
                    <div class="mb-10">
                        <h3 class="text-3xl font-bold mb-8 bg-gradient-to-r from-purple to-tertiary bg-clip-text text-transparent text-center">
                            🎥 Videos del Evento
                        </h3>
                        
                        <div class="bg-gradient-to-br from-card/60 to-cardLight/40 backdrop-blur-xl rounded-3xl p-10 border border-cardLight/30 shadow-2xl">
                            <div class="bg-gradient-to-br from-cardLight/60 to-card/40 backdrop-blur-lg rounded-2xl p-8 border border-cardLight/20">
                                <label class="block text-text font-bold mb-4 text-xl">
                                    🎬 Videos promocionales o del evento (opcional)
                                    @if(isset($eventMedia['video_files']) && count($eventMedia['video_files']) > 0)
                                        <span class="text-purple text-lg ml-2">✅ Tienes {{ count($eventMedia['video_files']) }} video(s)</span>
                                    @endif
                                </label>
                                <input
                                    type="file"
                                    id="video-input"
                                    name="videos[]"
                                    accept="video/*"
                                    multiple
                                    class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text focus:border-purple focus:ring-4 focus:ring-purple/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                />
                                <div class="text-textMuted text-sm mt-2">Formatos: MP4, AVI, MOV. Máximo 50MB cada uno.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between items-center pt-10 border-t-2 border-gradient-to-r from-accent/30 to-secondary/30">
                        <button type="button" id="btn-limpiar-media" 
                                class="px-10 py-5 border-3 border-warning/60 text-warning rounded-2xl font-bold hover:bg-warning hover:text-background transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl hover:shadow-warning/40 backdrop-blur-sm">
                            <span class="text-xl">🗑️</span> Limpiar Media
                        </button>
                        
                        <div class="flex items-center gap-6">
                            <button type="button" id="skip-media" class="text-textMuted hover:text-text transition-colors text-lg font-medium">
                                Omitir por ahora
                            </button>
                            <button type="submit" id="submit-media" 
                                    class="px-14 py-5 bg-gradient-to-r from-secondary to-tertiary text-white rounded-2xl font-bold hover:from-tertiary hover:to-secondary transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl hover:shadow-secondary/50 text-xl">
                                Continuar: Resumen → <span class="text-2xl ml-2">📋</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🎬 Media page script loading...');
            
            document.getElementById('skip-media').addEventListener('click', function() {
                if (confirm('¿Estás seguro de que quieres omitir la subida de media? Podrás agregarlo después.')) {
                    console.log('🔄 Omitiendo media, redirigiendo...');
                    window.location.href = "{{ route('event.summary') }}";
                }
            });
            
            document.getElementById('btn-limpiar-media').addEventListener('click', function() {
                if (confirm('¿Estás seguro de que quieres limpiar todos los archivos de media? Esta acción no se puede deshacer.')) {
                    document.getElementById('banner-input').value = '';
                    document.getElementById('gallery-input').value = '';
                    document.getElementById('video-input').value = '';
                    
                    // Solo limpiar si la ruta existe
                    @if(Route::has('event.clearMedia'))
                        fetch('{{ route("event.clearMedia") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(() => {
                            console.log('Datos de media limpiados del servidor');
                            alert('✅ Archivos de media limpiados correctamente');
                            location.reload();
                        }).catch(error => {
                            console.error('Error al limpiar media:', error);
                            alert('✅ Archivos limpiados localmente');
                        });
                    @else
                        console.log('Ruta clearMedia no disponible, solo limpieza local');
                        alert('✅ Archivos de media limpiados correctamente');
                        location.reload();
                    @endif
                }
            });
        });

        // Solo definir funciones si las rutas existen
        @if(Route::has('event.removeMedia'))
            function removerArchivo(tipo) {
                if (confirm('¿Estás seguro de que quieres eliminar estos archivos?')) {
                    fetch('{{ route("event.removeMedia") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ tipo: tipo })
                    }).then(() => {
                        location.reload();
                    }).catch(error => {
                        console.error('Error al remover archivo:', error);
                        alert('Error al eliminar el archivo');
                    });
                }
            }
        @else
            function removerArchivo(tipo) {
                alert('Funcionalidad de eliminación no disponible temporalmente');
            }
        @endif

        @if(Route::has('event.removeMediaFile'))
            function removerArchivoIndividual(tipo, index) {
                if (confirm('¿Estás seguro de que quieres eliminar este archivo?')) {
                    fetch('{{ route("event.removeMediaFile") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ tipo: tipo, index: index })
                    }).then(() => {
                        location.reload();
                    }).catch(error => {
                        console.error('Error al remover archivo individual:', error);
                        alert('Error al eliminar el archivo');
                    });
                }
            }
        @else
            function removerArchivoIndividual(tipo, index) {
                alert('Funcionalidad de eliminación individual no disponible temporalmente');
            }
        @endif
    </script>
</body>
</html>
</html>
        @endif
    </script>
</body>
</html>
</html>
