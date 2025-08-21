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
                    <a class="text-textMuted text-sm font-medium leading-normal hover:text-accent hover:drop-shadow-lg transition-all duration-300" href="/">Inicio</a>
                    <a class="text-accent text-sm font-medium leading-normal hover:text-secondary hover:drop-shadow-lg transition-all duration-300" href="/mis-eventos">Mis Eventos</a>
                </div>
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" 
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBLCsTZpxKXCAKoDY9xg8CTUN_CUYfM6jTFLmg3YTg5xI2UJQcbEx0zzDAk-Pn2cXIa7F3B0J0XPi3mLxWRRDcEJNFN5Hp474_Dlp1nneZeBOaXn6T33SkaRLdYUZ0p4hyg4N_CSATsBm-0sNp2ganJdu6782Gm_e4Y5rBwPlpL6gS8NI6GVmpZugdXscLW4ICwuVrsIvLA099FGDQ97rn7VvJtICeeTPnM7t0-je_xEumfPYUeJNKzn_TtmVN7cp4eFAu5_FlVCxE");'>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="flex-1 px-8 md:px-20 lg:px-40 py-6">
            <div class="max-w-6xl mx-auto">
                
                <!-- Breadcrumb -->
                <div class="mb-6">
                    <nav class="flex text-textMuted text-sm">
                        <a href="/mis-eventos" class="hover:text-accent transition-colors">← Volver a mis eventos</a>
                    </nav>
                </div>

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
                                    <option value="technical">🔧 Ajustes técnicos</option>
                                    <option value="capacity">👥 Cambio de capacidad</option>
                                    <option value="requirements">📋 Actualización de requisitos</option>
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
                        <button type="button" onclick="previewChanges()" 
                                class="px-10 py-4 border-2 border-info text-info rounded-xl font-bold hover:bg-info hover:text-white transition-all duration-300 shadow-lg hover:shadow-info/30 text-lg">
                                👁️ Vista Previa
                        </button>
                        <button type="submit" 
                                class="px-10 py-4 bg-gradient-to-r from-secondary to-info text-white rounded-xl font-bold hover:from-info hover:to-secondary transition-all duration-300 shadow-2xl hover:shadow-secondary/40 text-lg transform hover:scale-105">
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
                if (dateStart && dateEnd && dateStart.value === dateEnd.value && timeStart.value && timeEnd.value) {
                    if (timeStart.value >= timeEnd.value) {
                        timeEnd.setCustomValidity('La hora de fin debe ser posterior a la hora de inicio');
                    } else {
                        timeEnd.setCustomValidity('');
                    }
                } else if (timeEnd) {
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
                    window.location.href = '/mis-eventos';
                    
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
            console.log('✅ Event modification form initialized');
        });
    </script>
</body>
</html>