<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FestiSpot - Configuración</title>
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
              background: '#0a0a0f',
              card: '#16213e',
              cardLight: '#1e2749',
              accent: '#ff4081',
              secondary: '#00e5ff',
              tertiary: '#7c4dff',
              success: '#00c853',
              warning: '#ff6b35',
              info: '#2196f3',
              purple: '#9c27b0',
              text: '#ffffff',
              textMuted: '#b0bec5',
              textDark: '#78909c',
              glow: '#ff4081'
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
      
      .toggle-switch {
        width: 50px;
        height: 24px;
        background: #374151;
        border-radius: 12px;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
      }
      .toggle-switch:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(255, 64, 129, 0.2);
      }
      .toggle-switch.active {
        background: linear-gradient(135deg, #ff4081, #00e5ff);
        box-shadow: 0 4px 15px rgba(255, 64, 129, 0.4);
      }
      .toggle-switch::after {
        content: '';
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
        position: absolute;
        top: 2px;
        left: 2px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      }
      .toggle-switch.active::after {
        transform: translateX(26px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
      }
      
      .setting-card {
        background: linear-gradient(135deg, rgba(22, 33, 62, 0.8) 0%, rgba(30, 39, 73, 0.6) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
      }
      .setting-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px rgba(255, 64, 129, 0.2);
        border-color: rgba(255, 64, 129, 0.3);
      }
      
      @keyframes switchToggle {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
      }
    </style>
</head>
<body class="bg-background text-text min-h-screen">
    <!-- Icono de usuario en esquina superior derecha -->
    <div class="fixed top-4 right-4 z-50">
        @include('partials.user-icon')
    </div>

    <!-- Efectos de fondo -->
    <div class="fixed inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="relative flex size-full min-h-screen flex-col bg-background z-10">
        <!-- Header -->
        <header class="header">
            <div style="max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 16px 40px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <img src="{{ asset('assets/images/logo-festispot.png') }}" alt="FestiSpot Logo" style="width: 70px; height: 70px; border-radius: 50%;">
                    <h1 style="font-size: 22px; font-weight: 700; background: linear-gradient(135deg, #ff4081, #00e5ff, #7c4dff); background-clip: text; -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.5px;">FestiSpot</h1>
                </div>
                
                <nav style="display: flex; gap: 8px;">
                    <a href="/" class="nav-link">Inicio</a>
                    <a href="/configuration" class="nav-link active">Configuración</a>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <div class="flex-1 px-8 md:px-20 lg:px-40 py-6">
            <div class="max-w-6xl mx-auto">
                
                <!-- Title Section -->
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-bold leading-tight mb-4 bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">
                        ⚙️ Configuración
                    </h1>
                    <p class="text-textMuted text-lg leading-relaxed max-w-3xl mx-auto">
                        🛠️ Personaliza tu experiencia en FestiSpot. Ajusta preferencias, notificaciones y configuraciones de cuenta.
                    </p>
                </div>

                <!-- Settings Sections -->
                <div class="space-y-8">
                    
                    <!-- Perfil de Usuario -->
                    <form id="profileForm" enctype="multipart/form-data">
                        @csrf
                        <div class="setting-card rounded-3xl p-8">
                            <h2 class="text-2xl font-bold mb-6 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent flex items-center">
                                <span class="mr-3">👤</span> Perfil de Usuario
                            </h2>
                        
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Nombre</label>
                                    <input type="text" name="nombre" value="{{ $user->nombre }}" 
                                           class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:border-accent focus:ring-2 focus:ring-accent/30 focus:outline-none transition-all">
                                </div>
                                
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Apellido</label>
                                    <input type="text" name="apellido" value="{{ $user->apellido }}" 
                                           class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:border-accent focus:ring-2 focus:ring-accent/30 focus:outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}" 
                                           class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:border-accent focus:ring-2 focus:ring-accent/30 focus:outline-none transition-all">
                                </div>
                                
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Teléfono</label>
                                    <input type="tel" name="telefono" value="{{ $user->telefono ?? '' }}" 
                                           class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:border-accent focus:ring-2 focus:ring-accent/30 focus:outline-none transition-all">
                                </div>
                            </div>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" value="{{ $user->fecha_nacimiento ? $user->fecha_nacimiento->format('Y-m-d') : '' }}" 
                                           class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:border-accent focus:ring-2 focus:ring-accent/30 focus:outline-none transition-all">
                                </div>
                                
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Género</label>
                                    <select name="genero" class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:border-accent focus:ring-2 focus:ring-accent/30 focus:outline-none transition-all">
                                        <option value="">Prefiero no especificar</option>
                                        <option value="masculino" {{ $user->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="femenino" {{ $user->genero == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                        <option value="otro" {{ $user->genero == 'otro' ? 'selected' : '' }}>Otro</option>
                                        <option value="prefiero_no_decir" {{ $user->genero == 'prefiero_no_decir' ? 'selected' : '' }}>Prefiero no decir</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Rol</label>
                                    <input type="text" value="{{ ucfirst($user->rol->nombre ?? 'Asistente') }}" 
                                           class="w-full bg-cardLight/30 border border-cardLight/30 rounded-xl px-4 py-3 text-textMuted cursor-not-allowed" readonly>
                                </div>
                                
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Foto de Perfil</label>
                                    <div class="space-y-3">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-16 h-16 rounded-full bg-gradient-to-r from-accent to-secondary flex items-center justify-center overflow-hidden">
                                                @if($user->avatar_image)
                                                    <img src="{{ $user->avatar_image }}" alt="Avatar" class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-white text-xl font-bold">{{ $user->initial }}</span>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <input type="file" name="avatar" id="avatar" accept="image/*" 
                                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:border-accent focus:ring-2 focus:ring-accent/30 focus:outline-none transition-all file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-accent file:text-white hover:file:bg-secondary">
                                                <p class="text-xs text-textMuted mt-1">JPG, PNG o GIF. Máximo 2MB.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Miembro desde</label>
                                    <input type="text" value="{{ $user->fecha_registro ? $user->fecha_registro->format('d/m/Y') : $user->created_at->format('d/m/Y') }}" 
                                           class="w-full bg-cardLight/30 border border-cardLight/30 rounded-xl px-4 py-3 text-textMuted cursor-not-allowed" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-accent to-secondary text-white rounded-xl font-bold hover:from-secondary hover:to-accent transition-all duration-300 shadow-lg">
                                💾 Guardar Cambios del Perfil
                            </button>
                        </div>
                    </div>
                    </form>

                    <!-- Notificaciones -->
                    <div class="setting-card rounded-3xl p-8">
                        <h2 class="text-2xl font-bold mb-6 bg-gradient-to-r from-info to-tertiary bg-clip-text text-transparent flex items-center">
                            <span class="mr-3">🔔</span> Notificaciones
                        </h2>
                        
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <h3 class="text-lg font-semibold text-text mb-4">📧 Notificaciones por Email</h3>
                                
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Nuevos asistentes</div>
                                            <div class="text-sm text-textMuted">Recibe un email cuando alguien se registre a tus eventos</div>
                                        </div>
                                        <div class="toggle-switch {{ $configuracion->notificaciones_email ? 'active' : '' }}" onclick="toggleSwitch(this)"></div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Solicitudes de productores</div>
                                            <div class="text-sm text-textMuted">Notificaciones sobre nuevas solicitudes de colaboración</div>
                                        </div>
                                        <div class="toggle-switch {{ $configuracion->notificaciones_email ? 'active' : '' }}" onclick="toggleSwitch(this)"></div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Comentarios y reseñas</div>
                                            <div class="text-sm text-textMuted">Cuando recibas comentarios en tus eventos</div>
                                        </div>
                                        <div class="toggle-switch {{ $configuracion->notificaciones_email ? 'active' : '' }}" onclick="toggleSwitch(this)"></div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Recordatorios de eventos</div>
                                            <div class="text-sm text-textMuted">Recordatorios antes de tus eventos programados</div>
                                        </div>
                                        <div class="toggle-switch {{ $configuracion->notificaciones_email ? 'active' : '' }}" onclick="toggleSwitch(this)"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-6">
                                <h3 class="text-lg font-semibold text-text mb-4">📱 Notificaciones Push</h3>
                                
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Mensajes urgentes</div>
                                            <div class="text-sm text-textMuted">Notificaciones importantes sobre tus eventos</div>
                                        </div>
                                        <div class="toggle-switch {{ $configuracion->notificaciones_push ? 'active' : '' }}" onclick="toggleSwitch(this)"></div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Actualizaciones de la plataforma</div>
                                            <div class="text-sm text-textMuted">Nuevas funciones y mejoras de FestiSpot</div>
                                        </div>
                                        <div class="toggle-switch {{ $configuracion->notificaciones_push ? 'active' : '' }}" onclick="toggleSwitch(this)"></div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Promociones especiales</div>
                                            <div class="text-sm text-textMuted">Ofertas y descuentos exclusivos</div>
                                        </div>
                                        <div class="toggle-switch" onclick="toggleSwitch(this)"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Privacidad y Seguridad -->
                    <div class="setting-card rounded-3xl p-8">
                        <h2 class="text-2xl font-bold mb-6 bg-gradient-to-r from-tertiary to-purple bg-clip-text text-transparent flex items-center">
                            <span class="mr-3">🔒</span> Privacidad y Seguridad
                        </h2>
                        
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <h3 class="text-lg font-semibold text-text mb-4">🛡️ Configuración de Privacidad</h3>
                                
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Perfil público</div>
                                            <div class="text-sm text-textMuted">Permitir que otros usuarios vean tu perfil</div>
                                        </div>
                                        <div class="toggle-switch active" onclick="toggleSwitch(this)"></div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Mostrar eventos pasados</div>
                                            <div class="text-sm text-textMuted">Mostrar tu historial de eventos en el perfil</div>
                                        </div>
                                        <div class="toggle-switch active" onclick="toggleSwitch(this)"></div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Compartir estadísticas</div>
                                            <div class="text-sm text-textMuted">Permitir mostrar estadísticas de tus eventos</div>
                                        </div>
                                        <div class="toggle-switch" onclick="toggleSwitch(this)"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-6">
                                <h3 class="text-lg font-semibold text-text mb-4">🔐 Seguridad de la Cuenta</h3>
                                
                                <div class="space-y-4">
                                    <button class="w-full bg-gradient-to-r from-info/20 to-info/10 border border-info/30 rounded-xl px-4 py-3 text-info font-medium hover:bg-info/30 transition-all text-left">
                                        🔑 Cambiar contraseña
                                    </button>
                                    
                                    <button class="w-full bg-gradient-to-r from-success/20 to-success/10 border border-success/30 rounded-xl px-4 py-3 text-success font-medium hover:bg-success/30 transition-all text-left">
                                        📱 Configurar autenticación de dos factores
                                    </button>
                                    
                                    <button class="w-full bg-gradient-to-r from-warning/20 to-warning/10 border border-warning/30 rounded-xl px-4 py-3 text-warning font-medium hover:bg-warning/30 transition-all text-left">
                                        📋 Ver dispositivos conectados
                                    </button>
                                    
                                    <button class="w-full bg-gradient-to-r from-accent/20 to-accent/10 border border-accent/30 rounded-xl px-4 py-3 text-accent font-medium hover:bg-accent/30 transition-all text-left">
                                        📥 Descargar mis datos
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preferencias de Eventos -->
                    <div class="setting-card rounded-3xl p-8">
                        <h2 class="text-2xl font-bold mb-6 bg-gradient-to-r from-success to-warning bg-clip-text text-transparent flex items-center">
                            <span class="mr-3">🎪</span> Preferencias de Eventos
                        </h2>
                        
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Zona horaria predeterminada</label>
                                    <select class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:border-success focus:ring-2 focus:ring-success/30 focus:outline-none transition-all">
                                        <option>GMT-6 (Ciudad de México)</option>
                                        <option>GMT-7 (Tijuana)</option>
                                        <option>GMT-5 (Cancún)</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Formato de fecha predeterminado</label>
                                    <select class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:border-success focus:ring-2 focus:ring-success/30 focus:outline-none transition-all">
                                        <option>DD/MM/YYYY</option>
                                        <option>MM/DD/YYYY</option>
                                        <option>YYYY-MM-DD</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Duración predeterminada de eventos</label>
                                    <select class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:border-success focus:ring-2 focus:ring-success/30 focus:outline-none transition-all">
                                        <option>2 horas</option>
                                        <option>4 horas</option>
                                        <option>1 día completo</option>
                                        <option>Fin de semana</option>
                                        <option>Personalizado</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-textMuted text-sm font-medium mb-3">Categorías favoritas de eventos</label>
                                    <div class="space-y-2">
                                        @foreach($categorias as $categoria)
                                        <label class="flex items-center">
                                            <input type="checkbox" 
                                                   name="categorias_favoritas[]" 
                                                   value="{{ $categoria->id }}"
                                                   {{ $configuracion->categorias_favoritas && in_array($categoria->id, $configuracion->categorias_favoritas) ? 'checked' : '' }}
                                                   class="mr-3 h-4 w-4 text-accent rounded border-gray-300 focus:ring-accent">
                                            <span class="text-textMuted">{{ $categoria->icono ?? '🎪' }} {{ $categoria->nombre }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Auto-publicar eventos</div>
                                            <div class="text-sm text-textMuted">Publicar automáticamente después de completar</div>
                                        </div>
                                        <div class="toggle-switch" onclick="toggleSwitch(this)"></div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-medium text-text">Recordatorios automáticos</div>
                                            <div class="text-sm text-textMuted">Enviar recordatorios a asistentes</div>
                                        </div>
                                        <div class="toggle-switch active" onclick="toggleSwitch(this)"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Integrations -->
                    <div class="setting-card rounded-3xl p-8">
                        <h2 class="text-2xl font-bold mb-6 bg-gradient-to-r from-secondary to-info bg-clip-text text-transparent flex items-center">
                            <span class="mr-3">🔗</span> Integraciones
                        </h2>
                        
                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="bg-cardLight/30 rounded-2xl p-6 text-center border border-success/30">
                                <div class="text-4xl mb-3">📅</div>
                                <h3 class="font-bold text-success mb-2">Google Calendar</h3>
                                <p class="text-sm text-textMuted mb-4">Sincroniza tus eventos con Google Calendar</p>
                                <button class="w-full px-4 py-2 bg-success/20 text-success rounded-lg font-medium hover:bg-success/30 transition-all">
                                    ✅ Conectado
                                </button>
                            </div>
                            
                            <div class="bg-cardLight/30 rounded-2xl p-6 text-center border border-info/30">
                                <div class="text-4xl mb-3">📊</div>
                                <h3 class="font-bold text-info mb-2">Google Analytics</h3>
                                <p class="text-sm text-textMuted mb-4">Rastrea el rendimiento de tus eventos</p>
                                <button class="w-full px-4 py-2 bg-info/20 text-info rounded-lg font-medium hover:bg-info/30 transition-all">
                                    🔗 Conectar
                                </button>
                            </div>
                            
                            <div class="bg-cardLight/30 rounded-2xl p-6 text-center border border-warning/30">
                                <div class="text-4xl mb-3">💬</div>
                                <h3 class="font-bold text-warning mb-2">WhatsApp Business</h3>
                                <p class="text-sm text-textMuted mb-4">Envía notificaciones por WhatsApp</p>
                                <button class="w-full px-4 py-2 bg-warning/20 text-warning rounded-lg font-medium hover:bg-warning/30 transition-all">
                                    🔗 Conectar
                                </button>
                            </div>
                            
                            <div class="bg-cardLight/30 rounded-2xl p-6 text-center border border-tertiary/30">
                                <div class="text-4xl mb-3">📧</div>
                                <h3 class="font-bold text-tertiary mb-2">Mailchimp</h3>
                                <p class="text-sm text-textMuted mb-4">Gestiona listas de correo de asistentes</p>
                                <button class="w-full px-4 py-2 bg-tertiary/20 text-tertiary rounded-lg font-medium hover:bg-tertiary/30 transition-all">
                                    🔗 Conectar
                                </button>
                            </div>
                            
                            <div class="bg-cardLight/30 rounded-2xl p-6 text-center border border-purple/30">
                                <div class="text-4xl mb-3">💳</div>
                                <h3 class="font-bold text-purple mb-2">Stripe</h3>
                                <p class="text-sm text-textMuted mb-4">Procesa pagos de entradas</p>
                                <button class="w-full px-4 py-2 bg-purple/20 text-purple rounded-lg font-medium hover:bg-purple/30 transition-all">
                                    🔗 Conectar
                                </button>
                            </div>
                            
                            <div class="bg-cardLight/30 rounded-2xl p-6 text-center border border-accent/30">
                                <div class="text-4xl mb-3">📱</div>
                                <h3 class="font-bold text-accent mb-2">Redes Sociales</h3>
                                <p class="text-sm text-textMuted mb-4">Publica automáticamente en redes</p>
                                <button class="w-full px-4 py-2 bg-accent/20 text-accent rounded-lg font-medium hover:bg-accent/30 transition-all">
                                    🔗 Conectar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Zona de Peligro -->
                    <div class="setting-card rounded-3xl p-8 border-2 border-red-500/30">
                        <h2 class="text-2xl font-bold mb-6 text-red-400 flex items-center">
                            <span class="mr-3">⚠️</span> Zona de Peligro
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-6">
                                <h3 class="font-bold text-red-400 mb-2">Exportar todos mis datos</h3>
                                <p class="text-textMuted text-sm mb-4">Descarga una copia completa de todos tus datos en FestiSpot</p>
                                <button class="px-4 py-2 bg-red-500/20 text-red-400 rounded-lg font-medium hover:bg-red-500/30 transition-all">
                                    📥 Exportar Datos
                                </button>
                            </div>
                            
                            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-6">
                                <h3 class="font-bold text-red-400 mb-2">Desactivar cuenta temporalmente</h3>
                                <p class="text-textMuted text-sm mb-4">Tu cuenta será oculta pero podrás reactivarla cuando quieras</p>
                                <button class="px-4 py-2 bg-red-500/20 text-red-400 rounded-lg font-medium hover:bg-red-500/30 transition-all">
                                    ⏸️ Desactivar Cuenta
                                </button>
                            </div>
                            
                            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-6">
                                <h3 class="font-bold text-red-400 mb-2">Eliminar cuenta permanentemente</h3>
                                <p class="text-textMuted text-sm mb-4">Esta acción no se puede deshacer. Todos tus datos serán eliminados.</p>
                                <button class="px-4 py-2 bg-red-500/20 text-red-400 rounded-lg font-medium hover:bg-red-500/30 transition-all">
                                    🗑️ Eliminar Cuenta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save All Button -->
                <div class="mt-12 text-center">
                    <button class="px-12 py-4 bg-gradient-to-r from-secondary to-info text-white rounded-2xl font-bold hover:from-info hover:to-secondary transition-all duration-300 shadow-2xl hover:shadow-secondary/40 text-xl transform hover:scale-105">
                        💾 Guardar Toda la Configuración
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSwitch(element) {
            element.classList.toggle('active');
            
            // Agregar efecto de vibración
            element.style.animation = 'none';
            setTimeout(() => {
                element.style.animation = 'switchToggle 0.3s ease';
            }, 10);
            
            // Mostrar feedback visual temporal
            const parentContainer = element.closest('.flex');
            if (parentContainer) {
                parentContainer.style.backgroundColor = 'rgba(255, 64, 129, 0.1)';
                setTimeout(() => {
                    parentContainer.style.backgroundColor = '';
                }, 300);
            }
        }

        // Agregar animación CSS para el toggle
        const style = document.createElement('style');
        style.textContent = `
            @keyframes switchToggle {
                0% { transform: scale(1); }
                50% { transform: scale(1.1); }
                100% { transform: scale(1); }
            }
        `;
        document.head.appendChild(style);

        document.addEventListener('DOMContentLoaded', function() {
            console.log('⚙️ Configuración cargada');

            // Manejo del formulario de perfil
            const profileForm = document.getElementById('profileForm');
            if (profileForm) {
                profileForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    saveProfile(this);
                });
            }
            
            // Simular guardado de configuración para otros botones
            const saveButtons = document.querySelectorAll('button');
            saveButtons.forEach(button => {
                if (button.textContent.includes('Guardar') && button.type !== 'submit') {
                    button.addEventListener('click', function() {
                        const originalText = this.innerHTML;
                        this.innerHTML = '⏳ Guardando...';
                        this.disabled = true;
                        
                        setTimeout(() => {
                            this.innerHTML = '✅ Guardado';
                            setTimeout(() => {
                                this.innerHTML = originalText;
                                this.disabled = false;
                            }, 1000);
                        }, 1500);
                    });
                }
            });
        });

        function saveProfile(form) {
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            submitButton.innerHTML = '⏳ Guardando perfil...';
            submitButton.disabled = true;
            
            const formData = new FormData(form);
            
            fetch('/configuration/profile', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    submitButton.innerHTML = '✅ Perfil actualizado';
                    showNotification('Perfil actualizado correctamente', 'success');
                } else {
                    submitButton.innerHTML = '❌ Error';
                    showNotification('Error al actualizar el perfil', 'error');
                }
                
                setTimeout(() => {
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                }, 2000);
            })
            .catch(error => {
                console.error('Error:', error);
                submitButton.innerHTML = '❌ Error';
                showNotification('Error de conexión', 'error');
                
                setTimeout(() => {
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                }, 2000);
            });
        }

        function showNotification(message, type) {
            // Crear notificación temporal
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-xl text-white font-medium shadow-lg transition-all duration-300 ${
                type === 'success' ? 'bg-success' : 'bg-accent'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Animación de entrada
            setTimeout(() => notification.style.transform = 'translateX(0)', 10);
            
            // Remover después de 3 segundos
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => document.body.removeChild(notification), 300);
            }, 3000);
        }
    </script>
</body>
</html>
</body>
</html>
