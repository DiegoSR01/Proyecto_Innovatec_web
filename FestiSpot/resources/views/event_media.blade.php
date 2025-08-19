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
        <!-- Header -->
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-cardLight/30 px-10 py-4 bg-card/80 backdrop-blur-xl">
            <div class="flex items-center gap-4 text-text">
                <div class="size-6 text-accent drop-shadow-lg">
                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" 
                              d="M39.475 21.6262C40.358 21.4363 40.6863 21.5589 40.7581 21.5934C40.7876 21.655 40.8547 21.857 40.8082 22.3336C40.7408 23.0255 40.4502 24.0046 39.8572 25.2301C38.6799 27.6631 36.5085 30.6631 33.5858 33.5858C30.6631 36.5085 27.6632 38.6799 25.2301 39.8572C24.0046 40.4502 23.0255 40.7407 22.3336 40.8082C21.8571 40.8547 21.6551 40.7875 21.5934 40.7581C21.5589 40.6863 21.4363 40.358 21.6262 39.475C21.8562 38.4054 22.4689 36.9657 23.5038 35.2817C24.7575 33.2417 26.5497 30.9744 28.7621 28.762C30.9744 26.5497 33.2417 24.7574 35.2817 23.5037C36.9657 22.4689 38.4054 21.8562 39.475 21.6262ZM4.41189 29.2403L18.7597 43.5881C19.8813 44.7097 21.4027 44.9179 22.7217 44.7893C24.0585 44.659 25.5148 44.1631 26.9723 43.4579C29.9052 42.0387 33.2618 39.5667 36.4142 36.4142C39.5667 33.2618 42.0387 29.9052 43.4579 26.9723C44.1631 25.5148 44.659 24.0585 44.7893 22.7217C44.9179 21.4027 44.7097 19.8813 43.5881 18.7597L29.2403 4.41187C27.8527 3.02428 25.8765 3.02573 24.2861 3.36776C22.6081 3.72863 20.7334 4.58419 18.8396 5.74801C16.4978 7.18716 13.9881 9.18353 11.5858 11.5858C9.18354 13.988 7.18717 16.4978 5.74802 18.8396C4.58421 20.7334 3.72865 22.6081 3.36778 24.2861C3.02574 25.8765 3.02429 27.8527 4.41189 29.2403Z" 
                              fill="currentColor"></path>
                    </svg>
                </div>
                <h2 class="text-text text-xl font-bold leading-tight tracking-[-0.015em] bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent drop-shadow-lg">
                    FestiSpot
                </h2>
            </div>
            <div class="flex flex-1 justify-end gap-8">
                <div class="flex items-center gap-9">
                    <a class="text-textMuted text-sm font-medium leading-normal hover:text-accent hover:drop-shadow-lg transition-all duration-300" href="#">Panel</a>
                    <a class="text-textMuted text-sm font-medium leading-normal hover:text-secondary hover:drop-shadow-lg transition-all duration-300" href="#">Eventos</a>
                    <a class="text-textMuted text-sm font-medium leading-normal hover:text-tertiary hover:drop-shadow-lg transition-all duration-300" href="#">Analíticas</a>
                    <a class="text-textMuted text-sm font-medium leading-normal hover:text-success hover:drop-shadow-lg transition-all duration-300" href="#">Soporte</a>
                </div>
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" 
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBLCsTZpxKXCAKoDY9xg8CTUN_CUYfM6jTFLmg3YTg5xI2UJQcbEx0zzDAk-Pn2cXIa7F3B0J0XPi3mLxWRRDcEJNFN5Hp474_Dlp1nneZeBOaXn6T33SkaRLdYUZ0p4hyg4N_CSATsBm-0sNp2ganJdu6782Gm_e4Y5rBwPlpL6gS8NI6GVmpZugdXscLW4ICwuVrsIvLA099FGDQ97rn7VvJtICeeTPnM7t0-je_xEumfPYUeJNKzn_TtmVN7cp4eFAu5_FlVCxE");'>
                </div>
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
