<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Ubicación del Evento</title>
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
      
      .radio-option:checked + .radio-label {
        background: linear-gradient(135deg, #ff4081 0%, #00e5ff 100%);
        border-color: #ff4081;
        transform: scale(1.02);
        box-shadow: 0 8px 25px rgba(255, 64, 129, 0.3);
      }
      .section-hidden {
        display: none !important;
      }
      .section-visible {
        display: block !important;
        animation: fadeInScale 0.3s ease-out;
      }
      @keyframes fadeInScale {
        from {
          opacity: 0;
          transform: translateY(20px) scale(0.95);
        }
        to {
          opacity: 1;
          transform: translateY(0) scale(1);
        }
      }
    </style>
</head>
<body class="bg-background text-text min-h-screen">
    @php
        $eventLocation = session('event_location', []);
    @endphp

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
            <div class="max-w-4xl mx-auto">
                
                <!-- Title Section -->
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-bold leading-tight mb-4 bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">
                        📍 Ubicación del Evento
                    </h1>
                    <p class="text-textMuted text-lg leading-relaxed max-w-3xl mx-auto">
                        🌍 Define dónde sucederá la experiencia. Presencial, virtual o híbrido - tú decides cómo conectar con tu audiencia.
                    </p>
                </div>

                <!-- Mostrar mensaje si se está editando -->
                @if(!empty($eventLocation))
                    <div class="mb-6 p-4 bg-blue-500/20 border border-blue-500/30 text-blue-400 rounded-lg">
                        <div class="font-semibold">📍 Editando ubicación existente</div>
                        <div class="text-sm mt-1">La información de ubicación ya configurada se mantendrá</div>
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('event.storeLocation') }}" id="location-form">
                    @csrf

                    <!-- Event Type Selection -->
                    <div class="mb-8">
                        <h3 class="text-text text-2xl font-bold mb-6 bg-gradient-to-r from-info to-purple bg-clip-text text-transparent">
                            🎯 Tipo de evento
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <label class="cursor-pointer">
                                <input type="radio" name="tipo_evento" value="Presencial" class="radio-option sr-only" data-target="physical"
                                       {{ old('tipo_evento', $eventLocation['tipo_evento'] ?? '') == 'Presencial' ? 'checked' : '' }}>
                                <div class="radio-label border-2 border-cardLight/50 bg-gradient-to-br from-card/50 to-accent/5 hover:border-accent transition-all duration-300 rounded-2xl p-8 text-center backdrop-blur-sm transform hover:scale-105">
                                    <div class="text-4xl mb-4">🏢</div>
                                    <div class="font-bold text-text text-xl mb-2">Presencial</div>
                                    <div class="text-sm text-textMuted">Evento físico en un lugar específico</div>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" name="tipo_evento" value="Virtual" class="radio-option sr-only" data-target="virtual"
                                       {{ old('tipo_evento', $eventLocation['tipo_evento'] ?? '') == 'Virtual' ? 'checked' : '' }}>
                                <div class="radio-label border-2 border-cardLight/50 bg-gradient-to-br from-card/50 to-info/5 hover:border-info transition-all duration-300 rounded-2xl p-8 text-center backdrop-blur-sm transform hover:scale-105">
                                    <div class="text-4xl mb-4">💻</div>
                                    <div class="font-bold text-text text-xl mb-2">Virtual</div>
                                    <div class="text-sm text-textMuted">Evento 100% online</div>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" name="tipo_evento" value="Híbrido" class="radio-option sr-only" data-target="hybrid"
                                       {{ old('tipo_evento', $eventLocation['tipo_evento'] ?? '') == 'Híbrido' ? 'checked' : '' }}>
                                <div class="radio-label border-2 border-cardLight/50 bg-gradient-to-br from-card/50 to-purple/5 hover:border-purple transition-all duration-300 rounded-2xl p-8 text-center backdrop-blur-sm transform hover:scale-105">
                                    <div class="text-4xl mb-4">🌐</div>
                                    <div class="font-bold text-text text-xl mb-2">Híbrido</div>
                                    <div class="text-sm text-textMuted">Presencial + Virtual</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Status Message -->
                    <div id="status-message" class="mb-8 p-6 bg-gradient-to-r from-card/50 to-warning/10 rounded-2xl border-2 border-cardLight/50 backdrop-blur-sm">
                        <div class="text-text font-bold text-lg flex items-center">
                            <span class="mr-3">⚙️</span> Selecciona el tipo de evento para continuar
                        </div>
                        <div class="text-sm text-textMuted mt-2">Los campos se mostrarán según tu selección</div>
                    </div>

                    <!-- Physical Location Section - Sin país -->
                    <div id="physical-section" class="section-hidden mb-8">
                        <h3 class="text-text text-2xl font-bold mb-8 flex items-center bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent">
                            <span class="mr-4">📍</span> Información del Lugar
                        </h3>
                        
                        <div class="space-y-8">
                            <!-- Venue Name -->
                            <div class="bg-gradient-to-br from-card/50 to-accent/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                <label class="block text-text font-bold mb-3 text-lg">🏛️ Nombre del lugar *</label>
                                <input type="text" name="nombre_lugar" id="nombre_lugar"
                                       class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text placeholder-textDark focus:border-accent focus:ring-4 focus:ring-accent/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                       placeholder="Ej: Arena Ciudad de México"
                                       value="{{ old('nombre_lugar', $eventLocation['nombre_lugar'] ?? '') }}">
                            </div>

                            <!-- Address -->
                            <div class="bg-gradient-to-br from-card/50 to-secondary/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                <label class="block text-text font-bold mb-3 text-lg">📍 Dirección completa *</label>
                                <input type="text" name="direccion_completa" id="direccion_completa"
                                       class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text placeholder-textDark focus:border-secondary focus:ring-4 focus:ring-secondary/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                       placeholder="Ej: Av. Insurgentes Sur 1457, Col. San José Insurgentes"
                                       value="{{ old('direccion_completa', $eventLocation['direccion_completa'] ?? '') }}">
                            </div>

                            <!-- City and State - Sin país -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-gradient-to-br from-card/50 to-tertiary/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                    <label class="block text-text font-bold mb-3 text-lg">🌆 Ciudad *</label>
                                    <input type="text" name="ciudad" id="ciudad"
                                           class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text placeholder-textDark focus:border-tertiary focus:ring-4 focus:ring-tertiary/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                           placeholder="Ej: Ciudad de México"
                                           value="{{ old('ciudad', $eventLocation['ciudad'] ?? '') }}">
                                </div>
                                
                                <div class="bg-gradient-to-br from-card/50 to-purple/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                    <label class="block text-text font-bold mb-3 text-lg">🗺️ Estado *</label>
                                    <select name="estado" id="estado"
                                            class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text focus:border-purple focus:ring-4 focus:ring-purple/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg">
                                        <option value="">Selecciona un estado</option>
                                        <option value="CDMX" {{ (old('estado', $eventLocation['estado'] ?? '') == 'CDMX') ? 'selected' : '' }}>Ciudad de México</option>
                                        <option value="Jalisco" {{ (old('estado', $eventLocation['estado'] ?? '') == 'Jalisco') ? 'selected' : '' }}>Jalisco</option>
                                        <option value="Nuevo León" {{ (old('estado', $eventLocation['estado'] ?? '') == 'Nuevo León') ? 'selected' : '' }}>Nuevo León</option>
                                        <option value="Puebla" {{ (old('estado', $eventLocation['estado'] ?? '') == 'Puebla') ? 'selected' : '' }}>Puebla</option>
                                        <option value="Veracruz" {{ (old('estado', $eventLocation['estado'] ?? '') == 'Veracruz') ? 'selected' : '' }}>Veracruz</option>
                                        <option value="Estado de México" {{ (old('estado', $eventLocation['estado'] ?? '') == 'Estado de México') ? 'selected' : '' }}>Estado de México</option>
                                        <option value="Guanajuato" {{ (old('estado', $eventLocation['estado'] ?? '') == 'Guanajuato') ? 'selected' : '' }}>Guanajuato</option>
                                        <option value="Yucatan" {{ (old('estado', $eventLocation['estado'] ?? '') == 'Yucatan') ? 'selected' : '' }}>Yucatán</option>
                                    </select>
                                </div>

                                <div class="bg-gradient-to-br from-card/50 to-warning/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                    <label class="block text-text font-bold mb-3 text-lg">📮 Código Postal</label>
                                    <input type="text" name="codigo_postal" id="codigo_postal" maxlength="5"
                                           class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text placeholder-textDark focus:border-warning focus:ring-4 focus:ring-warning/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                           placeholder="Ej: 09440"
                                           value="{{ old('codigo_postal', $eventLocation['codigo_postal'] ?? '') }}">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gradient-to-br from-card/50 to-info/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                    <label class="block text-text font-bold mb-3 text-lg">🌎 País</label>
                                    <select name="pais" id="pais"
                                            class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text focus:border-info focus:ring-4 focus:ring-info/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg">
                                        <option value="México" {{ (old('pais', $eventLocation['pais'] ?? '') == 'México') ? 'selected' : '' }}>México</option>
                                        <option value="Estados Unidos" {{ (old('pais', $eventLocation['pais'] ?? '') == 'Estados Unidos') ? 'selected' : '' }}>Estados Unidos</option>
                                        <option value="Canadá" {{ (old('pais', $eventLocation['pais'] ?? '') == 'Canadá') ? 'selected' : '' }}>Canadá</option>
                                        <option value="Guatemala" {{ (old('pais', $eventLocation['pais'] ?? '') == 'Guatemala') ? 'selected' : '' }}>Guatemala</option>
                                        <option value="Otro" {{ (old('pais', $eventLocation['pais'] ?? '') == 'Otro') ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>
                                <div class="bg-gradient-to-br from-card/50 to-warning/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                    <label class="block text-text font-bold mb-3 text-lg">📮 Código Postal</label>
                                    <input type="text" name="codigo_postal" id="codigo_postal" maxlength="5"
                                           class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text placeholder-textDark focus:border-warning focus:ring-4 focus:ring-warning/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                           placeholder="Ej: 09440"
                                           value="{{ old('codigo_postal', $eventLocation['codigo_postal'] ?? '') }}">
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-card/50 to-accent/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                <label class="block text-text font-bold mb-3 text-lg">📝 Detalles adicionales</label>
                                <textarea name="detalles_ubicacion" id="detalles_ubicacion" rows="3" maxlength="200"
                                          class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text placeholder-textDark focus:border-accent focus:ring-4 focus:ring-accent/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                          placeholder="Ej: Salón principal, 2do piso, referencias para llegar, estacionamiento disponible...">{{ old('detalles_ubicacion', $eventLocation['detalles_ubicacion'] ?? '') }}</textarea>
                                <div class="text-right text-xs text-textMuted mt-1">
                                    <span id="detalles-count">0</span> / 200
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gradient-to-br from-card/50 to-success/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                    <label class="block text-text font-bold mb-3 text-lg">👥 Capacidad aproximada</label>
                                    <select name="capacidad" id="capacidad"
                                            class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text focus:border-success focus:ring-4 focus:ring-success/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg">
                                        <option value="">No especificado</option>
                                        <option value="1-25" {{ (old('capacidad', $eventLocation['capacidad'] ?? '') == '1-25') ? 'selected' : '' }}>1 - 25 personas</option>
                                        <option value="26-50" {{ (old('capacidad', $eventLocation['capacidad'] ?? '') == '26-50') ? 'selected' : '' }}>26 - 50 personas</option>
                                        <option value="51-100" {{ (old('capacidad', $eventLocation['capacidad'] ?? '') == '51-100') ? 'selected' : '' }}>51 - 100 personas</option>
                                        <option value="101-250" {{ (old('capacidad', $eventLocation['capacidad'] ?? '') == '101-250') ? 'selected' : '' }}>101 - 250 personas</option>
                                        <option value="251-500" {{ (old('capacidad', $eventLocation['capacidad'] ?? '') == '251-500') ? 'selected' : '' }}>251 - 500 personas</option>
                                        <option value="501-1000" {{ (old('capacidad', $eventLocation['capacidad'] ?? '') == '501-1000') ? 'selected' : '' }}>501 - 1000 personas</option>
                                        <option value="1000+" {{ (old('capacidad', $eventLocation['capacidad'] ?? '') == '1000+') ? 'selected' : '' }}>Más de 1000 personas</option>
                                    </select>
                                </div>
                                <div class="bg-gradient-to-br from-card/50 to-success/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50 flex items-center">
                                    <label class="flex items-center text-lg text-textMuted">
                                        <input type="checkbox" name="accesible" id="accesible" value="1" 
                                               class="mr-3 rounded border-success bg-success/20 text-success focus:ring-0 w-5 h-5"
                                               {{ old('accesible', $eventLocation['accesible'] ?? '') ? 'checked' : '' }}>
                                        ♿ Lugar accesible para personas con discapacidad
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Virtual Location Section -->
                    <div id="virtual-section" class="section-hidden mb-8">
                        <h3 class="text-text text-2xl font-bold mb-8 flex items-center bg-gradient-to-r from-info to-purple bg-clip-text text-transparent">
                            <span class="mr-4">💻</span> Configuración Virtual
                        </h3>
                        
                        <div class="space-y-8">
                            <!-- Platform and Meeting ID -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gradient-to-br from-card/50 to-info/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                    <label class="block text-text font-bold mb-3 text-lg">📦 Plataforma</label>
                                    <select name="plataforma_virtual" id="plataforma_virtual"
                                            class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text focus:border-info focus:ring-4 focus:ring-info/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg">
                                        <option value="">Selecciona una plataforma</option>
                                        <option value="zoom" {{ (old('plataforma_virtual', $eventLocation['plataforma_virtual'] ?? '') == 'zoom') ? 'selected' : '' }}>Zoom</option>
                                        <option value="google-meet" {{ (old('plataforma_virtual', $eventLocation['plataforma_virtual'] ?? '') == 'google-meet') ? 'selected' : '' }}>Google Meet</option>
                                        <option value="microsoft-teams" {{ (old('plataforma_virtual', $eventLocation['plataforma_virtual'] ?? '') == 'microsoft-teams') ? 'selected' : '' }}>Microsoft Teams</option>
                                        <option value="youtube" {{ (old('plataforma_virtual', $eventLocation['plataforma_virtual'] ?? '') == 'youtube') ? 'selected' : '' }}>YouTube Live</option>
                                        <option value="facebook" {{ (old('plataforma_virtual', $eventLocation['plataforma_virtual'] ?? '') == 'facebook') ? 'selected' : '' }}>Facebook Live</option>
                                        <option value="twitch" {{ (old('plataforma_virtual', $eventLocation['plataforma_virtual'] ?? '') == 'twitch') ? 'selected' : '' }}>Twitch</option>
                                        <option value="discord" {{ (old('plataforma_virtual', $eventLocation['plataforma_virtual'] ?? '') == 'discord') ? 'selected' : '' }}>Discord</option>
                                        <option value="otro" {{ (old('plataforma_virtual', $eventLocation['plataforma_virtual'] ?? '') == 'otro') ? 'selected' : '' }}>Otra plataforma</option>
                                    </select>
                                </div>
                                
                                <div class="bg-gradient-to-br from-card/50 to-purple/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                    <label class="block text-text font-bold mb-3 text-lg">🔑 ID de reunión</label>
                                    <input type="text" name="codigo_acceso" id="codigo_acceso"
                                           class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text placeholder-textDark focus:border-purple focus:ring-4 focus:ring-purple/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                           placeholder="Ej: 123 456 789"
                                           value="{{ old('codigo_acceso', $eventLocation['codigo_acceso'] ?? '') }}">
                                </div>
                            </div>

                            <!-- Event Link -->
                            <div class="bg-gradient-to-br from-card/50 to-accent/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                <label class="block text-text font-bold mb-3 text-lg">🔗 Enlace de acceso *</label>
                                <input type="url" name="event_link" id="event_link"
                                       class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text placeholder-textDark focus:border-accent focus:ring-4 focus:ring-accent/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                       placeholder="https://zoom.us/j/123456789 o https://meet.google.com/abc-defg-hij"
                                       value="{{ old('event_link', $eventLocation['event_link'] ?? '') }}">
                                <div id="link-error" class="text-accent text-sm font-bold mt-3 hidden bg-accent/10 p-3 rounded-lg border border-accent/30">
                                    ⚠️ El enlace es obligatorio para eventos virtuales
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gradient-to-br from-card/50 to-secondary/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                    <label class="block text-text font-bold mb-3 text-lg">🔒 Contraseña</label>
                                    <input type="password" name="password_virtual" id="password_virtual"
                                           class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text placeholder-textDark focus:border-secondary focus:ring-4 focus:ring-secondary/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                           placeholder="Contraseña para acceder al evento"
                                           value="{{ old('password_virtual', $eventLocation['password_virtual'] ?? '') }}">
                                </div>

                                <div class="bg-gradient-to-br from-card/50 to-tertiary/5 backdrop-blur-sm rounded-2xl p-6 border border-cardLight/50">
                                    <label class="block text-text font-bold mb-3 text-lg">📋 Instrucciones adicionales</label>
                                    <textarea name="instrucciones_virtuales" id="instrucciones_virtuales" rows="3" maxlength="150"
                                              class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text placeholder-textDark focus:border-tertiary focus:ring-4 focus:ring-tertiary/20 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg"
                                              placeholder="Ej: Descargar la app antes del evento, activar micrófono al unirse...">{{ old('instrucciones_virtuales', $eventLocation['instrucciones_virtuales'] ?? '') }}</textarea>
                                    <div class="text-right text-xs text-textMuted mt-1">
                                        <span id="instrucciones-count">0</span> / 150
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media Section (si existe) -->
                    <div id="media-section" class="section-hidden mb-8">
                        <h3 class="text-text text-2xl font-bold mb-8 flex items-center bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent">
                            <span class="mr-4">📸</span> Contenido Multimedia
                        </h3>
                        
                        <div class="space-y-8">
                            <div class="media-upload-area p-12 rounded-3xl text-center backdrop-blur-sm">
                                <div class="text-6xl mb-4 text-accent">📁</div>
                                <h4 class="text-xl font-bold text-text mb-2">Sube imágenes o videos</h4>
                                <p class="text-textMuted">Arrastra archivos aquí o haz clic para seleccionar</p>
                                <button type="button" class="mt-4 px-6 py-3 bg-gradient-to-r from-accent to-secondary text-white rounded-xl font-bold hover:from-secondary hover:to-accent transition-all duration-300">
                                    Seleccionar Archivos
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Section (si existe) -->
                    <div id="preview-section" class="section-hidden mb-8">
                        <h3 class="text-text text-2xl font-bold mb-8 flex items-center bg-gradient-to-r from-info to-purple bg-clip-text text-transparent">
                            <span class="mr-4">👁️</span> Vista Previa
                        </h3>
                        
                        <div class="preview-card rounded-3xl p-8 backdrop-blur-lg">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <h4 class="text-xl font-bold text-text">Información del Evento</h4>
                                    <div class="space-y-2 text-textMuted">
                                        <p id="preview-tipo">Tipo: -</p>
                                        <p id="preview-ubicacion">Ubicación: -</p>
                                        <p id="preview-capacidad">Capacidad: -</p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <h4 class="text-xl font-bold text-text">Detalles Adicionales</h4>
                                    <div class="space-y-2 text-textMuted">
                                        <p id="preview-accesible">Accesibilidad: -</p>
                                        <p id="preview-plataforma">Plataforma: -</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between items-center pt-8 border-t-2 border-gradient-to-r from-accent/20 to-secondary/20">
                        <button type="button" id="btn-limpiar-ubicacion" 
                                class="px-8 py-4 border-2 border-tertiary text-tertiary rounded-xl font-bold hover:bg-tertiary hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-tertiary/30">
                            🗑️ Limpiar Ubicación
                        </button>
                        
                        <button type="submit" id="submit-btn" 
                                class="px-12 py-4 bg-gradient-to-r from-info to-purple text-white rounded-xl font-bold hover:from-purple hover:to-info transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-info/40 disabled:opacity-50 disabled:cursor-not-allowed" 
                                disabled>
                            Siguiente → 🎬
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('location-form');
            const radioButtons = document.querySelectorAll('input[name="tipo_evento"]');
            const physicalSection = document.getElementById('physical-section');
            const virtualSection = document.getElementById('virtual-section');
            const statusMessage = document.getElementById('status-message');
            const submitBtn = document.getElementById('submit-btn');

            // Character counters
            const detallesTextarea = document.getElementById('detalles_ubicacion');
            const detallesCount = document.getElementById('detalles-count');
            const instruccionesTextarea = document.getElementById('instrucciones_virtuales');
            const instruccionesCount = document.getElementById('instrucciones-count');

            // Setup character counters
            if (detallesTextarea && detallesCount) {
                detallesTextarea.addEventListener('input', function() {
                    const length = Math.min(this.value.length, 200);
                    detallesCount.textContent = length;
                    if (this.value.length > 200) {
                        this.value = this.value.substring(0, 200);
                    }
                });
                detallesCount.textContent = detallesTextarea.value.length;
            }

            if (instruccionesTextarea && instruccionesCount) {
                instruccionesTextarea.addEventListener('input', function() {
                    const length = Math.min(this.value.length, 150);
                    instruccionesCount.textContent = length;
                    if (this.value.length > 150) {
                        this.value = this.value.substring(0, 150);
                    }
                });
                instruccionesCount.textContent = instruccionesTextarea.value.length;
            }

            // Postal code validation (numbers only)
            const codigoPostal = document.getElementById('codigo_postal');
            if (codigoPostal) {
                codigoPostal.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            }

            // Auto-fill city based on state
            const estadoSelect = document.getElementById('estado');
            const ciudadInput = document.getElementById('ciudad');
            
            if (estadoSelect && ciudadInput) {
                const ciudadesPorEstado = {
                    'CDMX': 'Ciudad de México',
                    'Jalisco': 'Guadalajara',
                    'Nuevo León': 'Monterrey',
                    'Puebla': 'Puebla',
                    'Veracruz': 'Veracruz'
                };
                
                estadoSelect.addEventListener('change', function() {
                    if (ciudadesPorEstado[this.value] && !ciudadInput.value.trim()) {
                        ciudadInput.value = ciudadesPorEstado[this.value];
                    }
                });
            }

            // Address placeholder toggle
            const sinNumero = document.getElementById('sin_numero');
            const direccionInput = document.getElementById('direccion_completa');
            
            if (sinNumero && direccionInput) {
                sinNumero.addEventListener('change', function() {
                    direccionInput.placeholder = this.checked ? 
                        'Ej: Calle sin número, Colonia Centro' : 
                        'Ej: Av. Insurgentes Sur 1457, Col. San José Insurgentes';
                });
            }

            // Event type change handler
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        handleEventTypeChange(this.value, this.dataset.target);
                    }
                });
            });

            function handleEventTypeChange(eventType, target) {
                console.log('Event type changed to:', eventType, 'Target:', target);
                
                // Hide all sections first
                physicalSection.classList.add('section-hidden');
                physicalSection.classList.remove('section-visible');
                virtualSection.classList.add('section-hidden');
                virtualSection.classList.remove('section-visible');
                
                // Update status message
                const messages = {
                    'Presencial': {
                        title: '🏢 Evento presencial - Completa la información de ubicación física',
                        desc: 'Los asistentes irán físicamente al lugar del evento'
                    },
                    'Virtual': {
                        title: '💻 Evento virtual - Configura el enlace de acceso online',
                        desc: 'Los asistentes participarán desde cualquier lugar con internet'
                    },
                    'Híbrido': {
                        title: '🌐 Evento híbrido - Configura tanto la ubicación física como el acceso virtual',
                        desc: 'Algunos asistentes irán presencialmente y otros participarán virtualmente'
                    }
                };
                
                const message = messages[eventType];
                if (message) {
                    statusMessage.innerHTML = `
                        <div class="text-text font-medium">${message.title}</div>
                        <div class="text-xs text-gray-400 mt-1">${message.desc}</div>
                    `;
                }

                // Show appropriate sections
                switch(target) {
                    case 'physical':
                        physicalSection.classList.remove('section-hidden');
                        physicalSection.classList.add('section-visible');
                        console.log('Showing physical section');
                        break;
                    case 'virtual':
                        virtualSection.classList.remove('section-hidden');
                        virtualSection.classList.add('section-visible');
                        console.log('Showing virtual section');
                        break;
                    case 'hybrid':
                        physicalSection.classList.remove('section-hidden');
                        physicalSection.classList.add('section-visible');
                        virtualSection.classList.remove('section-hidden');
                        virtualSection.classList.add('section-visible');
                        console.log('Showing both sections');
                        break;
                }

                // Enable submit button
                submitBtn.disabled = false;
            }

            // Form validation
            form.addEventListener('submit', function(e) {
                const selectedType = document.querySelector('input[name="tipo_evento"]:checked');
                
                if (!selectedType) {
                    e.preventDefault();
                    document.getElementById('type-error').classList.remove('hidden');
                    return false;
                }
                
                document.getElementById('type-error').classList.add('hidden');
                
                const eventType = selectedType.value;
                let isValid = true;

                // Validate based on event type
                if (eventType === 'Presencial' || eventType === 'Híbrido') {
                    isValid = validatePhysicalFields() && isValid;
                }
                
                if (eventType === 'Virtual' || eventType === 'Híbrido') {
                    isValid = validateVirtualFields() && isValid;
                }

                if (!isValid) {
                    e.preventDefault();
                    return false;
                }

                // Disable submit button to prevent double submission
                submitBtn.disabled = true;
                submitBtn.textContent = 'Procesando...';
            });

            function validatePhysicalFields() {
                const requiredFields = ['nombre_lugar', 'direccion_completa', 'ciudad', 'estado'];
                let isValid = true;
                
                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field && !field.value.trim()) {
                        field.classList.add('border-red-400');
                        isValid = false;
                    } else if (field) {
                        field.classList.remove('border-red-400');
                    }
                });
                
                return isValid;
            }

            function validateVirtualFields() {
                const linkField = document.getElementById('event_link');
                const linkError = document.getElementById('link-error');
                
                if (!linkField.value.trim()) {
                    linkField.classList.add('border-red-400');
                    linkError.classList.remove('hidden');
                    return false;
                } else {
                    linkField.classList.remove('border-red-400');
                    linkError.classList.add('hidden');
                    return true;
                }
            }

            // Restaurar tipo de evento si existe
            const eventLocationData = @json($eventLocation);
            if (Object.keys(eventLocationData).length > 0) {
                console.log('✅ Datos existentes de ubicación cargados:', eventLocationData);
                
                // Si hay un tipo de evento preseleccionado, activar las secciones correspondientes
                const tipoEvento = eventLocationData.tipo_evento;
                if (tipoEvento) {
                    const radioSelected = document.querySelector(`input[value="${tipoEvento}"]`);
                    if (radioSelected) {
                        setTimeout(() => {
                            handleEventTypeChange(tipoEvento, radioSelected.dataset.target);
                        }, 100);
                    }
                }
            }

            console.log('Location form initialized');

            // Botón para limpiar ubicación
            document.getElementById('btn-limpiar-ubicacion').addEventListener('click', function() {
                if (confirm('¿Estás seguro de que quieres limpiar toda la información de ubicación? Esta acción no se puede deshacer.')) {
                    // Limpiar radios
                    document.querySelectorAll('input[name="tipo_evento"]').forEach(radio => {
                        radio.checked = false;
                        radio.parentElement.querySelector('.radio-label').classList.remove('border-accent', 'bg-accent/10');
                    });
                    
                    // Limpiar todos los campos del formulario
                    const campos = [
                        'nombre_lugar', 'direccion_completa', 'ciudad', 'estado', 'pais', 'codigo_postal',
                        'detalles_ubicacion', 'capacidad', 'plataforma_virtual', 'codigo_acceso',
                        'event_link', 'password_virtual', 'instrucciones_virtuales'
                    ];
                    
                    campos.forEach(campoId => {
                        const campo = document.getElementById(campoId);
                        if (campo) {
                            if (campo.type === 'checkbox') {
                                campo.checked = false;
                            } else {
                                campo.value = '';
                            }
                        }
                    });
                    
                    // Limpiar checkboxes
                    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    
                    // Resetear contadores
                    const detallesCount = document.getElementById('detalles-count');
                    const instruccionesCount = document.getElementById('instrucciones-count');
                    if (detallesCount) detallesCount.textContent = '0';
                    if (instruccionesCount) instruccionesCount.textContent = '0';
                    
                    // Ocultar secciones
                    physicalSection.classList.add('section-hidden');
                    physicalSection.classList.remove('section-visible');
                    virtualSection.classList.add('section-hidden');
                    virtualSection.classList.remove('section-visible');
                    
                    // Resetear mensaje de estado
                    statusMessage.innerHTML = `
                        <div class="text-text font-medium">⚙️ Selecciona el tipo de evento para continuar</div>
                        <div class="text-xs text-gray-400 mt-1">Los campos se mostrarán según tu selección</div>
                    `;
                    
                    // Deshabilitar botón siguiente
                    submitBtn.disabled = true;
                    
                    // Limpiar sesión del servidor
                    fetch('{{ route("event.clearLocation") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(() => {
                        console.log('Datos de ubicación limpiados del servidor');
                        alert('✅ Información de ubicación limpiada correctamente');
                    });
                }
            });
        });
    </script>
</body>
</html>
