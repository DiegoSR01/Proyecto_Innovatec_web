<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Vista Previa del Evento</title>
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
              warning: '#ff6b35',             // Naranja amigable
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
    <!-- Efectos de fondo con gradientes sutiles -->
    <div class="fixed inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="relative flex size-full min-h-screen flex-col bg-background z-10">
        <!-- Header minimalista -->
        <header class="header">
            <div style="max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 16px 40px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 28px; height: 28px; color: #ff4081;">
                        <svg viewBox="0 0 48 48" fill="currentColor">
                            <path d="M39.475 21.6262C40.358 21.4363 40.6863 21.5589 40.7581 21.5934C40.7876 21.655 40.8547 21.857 40.8082 22.3336C40.7408 23.0255 40.4502 24.0046 39.8572 25.2301C38.6799 27.6631 36.5085 30.6631 33.5858 33.5858C30.6631 36.5085 27.6632 38.6799 25.2301 39.8572C24.0046 40.4502 23.0255 40.7407 22.3336 40.8082C21.8571 40.8547 21.6551 40.7875 21.5934 40.7581C21.5589 40.6863 21.4363 40.358 21.6262 39.475C21.8562 38.4054 22.4689 36.9657 23.5038 35.2817C24.7575 33.2417 26.5497 30.9744 28.7621 28.762C30.9744 26.5497 33.2417 24.7574 35.2817 23.5037C36.9657 22.4689 38.4054 21.8562 39.475 21.6262ZM4.41189 29.2403L18.7597 43.5881C19.8813 44.7097 21.4027 44.9179 22.7217 44.7893C24.0585 44.659 25.5148 44.1631 26.9723 43.4579C29.9052 42.0387 33.2618 39.5667 36.4142 36.4142C39.5667 33.2618 42.0387 29.9052 43.4579 26.9723C44.1631 25.5148 44.659 24.0585 44.7893 22.7217C44.9179 21.4027 44.7097 19.8813 43.5881 18.7597L29.2403 4.41187C27.8527 3.02428 25.8765 3.02573 24.2861 3.36776C22.6081 3.72863 20.7334 4.58419 18.8396 5.74801C16.4978 7.18716 13.9881 9.18353 11.5858 11.5858C9.18354 13.988 7.18717 16.4978 5.74802 18.8396C4.58421 20.7334 3.72865 22.6081 3.36778 24.2861C3.02574 25.8765 3.02429 27.8527 4.41189 29.2403Z"></path>
                        </svg>
                    </div>
                    <h1 style="font-size: 22px; font-weight: 700; background: linear-gradient(135deg, #ff4081, #00e5ff, #7c4dff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.5px;">FestiSpot</h1>
                </div>
                
                <nav style="display: flex; gap: 8px;">
                    <a href="/" class="nav-link">Inicio</a>
                    <a href="/event/create" class="nav-link">Crear evento</a>
                    <a href="/subscription/plans" class="nav-link">Suscripción</a>
                </nav>
                
                <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #ff4081, #00e5ff); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px; box-shadow: 0 4px 12px rgba(255, 64, 129, 0.3);">
                    U
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="flex-1 px-8 md:px-20 lg:px-40 py-6">
            <div class="max-w-6xl mx-auto">
                
                <!-- Title Section -->
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-bold leading-tight mb-4 bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">
                        👁️ Vista Previa del Evento
                    </h1>
                    <p class="text-textMuted text-lg leading-relaxed max-w-3xl mx-auto">
                        🎯 Revisa todos los detalles antes de publicar tu evento. Aquí puedes ver cómo se verá tu evento para los asistentes.
                    </p>
                </div>

                @php
                    $eventBasic = session('event_basic', []);
                    $eventDate = session('event_date', []);
                    $eventLocation = session('event_location', []);
                    $eventMedia = session('event_media', []);
                    
                    // Configurar Carbon para español
                    \Carbon\Carbon::setLocale('es');
                @endphp

                <!-- Event Card Preview -->
                <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden mb-8 border border-cardLight/30">
                    <!-- Event Header -->
                    <div class="bg-gradient-to-r from-accent to-secondary p-8 text-white">
                        <h2 class="text-3xl font-bold mb-3 drop-shadow-lg">
                            {{ $eventBasic['event_name'] ?? 'Nombre del Evento No Disponible' }}
                        </h2>
                        <div class="flex items-center gap-4 text-lg">
                            <span class="bg-white/20 px-4 py-2 rounded-xl backdrop-blur-sm font-medium">
                                {{ $eventBasic['event_category'] ?? 'Categoría no definida' }}
                            </span>
                            @if(isset($eventLocation['tipo_evento']))
                                <span class="flex items-center gap-2 bg-white/20 px-4 py-2 rounded-xl backdrop-blur-sm font-medium">
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
                            <div class="bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl p-6 backdrop-blur-lg border border-cardLight/20">
                                <h3 class="text-xl font-bold text-text mb-4 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent">📝 Descripción</h3>
                                <p class="text-textMuted leading-relaxed text-lg">
                                    {{ $eventBasic['event_description'] }}
                                </p>
                            </div>
                        @endif

                        <!-- Date and Time -->
                        @if(!empty($eventDate))
                            <div class="bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl p-6 backdrop-blur-lg border border-cardLight/20">
                                <h3 class="text-xl font-bold text-text mb-4 bg-gradient-to-r from-info to-tertiary bg-clip-text text-transparent">📅 Fecha y Horario</h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="bg-gradient-to-br from-card/50 to-accent/5 backdrop-blur-sm rounded-xl p-6 border border-cardLight/20">
                                        <div class="font-bold text-accent mb-2 text-lg">📆 Fecha</div>
                                        @if(isset($eventDate['fecha_inicio']) && isset($eventDate['fecha_fin']))
                                            @if($eventDate['fecha_inicio'] === $eventDate['fecha_fin'])
                                                <div class="text-text text-lg font-medium">
                                                    {{ \Carbon\Carbon::parse($eventDate['fecha_inicio'])->translatedFormat('d \d\e F \d\e Y') }}
                                                </div>
                                                <div class="text-sm text-textMuted">Un solo día</div>
                                            @else
                                                <div class="text-text text-lg font-medium">
                                                    {{ \Carbon\Carbon::parse($eventDate['fecha_inicio'])->translatedFormat('d \d\e F') }} - 
                                                    {{ \Carbon\Carbon::parse($eventDate['fecha_fin'])->translatedFormat('d \d\e F \d\e Y') }}
                                                </div>
                                                <div class="text-sm text-textMuted">
                                                    {{ \Carbon\Carbon::parse($eventDate['fecha_inicio'])->diffInDays(\Carbon\Carbon::parse($eventDate['fecha_fin'])) + 1 }} días
                                                </div>
                                            @endif
                                        @else
                                            <div class="text-textMuted">Fechas no definidas</div>
                                        @endif
                                    </div>
                                    
                                    <div class="bg-gradient-to-br from-card/50 to-secondary/5 backdrop-blur-sm rounded-xl p-6 border border-cardLight/20">
                                        <div class="font-bold text-secondary mb-2 text-lg">⏰ Horario</div>
                                        @if(isset($eventDate['hora_inicio']) && isset($eventDate['hora_fin']))
                                            <div class="text-text text-lg font-medium">
                                                {{ $eventDate['hora_inicio'] }} - {{ $eventDate['hora_fin'] }}
                                            </div>
                                            @if(isset($eventDate['repetir_horario']) && $eventDate['repetir_horario'])
                                                <div class="text-sm text-textMuted">🔄 Se repite todos los días</div>
                                            @else
                                                <div class="text-sm text-textMuted">📋 Horario específico</div>
                                            @endif
                                        @else
                                            <div class="text-textMuted">Horario no definido</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Location -->
                        @if(!empty($eventLocation))
                            <div class="bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl p-6 backdrop-blur-lg border border-cardLight/20">
                                <h3 class="text-xl font-bold text-text mb-4 bg-gradient-to-r from-tertiary to-purple bg-clip-text text-transparent">📍 Ubicación</h3>
                                
                                @if(isset($eventLocation['tipo_evento']) && in_array($eventLocation['tipo_evento'], ['Presencial', 'Híbrido']))
                                    <div class="bg-gradient-to-br from-card/50 to-accent/5 backdrop-blur-sm rounded-xl p-6 mb-6 border border-cardLight/20">
                                        <div class="font-bold text-accent mb-3 text-lg">🏢 Lugar Físico</div>
                                        @if(isset($eventLocation['nombre_lugar']))
                                            <div class="text-text font-bold text-lg mb-1">{{ $eventLocation['nombre_lugar'] }}</div>
                                        @endif
                                        @if(isset($eventLocation['direccion_completa']))
                                            <div class="text-textMuted text-lg mb-1">{{ $eventLocation['direccion_completa'] }}</div>
                                        @endif
                                        @if(isset($eventLocation['ciudad']) || isset($eventLocation['estado']))
                                            <div class="text-textMuted text-lg mb-2">
                                                {{ $eventLocation['ciudad'] ?? '' }}{{ isset($eventLocation['ciudad']) && isset($eventLocation['estado']) ? ', ' : '' }}{{ $eventLocation['estado'] ?? '' }}
                                            </div>
                                        @endif
                                        @if(isset($eventLocation['capacidad']) && !empty($eventLocation['capacidad']))
                                            <div class="text-sm text-textDark mt-3 bg-success/10 px-3 py-1 rounded-lg inline-block">
                                                👥 Capacidad: {{ $eventLocation['capacidad'] }} personas
                                            </div>
                                        @endif
                                        @if(isset($eventLocation['accesible']) && $eventLocation['accesible'])
                                            <div class="text-sm text-success mt-3 bg-success/10 px-3 py-1 rounded-lg inline-block">♿ Lugar accesible</div>
                                        @endif
                                    </div>
                                @endif

                                @if(isset($eventLocation['tipo_evento']) && in_array($eventLocation['tipo_evento'], ['Virtual', 'Híbrido']))
                                    <div class="bg-gradient-to-br from-card/50 to-info/5 backdrop-blur-sm rounded-xl p-6 border border-cardLight/20">
                                        <div class="font-bold text-info mb-3 text-lg">💻 Acceso Virtual</div>
                                        @if(isset($eventLocation['event_link']))
                                            <div class="text-text break-all mb-2">
                                                <a href="{{ $eventLocation['event_link'] }}" target="_blank" class="text-info hover:text-secondary hover:underline transition-colors duration-200 font-medium">
                                                    {{ $eventLocation['event_link'] }}
                                                </a>
                                            </div>
                                        @endif
                                        @if(isset($eventLocation['plataforma_virtual']) && !empty($eventLocation['plataforma_virtual']))
                                            <div class="text-textMuted">📦 Plataforma: {{ ucfirst($eventLocation['plataforma_virtual']) }}</div>
                                        @endif
                                        @if(isset($eventLocation['codigo_acceso']) && !empty($eventLocation['codigo_acceso']))
                                            <div class="text-textMuted">🔑 ID: {{ $eventLocation['codigo_acceso'] }}</div>
                                        @endif
                                        @if(isset($eventLocation['instrucciones_virtuales']) && !empty($eventLocation['instrucciones_virtuales']))
                                            <div class="text-sm text-textDark mt-3 bg-info/10 p-3 rounded-lg">
                                                ℹ️ {{ $eventLocation['instrucciones_virtuales'] }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Media Status -->
                        @if(!empty($eventMedia))
                            <div class="bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl p-6 backdrop-blur-lg border border-cardLight/20">
                                <h3 class="text-xl font-bold text-text mb-4 bg-gradient-to-r from-warning to-accent bg-clip-text text-transparent">🎬 Multimedia</h3>
                                <div class="grid md:grid-cols-3 gap-6">
                                    @if(isset($eventMedia['has_banner']) && $eventMedia['has_banner'])
                                        <div class="bg-gradient-to-br from-success/20 to-success/5 border border-success/30 rounded-xl p-6 text-center backdrop-blur-sm">
                                            <div class="text-4xl mb-3">🖼️</div>
                                            <div class="font-bold text-success text-lg">Imagen Principal</div>
                                            <div class="text-sm text-textMuted">Subida correctamente</div>
                                        </div>
                                    @endif
                                    
                                    @if(isset($eventMedia['gallery_count']) && $eventMedia['gallery_count'] > 0)
                                        <div class="bg-gradient-to-br from-info/20 to-info/5 border border-info/30 rounded-xl p-6 text-center backdrop-blur-sm">
                                            <div class="text-4xl mb-3">📸</div>
                                            <div class="font-bold text-info text-lg">Galería</div>
                                            <div class="text-sm text-textMuted">{{ $eventMedia['gallery_count'] }} imagen(es)</div>
                                        </div>
                                    @endif
                                    
                                    @if(isset($eventMedia['video_count']) && $eventMedia['video_count'] > 0)
                                        <div class="bg-gradient-to-br from-purple/20 to-purple/5 border border-purple/30 rounded-xl p-6 text-center backdrop-blur-sm">
                                            <div class="text-4xl mb-3">🎥</div>
                                            <div class="font-bold text-purple text-lg">Videos</div>
                                            <div class="text-sm text-textMuted">{{ $eventMedia['video_count'] }} video(s)</div>
                                        </div>
                                    @endif
                                    
                                    @if(empty($eventMedia['has_banner']) && empty($eventMedia['gallery_count']) && empty($eventMedia['video_count']))
                                        <div class="bg-gradient-to-br from-warning/20 to-warning/5 border border-warning/30 rounded-xl p-6 text-center backdrop-blur-sm">
                                            <div class="text-4xl mb-3">⚠️</div>
                                            <div class="font-bold text-warning text-lg">Sin Multimedia</div>
                                            <div class="text-sm text-textMuted">No se han subido archivos</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <button id="btn-nuevo-evento-preview" 
                            class="px-10 py-4 border-2 border-success text-success rounded-xl font-bold hover:bg-success hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-success/30 text-lg">
                        🆕 Nuevo Evento
                    </button>
                    <button id="btn-editar" 
                            class="px-10 py-4 border-2 border-accent text-accent rounded-xl font-bold hover:bg-accent hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-accent/30 text-lg">
                        ✏️ Editar Evento
                    </button>
                    <button id="btn-guardar-borrador" 
                            class="px-10 py-4 bg-gradient-to-r from-card/50 to-cardLight/40 text-text rounded-xl font-bold hover:from-cardLight/50 hover:to-card/60 transition-all duration-300 border border-cardLight/30 backdrop-blur-sm text-lg">
                        💾 Guardar Borrador
                    </button>
                    <button id="btn-publicar" 
                            class="px-10 py-4 bg-gradient-to-r from-secondary to-info text-white rounded-xl font-bold hover:from-info hover:to-secondary transition-all duration-300 shadow-2xl hover:shadow-secondary/40 text-lg transform hover:scale-105">
                        🚀 Publicar Evento
                    </button>
                </div>

                <!-- Data Status Debug (solo en desarrollo) -->
                @if(config('app.debug', false))
                    <div class="mt-8 p-6 bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl border border-cardLight/30 backdrop-blur-lg">
                        <h4 class="text-text font-bold mb-4 text-lg bg-gradient-to-r from-warning to-info bg-clip-text text-transparent">🔧 Estado de los Datos (Debug)</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-sm">
                            <div class="p-4 bg-gradient-to-br from-card/50 to-accent/5 rounded-xl backdrop-blur-sm border border-cardLight/20">
                                <div class="font-bold text-accent mb-1">Básicos</div>
                                <div class="text-{{ !empty($eventBasic) ? 'success' : 'warning' }}">
                                    {{ !empty($eventBasic) ? '✓ Disponibles' : '✗ No disponibles' }}
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-card/50 to-info/5 rounded-xl backdrop-blur-sm border border-cardLight/20">
                                <div class="font-bold text-info mb-1">Fechas</div>
                                <div class="text-{{ !empty($eventDate) ? 'success' : 'warning' }}">
                                    {{ !empty($eventDate) ? '✓ Disponibles' : '✗ No disponibles' }}
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-card/50 to-tertiary/5 rounded-xl backdrop-blur-sm border border-cardLight/20">
                                <div class="font-bold text-tertiary mb-1">Ubicación</div>
                                <div class="text-{{ !empty($eventLocation) ? 'success' : 'warning' }}">
                                    {{ !empty($eventLocation) ? '✓ Disponibles' : '✗ No disponibles' }}
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-card/50 to-secondary/5 rounded-xl backdrop-blur-sm border border-cardLight/20">
                                <div class="font-bold text-secondary mb-1">Media</div>
                                <div class="text-{{ !empty($eventMedia) ? 'success' : 'warning' }}">
                                    {{ !empty($eventMedia) ? '✓ Disponibles' : '✗ No disponibles' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Preview page loaded');
            
            // Verificar datos disponibles
            const hasBasicData = @json(!empty($eventBasic));
            const hasDateData = @json(!empty($eventDate));
            const hasLocationData = @json(!empty($eventLocation));
            const hasMediaData = @json(!empty($eventMedia));
            
            console.log('Data status:', {
                basic: hasBasicData,
                date: hasDateData,
                location: hasLocationData,
                media: hasMediaData
            });
            
            // Log de los datos reales para debug
            console.log('Event Basic Data:', @json($eventBasic));
            console.log('Event Date Data:', @json($eventDate));
            console.log('Event Location Data:', @json($eventLocation));
            console.log('Event Media Data:', @json($eventMedia));
            
            // Event listeners para botones
            document.getElementById('btn-nuevo-evento-preview').addEventListener('click', function() {
                if (confirm('¿Quieres crear un evento completamente nuevo? Esto borrará TODA la información del evento actual y te llevará al inicio.')) {
                    // Mostrar loading
                    const btn = this;
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '⏳ Limpiando...';
                    btn.disabled = true;
                    
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
                              console.log('✅ Todos los datos limpiados desde preview');
                              window.location.href = "{{ route('event.create') }}";
                          })
                          .catch(error => {
                              console.error('Error al limpiar datos:', error);
                              // Redirigir de todas formas
                              window.location.href = "{{ route('event.create') }}";
                          });
                    @else
                        // Si no existe la ruta, simplemente redirigir
                        setTimeout(() => {
                            window.location.href = "{{ route('event.create') }}";
                        }, 500);
                    @endif
                }
            });
            
            document.getElementById('btn-editar').addEventListener('click', function() {
                if (confirm('¿Quieres editar el evento? Mantendremos toda la información actual.')) {
                    // Ir a la primera página pero manteniendo los datos en sesión
                    window.location.href = "{{ route('event.create') }}";
                }
            });
            
            document.getElementById('btn-guardar-borrador').addEventListener('click', function() {
                alert('Funcionalidad de guardar borrador estará disponible próximamente');
            });
            
            document.getElementById('btn-publicar').addEventListener('click', function() {
                if (!hasBasicData) {
                    alert('Error: No hay información básica del evento. Por favor completa el formulario inicial.');
                    return;
                }
                
                if (!hasDateData) {
                    alert('Error: No hay información de fechas. Por favor completa las fechas del evento.');
                    return;
                }
                
                if (!hasLocationData) {
                    alert('Error: No hay información de ubicación. Por favor completa la ubicación del evento.');
                    return;
                }
                
                if (confirm('¿Estás seguro de que quieres publicar este evento? Una vez publicado será visible para todos los usuarios.')) {
                    // Aquí iría la lógica para publicar el evento
                    alert('¡Evento publicado exitosamente! (Funcionalidad de publicación pendiente de implementar)');
                }
            });
        });
    </script>
</body>
</html>
</html>
