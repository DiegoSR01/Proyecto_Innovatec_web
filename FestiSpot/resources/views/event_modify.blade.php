<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Modificar Evento</title>
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
        <!-- Encabezado unificado -->
        <header class="w-full bg-gradient-to-r from-card to-cardLight/80 border-b border-cardLight/30 shadow-lg backdrop-blur-xl">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between px-4 md:px-10 py-4 gap-2">
                <!-- Branding y navegación -->
                <div class="flex items-center gap-6">
                    <span class="text-2xl font-black bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent tracking-tight select-none">FestiSpot</span>
                    <nav class="flex items-center gap-2 text-textMuted text-base font-medium">
                        <a href="/" class="hover:text-accent transition-colors flex items-center gap-1">
                            <i class="fa-solid fa-house"></i> <span class="hidden sm:inline">Inicio</span>
                        </a>
                        <span class="mx-2 text-accent">/</span>
                        <span class="text-text font-bold">Mis eventos</span>
                    </nav>
                </div>
                <!-- Mi perfil -->
                <a href="/perfil" class="flex items-center gap-2 text-text hover:text-accent font-semibold transition-colors">
                    <i class="fa-solid fa-user-circle text-2xl"></i>
                    <span class="hidden sm:inline">Mi perfil</span>
                </a>
            </div>
        </header>
        <!-- Main Content -->
        <div class="flex-1 px-8 md:px-20 lg:px-40 py-6">
            <div class="max-w-6xl mx-auto">
                <!-- Title Section -->
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-bold leading-tight mb-4 bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">
                        ✏️ Modificar Evento
                    </h1>
                    <p class="text-textMuted text-lg leading-relaxed max-w-3xl mx-auto">
                        📝 Modifica los detalles permitidos del evento. Los cambios serán notificados a todos los asistentes y productores.
                    </p>
                </div>

                <!-- Event Basic Info Display -->
                <div class="bg-gradient-to-br from-info/20 to-info/5 border-2 border-info/30 rounded-2xl p-6 mb-8 backdrop-blur-lg">
                    <h2 class="text-2xl font-bold text-info mb-4 flex items-center">
                        <span class="mr-3">ℹ️</span> Información del Evento Actual
                    </h2>
                    <div id="eventInfo" class="grid md:grid-cols-3 gap-4 text-textMuted">
                        <div class="flex items-center gap-2">
                            <span class="text-accent">📅</span>
                            <div>
                                <div class="text-xs text-textMuted">Fecha del evento</div>
                                <span class="font-semibold">Viernes, 15 de febrero de 2024</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-secondary">⏰</span>
                            <div>
                                <div class="text-xs text-textMuted">Horario</div>
                                <span class="font-semibold">20:00 - 02:00</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-tertiary">📍</span>
                            <div>
                                <div class="text-xs text-textMuted">Ubicación</div>
                                <span class="font-semibold">Ciudad de México</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-success">👥</span>
                            <div>
                                <div class="text-xs text-textMuted">Asistentes</div>
                                <span class="font-semibold">245 confirmados</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-warning">⚠️</span>
                            <div>
                                <div class="text-xs text-textMuted">Días restantes</div>
                                <span class="font-semibold text-warning">7 días</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-purple">📊</span>
                            <div>
                                <div class="text-xs text-textMuted">Estado</div>
                                <span class="font-semibold text-success">Publicado</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modification Form -->
                <form id="modificationForm" class="space-y-8">
                    <input type="hidden" id="eventId" name="event_id" value="1">
                    
                    <!-- Basic Information Section -->
                    <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-6">
                        <h3 class="text-2xl font-bold text-text mb-6 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent flex items-center">
                            <span class="mr-3">📝</span> Información Básica
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Event Name -->
                            <div class="md:col-span-2">
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Nombre del Evento *
                                </label>
                                <input type="text" id="eventName" name="event_name" required
                                       value="Festival de Música Electrónica 2024"
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <!-- Category -->
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Categoría *
                                </label>
                                <select id="eventCategory" name="event_category" required
                                        class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                    <option value="">Selecciona una categoría</option>
                                    <option value="Música" selected>🎵 Música</option>
                                    <option value="Teatro">🎭 Teatro</option>
                                    <option value="Danza">💃 Danza</option>
                                    <option value="Arte">🎨 Arte</option>
                                    <option value="Tecnología">💻 Tecnología</option>
                                    <option value="Educación">📚 Educación</option>
                                    <option value="Deportes">⚽ Deportes</option>
                                    <option value="Gastronomía">🍽️ Gastronomía</option>
                                    <option value="Negocios">💼 Negocios</option>
                                    <option value="Otro">📦 Otro</option>
                                </select>
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <!-- Status -->
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Estado del Evento
                                </label>
                                <select id="eventStatus" name="event_status"
                                        class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                    <option value="published" selected>📢 Publicado</option>
                                    <option value="draft">📝 Borrador</option>
                                    <option value="cancelled">❌ Cancelado</option>
                                    <option value="postponed">⏸️ Pospuesto</option>
                                </select>
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Descripción del Evento *
                                </label>
                                <textarea id="eventDescription" name="event_description" required rows="4"
                                          placeholder="Describe tu evento de manera detallada..."
                                          class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm resize-none">Un festival increíble con los mejores DJs del mundo. Ven a disfrutar de una noche llena de música electrónica, luces espectaculares y una experiencia única que recordarás para siempre. Contaremos con múltiples escenarios, food trucks y áreas VIP.</textarea>
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                        </div>
                    </div>

                    <!-- Date and Time Section -->
                    <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-6">
                        <h3 class="text-2xl font-bold text-text mb-6 bg-gradient-to-r from-info to-tertiary bg-clip-text text-transparent flex items-center">
                            <span class="mr-3">📅</span> Fecha y Horario
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Fecha de Inicio *
                                </label>
                                <input type="date" id="dateStart" name="date_start" 
                                       value="2024-02-15"
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Fecha de Fin *
                                </label>
                                <input type="date" id="dateEnd" name="date_end" 
                                       value="2024-02-15"
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Hora de Inicio *
                                </label>
                                <input type="time" id="timeStart" name="time_start" 
                                       value="20:00"
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Hora de Fin *
                                </label>
                                <input type="time" id="timeEnd" name="time_end" 
                                       value="02:00"
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                        </div>
                    </div>

                    <!-- Location Section -->
                    <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-6">
                        <h3 class="text-2xl font-bold text-text mb-6 bg-gradient-to-r from-tertiary to-purple bg-clip-text text-transparent flex items-center">
                            <span class="mr-3">📍</span> Ubicación
                        </h3>
                        
                        <div class="bg-gradient-to-br from-warning/20 to-warning/5 border-2 border-warning/30 rounded-xl p-4 mb-6">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">⚠️</span>
                                <div>
                                    <h4 class="font-bold text-warning">Restricción de Ubicación</h4>
                                    <p class="text-textMuted text-sm">La ubicación no puede ser modificada debido a contratos existentes con el venue.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Nombre del Lugar
                                </label>
                                <input type="text" id="locationName" name="location_name" 
                                       value="Explanada Central" disabled
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none opacity-50 cursor-not-allowed backdrop-blur-sm">
                                <div class="text-xs text-warning mt-1">❌ Campo no modificable</div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Capacidad
                                </label>
                                <input type="number" id="capacity" name="capacity" 
                                       value="5000" disabled
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none opacity-50 cursor-not-allowed backdrop-blur-sm">
                                <div class="text-xs text-warning mt-1">❌ Campo no modificable</div>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Dirección Completa
                                </label>
                                <textarea id="address" name="address" rows="2" disabled
                                          class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none opacity-50 cursor-not-allowed backdrop-blur-sm resize-none">Av. Principal 123, Col. Centro, Ciudad de México, CDMX, México</textarea>
                                <div class="text-xs text-warning mt-1">❌ Campo no modificable por restricciones del venue</div>
                            </div>
                        </div>
                    </div>

                    <!-- Change Reason Section (REQUIRED) -->
                    <div class="bg-gradient-to-br from-warning/20 to-warning/5 border-2 border-warning/30 rounded-2xl p-6 backdrop-blur-lg">
                        <h3 class="text-2xl font-bold text-warning mb-6 flex items-center">
                            <span class="mr-3">📝</span> Motivo del Cambio (Obligatorio)
                        </h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Tipo de Cambio *
                                </label>
                                <select id="changeType" name="change_type" required
                                        class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-warning/50 focus:border-warning backdrop-blur-sm">
                                    <option value="">Selecciona el tipo de cambio</option>
                                    <option value="schedule">📅 Cambio de fecha/horario</option>
                                    <option value="location">📍 Cambio de ubicación</option>
                                    <option value="content">📝 Cambio de contenido/descripción</option>
                                    <option value="cancellation">❌ Cancelación</option>
                                    <option value="postponement">⏸️ Posposición</option>
                                    <option value="technical">🔧 Ajustes técnicos</option>
                                    <option value="other">📦 Otro motivo</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Explicación Detallada *
                                </label>
                                <textarea id="changeReason" name="change_reason" required rows="4"
                                          placeholder="Explica detalladamente el motivo de los cambios. Esta información será enviada a todos los asistentes y productores del evento."
                                          class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-warning/50 focus:border-warning backdrop-blur-sm resize-none"></textarea>
                                <div class="text-xs text-warning mt-1">⚠️ Este campo es obligatorio y será visible para todos los involucrados</div>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Settings -->
                    <div class="bg-gradient-to-br from-success/20 to-success/5 border-2 border-success/30 rounded-2xl p-6 backdrop-blur-lg">
                        <h3 class="text-2xl font-bold text-success mb-6 flex items-center">
                            <span class="mr-3">🔔</span> Configuración de Notificaciones
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="bg-success/10 rounded-lg p-4">
                                    <h4 class="font-bold text-success mb-2">👥 Asistentes Confirmados</h4>
                                    <label class="flex items-center">
                                        <input type="checkbox" id="notifyAttendees" name="notify_attendees" checked
                                               class="mr-3 h-4 w-4 text-success focus:ring-success border-gray-300 rounded">
                                        <span class="text-textMuted">Notificar a <span class="font-bold">245</span> asistentes confirmados</span>
                                    </label>
                                    <div class="text-xs text-textMuted mt-2">
                                        Se enviará por email y notificación push
                                    </div>
                                </div>
                                
                                <div class="bg-info/10 rounded-lg p-4">
                                    <h4 class="font-bold text-info mb-2">🎬 Productores</h4>
                                    <label class="flex items-center">
                                        <input type="checkbox" id="notifyProducers" name="notify_producers" checked
                                               class="mr-3 h-4 w-4 text-info focus:ring-info border-gray-300 rounded">
                                        <span class="text-textMuted">Notificar a <span class="font-bold">8</span> productores</span>
                                    </label>
                                    <div class="text-xs text-textMuted mt-2">
                                        Se enviará por email con detalles administrativos
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-cardLight/30 rounded-lg p-4">
                                <h4 class="font-bold text-textMuted mb-2">📋 Resumen de Notificaciones</h4>
                                <ul class="text-sm text-textMuted space-y-1">
                                    <li>• Las notificaciones incluirán el motivo del cambio</li>
                                    <li>• Los asistentes recibirán información relevante para su participación</li>
                                    <li>• Los productores recibirán detalles técnicos y administrativos</li>
                                    <li>• Se mantendrá un registro de todas las notificaciones enviadas</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Section -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                        <button type="button" onclick="window.history.back()" 
                                class="px-10 py-4 border-2 border-textMuted text-textMuted rounded-xl font-bold hover:bg-textMuted hover:text-background transition-all duration-300 text-lg">
                            ← Cancelar
                        </button>
                        <button type="button" onclick="previewChanges()" 
                                class="px-10 py-4 border-2 border-info text-info rounded-xl font-bold hover:bg-info hover:text-white transition-all duration-300 shadow-lg hover:shadow-info/30 text-lg">
                                👁️ Vista Previa
                        </button>
                        <button type="submit" 
                                class="px-10 py-4 bg-gradient-to-r from-accent to-secondary text-white rounded-xl font-bold hover:from-secondary hover:to-accent transition-all duration-300 shadow-2xl hover:shadow-accent/40 text-lg transform hover:scale-105">
                            💾 Guardar Cambios y Notificar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset('src/sources/event_modify.js') }}"></script>
    <script>
        // Global functions
        function previewChanges() {
            const form = document.getElementById('modificationForm');
            const formData = new FormData(form);
            
            let preview = '📋 VISTA PREVIA DE CAMBIOS:\n\n';
            
            // Basic info
            preview += `📝 Nombre: ${formData.get('event_name')}\n`;
            preview += `📂 Categoría: ${formData.get('event_category')}\n`;
            preview += `📊 Estado: ${formData.get('event_status')}\n`;
            preview += `📝 Descripción: ${formData.get('event_description')?.substring(0, 100)}...\n\n`;
            
            // Date and time
            preview += `📅 Fecha inicio: ${formData.get('date_start')}\n`;
            preview += `📅 Fecha fin: ${formData.get('date_end')}\n`;
            preview += `⏰ Hora inicio: ${formData.get('time_start')}\n`;
            preview += `⏰ Hora fin: ${formData.get('time_end')}\n\n`;
            
            // Change reason
            preview += `📝 Tipo de cambio: ${formData.get('change_type')}\n`;
            preview += `📝 Motivo: ${formData.get('change_reason')}\n\n`;
            
            // Notifications
            preview += `🔔 Notificaciones:\n`;
            preview += `👥 Asistentes: ${formData.get('notify_attendees') ? 'Sí' : 'No'}\n`;
            preview += `🎬 Productores: ${formData.get('notify_producers') ? 'Sí' : 'No'}\n`;
            
            alert(preview);
        }

        class EventModification {
            constructor() {
                this.originalData = {};
                this.hasChanges = false;
                
                this.init();
            }
            
            init() {
                this.setupEventListeners();
                this.setupFormValidation();
                this.trackChanges();
            }
            
            setupEventListeners() {
                const form = document.getElementById('modificationForm');
                if (form) {
                    form.addEventListener('submit', (e) => this.handleSubmit(e));
                }
                
                // Track all form inputs for changes
                const inputs = form.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    // Store original values
                    this.originalData[input.name] = input.value;
                    
                    // Add change listeners
                    input.addEventListener('input', () => this.trackChanges());
                    input.addEventListener('change', () => this.trackChanges());
                });
            }
            
            setupFormValidation() {
                // Set minimum dates for date inputs
                const today = new Date().toISOString().split('T')[0];
                const dateStart = document.getElementById('dateStart');
                const dateEnd = document.getElementById('dateEnd');
                
                if (dateStart) dateStart.min = today;
                if (dateEnd) dateEnd.min = today;
                
                // Validate date range
                if (dateStart && dateEnd) {
                    dateStart.addEventListener('change', () => this.validateDateRange());
                    dateEnd.addEventListener('change', () => this.validateDateRange());
                }
                
                // Validate time range
                const timeStart = document.getElementById('timeStart');
                const timeEnd = document.getElementById('timeEnd');
                
                if (timeStart && timeEnd) {
                    timeStart.addEventListener('change', () => this.validateTimeRange());
                    timeEnd.addEventListener('change', () => this.validateTimeRange());
                }
            }
            
            validateDateRange() {
                const dateStart = document.getElementById('dateStart');
                const dateEnd = document.getElementById('dateEnd');
                
                if (dateStart.value && dateEnd.value) {
                    if (new Date(dateStart.value) > new Date(dateEnd.value)) {
                        dateEnd.setCustomValidity('La fecha de fin debe ser posterior a la fecha de inicio');
                    } else {
                        dateEnd.setCustomValidity('');
                    }
                }
            }
            
            validateTimeRange() {
                const dateStart = document.getElementById('dateStart');
                const dateEnd = document.getElementById('dateEnd');
                const timeStart = document.getElementById('timeStart');
                const timeEnd = document.getElementById('timeEnd');
                
                // Only validate time if it's the same day
                if (dateStart.value === dateEnd.value && timeStart.value && timeEnd.value) {
                    if (timeStart.value >= timeEnd.value) {
                        timeEnd.setCustomValidity('La hora de fin debe ser posterior a la hora de inicio');
                    } else {
                        timeEnd.setCustomValidity('');
                    }
                } else {
                    timeEnd.setCustomValidity('');
                }
            }
            
            trackChanges() {
                const form = document.getElementById('modificationForm');
                const inputs = form.querySelectorAll('input, select, textarea');
                let hasChanges = false;
                
                inputs.forEach(input => {
                    if (input.name && this.originalData[input.name] !== undefined) {
                        if (input.value !== this.originalData[input.name]) {
                            hasChanges = true;
                        }
                    }
                });
                
                this.hasChanges = hasChanges;
                this.updateUI();
            }
            
            updateUI() {
                // Could add visual indicators for changed fields
                // Or update submit button state
                const submitBtn = document.querySelector('button[type="submit"]');
                if (submitBtn) {
                    if (this.hasChanges) {
                        submitBtn.classList.remove('opacity-50');
                        submitBtn.disabled = false;
                    }
                }
            }
            
            async handleSubmit(e) {
                e.preventDefault();
                
                // Validate required change reason
                const changeType = document.getElementById('changeType').value;
                const changeReason = document.getElementById('changeReason').value;
                
                if (!changeType || !changeReason.trim()) {
                    alert('Debes especificar el motivo del cambio antes de guardar.');
                    return;
                }
                
                if (!this.hasChanges) {
                    alert('No se han detectado cambios en el evento.');
                    return;
                }
                
                if (!confirm('¿Estás seguro de que quieres guardar estos cambios? Se notificará a todos los involucrados.')) {
                    return;
                }
                
                try {
                    await this.saveChanges();
                } catch (error) {
                    console.error('Error saving changes:', error);
                    alert('Error al guardar los cambios. Por favor, intenta de nuevo.');
                }
            }
            
            async saveChanges() {
                const formData = new FormData(document.getElementById('modificationForm'));
                
                // Show loading state
                const submitBtn = document.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '⏳ Guardando...';
                submitBtn.disabled = true;
                
                try {
                    // Simulate API call
                    await new Promise(resolve => setTimeout(resolve, 2000));
                    
                    // Show success message
                    alert('✅ Cambios guardados exitosamente. Se han enviado las notificaciones correspondientes.');
                    
                    // Redirect to events list
                    window.location.href = '/events/modify';
                    
                } catch (error) {
                    throw error;
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            }
        }

        // Initialize when DOM is loaded
        let eventModification;
        document.addEventListener('DOMContentLoaded', function() {
            eventModification = new EventModification();
        });
    </script>
</body>
</html>