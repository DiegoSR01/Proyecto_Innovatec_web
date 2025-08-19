<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Resumen del Evento</title>
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
                    <a class="text-textMuted text-sm font-medium leading-normal hover:text-tertiary hover:drop-shadow-lg transition-all duration-300" href="/events/modify">Modificar</a>
                    <a class="text-warning text-sm font-medium leading-normal hover:text-accent hover:drop-shadow-lg transition-all duration-300" href="/subscription/plans">💳 Suscripción</a>
                    <a class="text-textMuted text-sm font-medium leading-normal hover:text-success hover:drop-shadow-lg transition-all duration-300" href="#">Soporte</a>
                </div>
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" 
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBLCsTZpxKXCAKoDY9xg8CTUN_CUYfM6jTFLmg3YTg5xI2UJQcbEx0zzDAk-Pn2cXIa7F3B0J0XPi3mLxWRRDcEJNFN5Hp474_Dlp1nneZeBOaXn6T33SkaRLdYUZ0p4hyg4N_CSATsBm-0sNp2ganJdu6782Gm_e4Y5rBwPlpL6gS8NI6GVmpZugdXscLW4ICwuVrsIvLA099FGDQ97rn7VvJtICeeTPnM7t0-je_xEumfPYUeJNKzn_TtmVN7cp4eFAu5_FlVCxE");'>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="flex-1 px-8 md:px-20 lg:px-40 py-6">
            <div class="max-w-6xl mx-auto">
                
                <!-- Title Section -->
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-bold leading-tight mb-4 bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">
                        📋 Resumen del Evento
                    </h1>
                    <p class="text-textMuted text-lg leading-relaxed max-w-3xl mx-auto">
                        ✨ Revisa toda la información de tu evento antes de publicarlo. Aquí puedes ver un resumen completo de todos los detalles configurados.
                    </p>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 p-6 bg-gradient-to-r from-success/20 to-success/5 border-2 border-success/30 text-success rounded-2xl text-center backdrop-blur-lg shadow-2xl shadow-success/20">
                        <div class="font-bold text-xl">✅ {{ session('success') }}</div>
                    </div>
                @endif

                <!-- Error Messages -->
                @if (session('error'))
                    <div class="mb-6 p-6 bg-gradient-to-r from-red-500/20 to-red-500/5 border-2 border-red-500/30 text-red-400 rounded-2xl backdrop-blur-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Event Summary Card -->
                <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden border border-cardLight/30 mb-8">
                    
                    <!-- Event Header with Basic Info -->
                    <div class="bg-gradient-to-r from-accent to-secondary p-8 text-white">
                        <h2 class="text-3xl font-bold mb-4 drop-shadow-lg">
                            {{ $eventBasic['event_name'] ?? 'Nombre del Evento No Definido' }}
                        </h2>
                        <div class="flex flex-wrap items-center gap-4 text-lg">
                            <span class="bg-white/20 px-4 py-2 rounded-xl font-medium backdrop-blur-sm">
                                📂 {{ $eventBasic['event_category'] ?? 'Sin categoría' }}
                            </span>
                            @if(isset($eventLocation['tipo_evento']))
                                <span class="bg-white/20 px-4 py-2 rounded-xl font-medium backdrop-blur-sm">
                                    @if($eventLocation['tipo_evento'] == 'Presencial')
                                        🏢 Presencial
                                    @elseif($eventLocation['tipo_evento'] == 'Virtual')
                                        💻 Virtual
                                    @else
                                        🌐 Híbrido
                                    @endif
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Event Content -->
                    <div class="p-8 space-y-8">
                        
                        <!-- Description -->
                        @if(isset($eventBasic['event_description']))
                            <section class="bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl p-6 backdrop-blur-lg border border-cardLight/20">
                                <h3 class="text-2xl font-bold text-text mb-4 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent flex items-center">
                                    <span class="mr-3">📝</span> Descripción del Evento
                                </h3>
                                <p class="text-textMuted leading-relaxed text-lg">
                                    {{ $eventBasic['event_description'] }}
                                </p>
                            </section>
                        @endif

                        <!-- Date and Time Information -->
                        @if(!empty($eventDate))
                            <section class="bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl p-6 backdrop-blur-lg border border-cardLight/20">
                                <h3 class="text-2xl font-bold text-text mb-6 bg-gradient-to-r from-info to-tertiary bg-clip-text text-transparent flex items-center">
                                    <span class="mr-3">📅</span> Fecha y Horario
                                </h3>
                                
                                <div class="grid md:grid-cols-2 gap-6">
                                    <!-- Fecha -->
                                    <div class="bg-gradient-to-br from-card/50 to-accent/5 backdrop-blur-sm rounded-xl p-6 border border-cardLight/20">
                                        <div class="text-accent font-bold text-lg mb-3 flex items-center">
                                            <span class="text-2xl mr-2">📆</span> Fechas del Evento
                                        </div>
                                        @if(isset($eventDate['fecha_inicio']) && isset($eventDate['fecha_fin']))
                                            @if($eventDate['fecha_inicio'] === $eventDate['fecha_fin'])
                                                <div class="text-text text-xl font-semibold">
                                                    {{ \Carbon\Carbon::parse($eventDate['fecha_inicio'])->format('d \d\e F \d\e Y') }}
                                                </div>
                                                <div class="text-textMuted text-sm mt-2">🗓️ Evento de un solo día</div>
                                            @else
                                                <div class="text-text">
                                                    <div class="text-lg">
                                                        <strong>Inicio:</strong> {{ \Carbon\Carbon::parse($eventDate['fecha_inicio'])->format('d \d\e F \d\e Y') }}
                                                    </div>
                                                    <div class="text-lg mt-1">
                                                        <strong>Fin:</strong> {{ \Carbon\Carbon::parse($eventDate['fecha_fin'])->format('d \d\e F \d\e Y') }}
                                                    </div>
                                                </div>
                                                <div class="text-textMuted text-sm mt-3">
                                                    🗓️ Duración: {{ \Carbon\Carbon::parse($eventDate['fecha_inicio'])->diffInDays(\Carbon\Carbon::parse($eventDate['fecha_fin'])) + 1 }} días
                                                </div>
                                            @endif
                                        @else
                                            <div class="text-textMuted">❌ Fechas no definidas</div>
                                        @endif
                                    </div>
                                    
                                    <!-- Horario -->
                                    <div class="bg-gradient-to-br from-card/50 to-secondary/5 backdrop-blur-sm rounded-xl p-6 border border-cardLight/20">
                                        <div class="text-secondary font-bold text-lg mb-3 flex items-center">
                                            <span class="text-2xl mr-2">⏰</span> Horario del Evento
                                        </div>
                                        @if(isset($eventDate['hora_inicio']) && isset($eventDate['hora_fin']))
                                            <div class="text-text text-xl font-semibold">
                                                {{ $eventDate['hora_inicio'] }} - {{ $eventDate['hora_fin'] }}
                                            </div>
                                            @if(isset($eventDate['repetir_horario']) && $eventDate['repetir_horario'])
                                                <div class="text-success text-sm mt-2">🔄 Se repite todos los días del evento</div>
                                            @else
                                                <div class="text-textMuted text-sm mt-2">📋 Horario específico del evento</div>
                                            @endif
                                        @else
                                            <div class="text-textMuted">❌ Horario no definido</div>
                                        @endif
                                    </div>
                                </div>
                            </section>
                        @endif

                        <!-- Location Information -->
                        @if(!empty($eventLocation))
                            <section class="bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl p-6 backdrop-blur-lg border border-cardLight/20">
                                <h3 class="text-2xl font-bold text-text mb-6 bg-gradient-to-r from-tertiary to-purple bg-clip-text text-transparent flex items-center">
                                    <span class="mr-3">📍</span> Información de Ubicación
                                </h3>
                                
                                <!-- Tipo de evento -->
                                <div class="mb-6 text-center">
                                    <span class="inline-block px-6 py-3 bg-gradient-to-r from-accent to-secondary text-white rounded-xl text-lg font-semibold backdrop-blur-sm">
                                        {{ $eventLocation['tipo_evento'] ?? 'Tipo no especificado' }}
                                    </span>
                                </div>
                                
                                <div class="grid gap-6">
                                    <!-- Información Presencial -->
                                    @if(isset($eventLocation['tipo_evento']) && in_array($eventLocation['tipo_evento'], ['Presencial', 'Híbrido']))
                                        <div class="bg-gradient-to-br from-card/50 to-accent/5 backdrop-blur-sm rounded-xl p-6 border border-cardLight/20">
                                            <div class="text-accent font-bold text-lg mb-4 flex items-center">
                                                <span class="text-2xl mr-2">🏢</span> Ubicación Física
                                            </div>
                                            
                                            <div class="space-y-3">
                                                @if(isset($eventLocation['nombre_lugar']) && !empty($eventLocation['nombre_lugar']))
                                                    <div>
                                                        <span class="text-textMuted text-sm">Lugar:</span>
                                                        <div class="text-text font-semibold text-lg">{{ $eventLocation['nombre_lugar'] }}</div>
                                                    </div>
                                                @endif
                                                
                                                @if(isset($eventLocation['direccion_completa']) && !empty($eventLocation['direccion_completa']))
                                                    <div>
                                                        <span class="text-textMuted text-sm">Dirección:</span>
                                                        <div class="text-text">{{ $eventLocation['direccion_completa'] }}</div>
                                                    </div>
                                                @endif
                                                
                                                <div>
                                                    <span class="text-textMuted text-sm">Ubicación:</span>
                                                    <div class="text-text">
                                                        {{ $eventLocation['ciudad'] ?? 'Ciudad no especificada' }}{{ isset($eventLocation['estado']) && !empty($eventLocation['estado']) ? ', ' . $eventLocation['estado'] : '' }}{{ isset($eventLocation['pais']) && !empty($eventLocation['pais']) ? ', ' . $eventLocation['pais'] : '' }}
                                                    </div>
                                                </div>
                                                
                                                @if(isset($eventLocation['capacidad']) && !empty($eventLocation['capacidad']))
                                                    <div class="bg-success/10 px-3 py-2 rounded-lg inline-block">
                                                        <span class="text-success text-sm font-medium">👥 Capacidad: {{ $eventLocation['capacidad'] }} personas</span>
                                                    </div>
                                                @endif
                                                
                                                @if(isset($eventLocation['accesible']) && $eventLocation['accesible'])
                                                    <div class="bg-success/10 px-3 py-2 rounded-lg inline-block">
                                                        <span class="text-success text-sm font-medium">♿ Lugar accesible para personas con discapacidad</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Información Virtual -->
                                    @if(isset($eventLocation['tipo_evento']) && in_array($eventLocation['tipo_evento'], ['Virtual', 'Híbrido']))
                                        <div class="bg-gradient-to-br from-card/50 to-info/5 backdrop-blur-sm rounded-xl p-6 border border-cardLight/20">
                                            <div class="text-info font-bold text-lg mb-4 flex items-center">
                                                <span class="text-2xl mr-2">💻</span> Acceso Virtual
                                            </div>
                                            
                                            <div class="space-y-3">
                                                @if(isset($eventLocation['event_link']) && !empty($eventLocation['event_link']))
                                                    <div>
                                                        <span class="text-textMuted text-sm">Enlace de acceso:</span>
                                                        <div class="text-info break-all">
                                                            <a href="{{ $eventLocation['event_link'] }}" target="_blank" class="hover:underline font-medium">
                                                                {{ $eventLocation['event_link'] }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if(isset($eventLocation['plataforma_virtual']) && !empty($eventLocation['plataforma_virtual']))
                                                    <div>
                                                        <span class="text-textMuted text-sm">Plataforma:</span>
                                                        <div class="text-text">{{ ucfirst($eventLocation['plataforma_virtual']) }}</div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </section>
                        @endif

                        <!-- Media Information -->
                        @if(!empty($eventMedia))
                            <section class="bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl p-6 backdrop-blur-lg border border-cardLight/20">
                                <h3 class="text-2xl font-bold text-text mb-6 bg-gradient-to-r from-warning to-accent bg-clip-text text-transparent flex items-center">
                                    <span class="mr-3">🎬</span> Media del Evento
                                </h3>
                                
                                <div class="grid md:grid-cols-3 gap-6">
                                    @if(isset($eventMedia['has_banner']) && $eventMedia['has_banner'])
                                        <div class="bg-gradient-to-br from-success/20 to-success/5 border border-success/30 rounded-xl p-6 text-center backdrop-blur-sm">
                                            <div class="text-4xl mb-3">🖼️</div>
                                            <div class="font-bold text-success text-lg">Imagen Principal</div>
                                            <div class="text-textMuted text-sm mt-2">Subida correctamente</div>
                                        </div>
                                    @endif
                                    
                                    @if(isset($eventMedia['gallery_count']) && $eventMedia['gallery_count'] > 0)
                                        <div class="bg-gradient-to-br from-info/20 to-info/5 border border-info/30 rounded-xl p-6 text-center backdrop-blur-sm">
                                            <div class="text-4xl mb-3">📸</div>
                                            <div class="font-bold text-info text-lg">Galería</div>
                                            <div class="text-textMuted text-sm mt-2">{{ $eventMedia['gallery_count'] }} imagen(es) adicionales</div>
                                        </div>
                                    @endif
                                    
                                    @if(isset($eventMedia['video_count']) && $eventMedia['video_count'] > 0)
                                        <div class="bg-gradient-to-br from-purple/20 to-purple/5 border border-purple/30 rounded-xl p-6 text-center backdrop-blur-sm">
                                            <div class="text-4xl mb-3">🎥</div>
                                            <div class="font-bold text-purple text-lg">Videos</div>
                                            <div class="text-textMuted text-sm mt-2">{{ $eventMedia['video_count'] }} video(s)</div>
                                        </div>
                                    @endif
                                    
                                    @if(empty($eventMedia['has_banner']) && empty($eventMedia['gallery_count']) && empty($eventMedia['video_count']))
                                        <div class="bg-gradient-to-br from-warning/20 to-warning/5 border border-warning/30 rounded-xl p-6 text-center col-span-full backdrop-blur-sm">
                                            <div class="text-4xl mb-3">⚠️</div>
                                            <div class="font-bold text-warning text-lg">Sin Multimedia</div>
                                            <div class="text-textMuted text-sm mt-2">No se han subido archivos multimedia</div>
                                        </div>
                                    @endif
                                </div>
                            </section>
                        @endif

                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-8">
                    <button onclick="nuevoEvento()" 
                            class="px-10 py-4 border-2 border-success text-success rounded-xl font-bold hover:bg-success hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-success/30 text-lg">
                        🆕 Nuevo Evento
                    </button>
                    <button onclick="window.history.back()" 
                            class="px-10 py-4 border-2 border-accent text-accent rounded-xl font-bold hover:bg-accent hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-accent/30 text-lg">
                        ← Volver a Media
                    </button>
                    <a href="{{ route('event.preview') }}" 
                       class="px-10 py-4 bg-gradient-to-r from-card/50 to-cardLight/40 text-text rounded-xl font-bold hover:from-cardLight/50 hover:to-card/60 transition-all duration-300 border border-cardLight/30 backdrop-blur-sm text-lg">
                        👁️ Vista Previa
                    </a>
                    <button onclick="alert('Funcionalidad de publicar próximamente')" 
                            class="px-10 py-4 bg-gradient-to-r from-accent to-secondary text-white rounded-xl font-bold hover:from-secondary hover:to-accent transition-all duration-300 shadow-2xl hover:shadow-accent/40 text-lg transform hover:scale-105">
                        🚀 Publicar Evento
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar datos disponibles para debug
            const eventBasic = @json($eventBasic ?? []);
            const eventDate = @json($eventDate ?? []);
            const eventLocation = @json($eventLocation ?? []);
            const eventMedia = @json($eventMedia ?? []);
            
            console.log('=== DATOS EN RESUMEN ===');
            console.log('Datos básicos:', eventBasic);
            console.log('Datos de fecha:', eventDate);
            console.log('Datos de ubicación:', eventLocation);
            console.log('Datos de media:', eventMedia);
            
            // Verificar si todos los datos están presentes
            const allDataPresent = Object.keys(eventBasic).length > 0 && 
                                  Object.keys(eventDate).length > 0 && 
                                  Object.keys(eventLocation).length > 0;
            
            if (!allDataPresent) {
                console.warn('⚠️ Algunos datos del evento no están disponibles');
            } else {
                console.log('✅ Todos los datos del evento están disponibles');
            }
        });
        
        function nuevoEvento() {
            if (confirm('¿Quieres crear un evento completamente nuevo? Esto borrará TODA la información del evento actual y empezará desde cero.')) {
                // Solo limpiar si la ruta existe
                @if(Route::has('event.clearAll'))
                    fetch('{{ route("event.clearAll") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => response.json())
                      .then(data => {
                          console.log('✅ Todos los datos limpiados desde resumen');
                          window.location.href = '{{ route("event.create") }}';
                      })
                      .catch(error => {
                          console.error('Error al limpiar datos:', error);
                          // Redirigir de todas formas
                          window.location.href = '{{ route("event.create") }}';
                      });
                @else
                    // Si no existe la ruta, simplemente redirigir
                    window.location.href = '{{ route("event.create") }}';
                @endif
            }
        }
    </script>
</body>
</html>
</body>
</html>
