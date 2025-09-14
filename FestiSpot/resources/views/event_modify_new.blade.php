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
                    <div style="width: 28px; height: 28px; color: #ff4081;">
                        <svg viewBox="0 0 48 48" fill="currentColor">
                            <path d="M39.475 21.6262C40.358 21.4363 40.6863 21.5589 40.7581 21.5934C40.7876 21.655 40.8547 21.857 40.8082 22.3336C40.7408 23.0255 40.4502 24.0046 39.8572 25.2301C38.6799 27.6631 36.5085 30.6631 33.5858 33.5858C30.6631 36.5085 27.6632 38.6799 25.2301 39.8572C24.0046 40.4502 23.0255 40.7407 22.3336 40.8082C21.8571 40.8547 21.6551 40.7875 21.5934 40.7581C21.5589 40.6863 21.4363 40.358 21.6262 39.475C21.8562 38.4054 22.4689 36.9657 23.5038 35.2817C24.7575 33.2417 26.5497 30.9744 28.7621 28.762C30.9744 26.5497 33.2417 24.7574 35.2817 23.5037C36.9657 22.4689 38.4054 21.8562 39.475 21.6262ZM4.41189 29.2403L18.7597 43.5881C19.8813 44.7097 21.4027 44.9179 22.7217 44.7893C24.0585 44.659 25.5148 44.1631 26.9723 43.4579C29.9052 42.0387 33.2618 39.5667 36.4142 36.4142C39.5667 33.2618 42.0387 29.9052 43.4579 26.9723C44.1631 25.5148 44.659 24.0585 44.7893 22.7217C44.9179 21.4027 44.7097 19.8813 43.5881 18.7597L29.2403 4.41187C27.8527 3.02428 25.8765 3.02573 24.2861 3.36776C22.6081 3.72863 20.7334 4.58419 18.8396 5.74801C16.4978 7.18716 13.9881 9.18353 11.5858 11.5858C9.18354 13.988 7.18717 16.4978 5.74802 18.8396C4.58421 20.7334 3.72865 22.6081 3.36778 24.2861C3.02574 25.8765 3.02429 27.8527 4.41189 29.2403Z"></path>
                        </svg>
                    </div>
                    <h1 style="font-size: 22px; font-weight: 700; background: linear-gradient(135deg, #ff4081, #00e5ff, #7c4dff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.5px;">FestiSpot</h1>
                </div>
                
                <nav style="display: flex; gap: 8px;">
                    <a href="/" class="nav-link">Inicio</a>
                    <a href="/mis-eventos" class="nav-link">Mis eventos</a>
                    <a href="/configuration" class="nav-link">Configuración</a>
                </nav>
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
                        📝 Modifica los detalles de tu evento. Los cambios serán notificados a todos los asistentes.
                    </p>
                </div>

                <!-- Loading State -->
                <div id="loading-state" class="text-center py-12">
                    <div class="text-6xl mb-4">⏳</div>
                    <div class="text-xl font-bold text-accent">Cargando datos del evento...</div>
                </div>

                <!-- Event Info Display -->
                <div id="event-info" class="hidden bg-gradient-to-br from-info/20 to-info/5 border-2 border-info/30 rounded-2xl p-6 mb-8 backdrop-blur-lg">
                    <h2 class="text-2xl font-bold text-info mb-4 flex items-center">
                        <span class="mr-3">ℹ️</span> Información del Evento
                    </h2>
                    <div id="event-data" class="grid md:grid-cols-3 gap-4 text-textMuted">
                        <!-- Los datos se llenarán dinámicamente -->
                    </div>
                </div>

                <!-- Modification Form -->
                <form id="modificationForm" class="hidden space-y-8">
                    <!-- Información Básica -->
                    <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-6">
                        <h3 class="text-2xl font-bold text-text mb-6 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent flex items-center">
                            <span class="mr-3">📝</span> Información Básica
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Nombre del Evento *
                                </label>
                                <input type="text" id="eventName" name="event_name" required
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Categoría *
                                </label>
                                <select id="eventCategory" name="event_category" required
                                        class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                    <option value="">Selecciona una categoría</option>
                                    <option value="Festival">🎉 Festival</option>
                                    <option value="Conferencia">🎤 Conferencia</option>
                                    <option value="Teatro">🎭 Teatro</option>
                                    <option value="Música">🎵 Música</option>
                                    <option value="Tecnología">💻 Tecnología</option>
                                    <option value="Arte">🎨 Arte</option>
                                    <option value="Deportes">⚽ Deportes</option>
                                    <option value="Educación">📚 Educación</option>
                                    <option value="Otro">📦 Otro</option>
                                </select>
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Estado del Evento
                                </label>
                                <select id="eventStatus" name="event_status"
                                        class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                    <option value="published">📢 Publicado</option>
                                    <option value="draft">📝 Borrador</option>
                                    <option value="cancelled">❌ Cancelado</option>
                                    <option value="postponed">⏸️ Pospuesto</option>
                                </select>
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Descripción del Evento *
                                </label>
                                <textarea id="eventDescription" name="event_description" required rows="4"
                                          placeholder="Describe tu evento de manera detallada..."
                                          class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm resize-none"></textarea>
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                        </div>
                    </div>

                    <!-- Fecha y Horario -->
                    <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-6">
                        <h3 class="text-2xl font-bold text-text mb-6 bg-gradient-to-r from-info to-tertiary bg-clip-text text-transparent flex items-center">
                            <span class="mr-3">📅</span> Fecha y Horario
                        </h3>
                        
                        <div id="fecha-modificable" class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Fecha de Inicio *
                                </label>
                                <input type="date" id="dateStart" name="date_start" 
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div id="fecha-status" class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Fecha de Fin *
                                </label>
                                <input type="date" id="dateEnd" name="date_end" 
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Hora de Inicio *
                                </label>
                                <input type="time" id="timeStart" name="time_start" 
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Hora de Fin *
                                </label>
                                <input type="time" id="timeEnd" name="time_end" 
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-6">
                        <h3 class="text-2xl font-bold text-text mb-6 bg-gradient-to-r from-tertiary to-purple bg-clip-text text-transparent flex items-center">
                            <span class="mr-3">📍</span> Ubicación
                        </h3>
                        
                        <div id="ubicacion-restriccion" class="hidden bg-gradient-to-br from-warning/20 to-warning/5 border-2 border-warning/30 rounded-xl p-4 mb-6">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">⚠️</span>
                                <div>
                                    <h4 class="font-bold text-warning">Restricción de Ubicación</h4>
                                    <p class="text-textMuted text-sm">La ubicación no puede ser modificada debido a contratos existentes.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Nombre del Lugar
                                </label>
                                <input type="text" id="locationName" name="location_name" 
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div id="ubicacion-status" class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Capacidad
                                </label>
                                <input type="text" id="capacity" name="capacity" 
                                       class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Dirección Completa
                                </label>
                                <textarea id="address" name="address" rows="2"
                                          class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm resize-none"></textarea>
                                <div class="text-xs text-success mt-1">✅ Campo modificable</div>
                            </div>
                        </div>
                    </div>

                    <!-- Motivo del Cambio -->
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
                                <div id="changeTypeError" class="text-accent text-sm font-bold mt-3 hidden bg-accent/10 p-3 rounded-lg border border-accent/30">
                                    ⚠️ Selecciona el tipo de cambio
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-textMuted text-sm font-medium mb-2">
                                    Explicación Detallada *
                                </label>
                                <textarea id="changeReason" name="change_reason" required rows="4"
                                          placeholder="Explica detalladamente el motivo de los cambios. Esta información será enviada a todos los asistentes."
                                          class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-warning/50 focus:border-warning backdrop-blur-sm resize-none"></textarea>
                                <div class="flex justify-between items-center mt-1">
                                    <div class="text-xs text-warning">⚠️ Este campo es obligatorio y será visible para todos los involucrados</div>
                                    <div class="text-xs text-textMuted">
                                        <span id="reasonCount">0</span> / 500 caracteres
                                    </div>
                                </div>
                                <div id="changeReasonError" class="text-accent text-sm font-bold mt-3 hidden bg-accent/10 p-3 rounded-lg border border-accent/30">
                                    ⚠️ Proporciona una explicación detallada
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                        <button type="button" onclick="window.location.href='/mis-eventos'" 
                                class="px-10 py-4 border-2 border-textMuted text-textMuted rounded-xl font-bold hover:bg-textMuted hover:text-background transition-all duration-300 text-lg">
                            ← Cancelar
                        </button>
                        <button type="submit" 
                                class="px-10 py-4 bg-gradient-to-r from-secondary to-info text-white rounded-xl font-bold hover:from-info hover:to-secondary transition-all duration-300 shadow-2xl hover:shadow-secondary/40 text-lg transform hover:scale-105">
                            💾 Guardar Cambios
                        </button>
                    </div>
                </form>

                <!-- Error State -->
                <div id="error-state" class="hidden text-center py-12">
                    <div class="text-6xl mb-4">❌</div>
                    <div class="text-xl font-bold text-accent mb-4">Error al cargar el evento</div>
                    <button onclick="window.location.href='/mis-eventos'" 
                            class="px-8 py-3 bg-accent text-white rounded-xl font-bold hover:bg-secondary transition-all">
                        Volver a mis eventos
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        let eventoActual = null;

        document.addEventListener('DOMContentLoaded', function() {
            console.log('🔧 Inicializando página de modificación...');
            cargarDatosEvento();
        });

        function cargarDatosEvento() {
            // Intentar obtener datos del localStorage
            const eventoData = localStorage.getItem('eventoActual');
            
            if (eventoData) {
                try {
                    eventoActual = JSON.parse(eventoData);
                    console.log('✅ Datos del evento cargados:', eventoActual);
                    mostrarDatosEvento();
                } catch (error) {
                    console.error('❌ Error al parsear datos del evento:', error);
                    mostrarError();
                }
            } else {
                console.error('❌ No se encontraron datos del evento');
                mostrarError();
            }
        }

        function mostrarDatosEvento() {
            const loadingState = document.getElementById('loading-state');
            const eventInfo = document.getElementById('event-info');
            const modificationForm = document.getElementById('modificationForm');

            // Ocultar loading
            loadingState.classList.add('hidden');
            
            // Mostrar información del evento
            eventInfo.classList.remove('hidden');
            modificationForm.classList.remove('hidden');

            // Llenar información básica
            const eventData = document.getElementById('event-data');
            eventData.innerHTML = `
                <div class="flex items-center gap-2">
                    <span class="text-accent">📅</span>
                    <div>
                        <div class="text-xs text-textMuted">Fecha del evento</div>
                        <span class="font-semibold">${formatearFecha(eventoActual.fecha_inicio)}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-secondary">⏰</span>
                    <div>
                        <div class="text-xs text-textMuted">Horario</div>
                        <span class="font-semibold">${eventoActual.hora_inicio} - ${eventoActual.hora_fin}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-tertiary">📍</span>
                    <div>
                        <div class="text-xs text-textMuted">Ubicación</div>
                        <span class="font-semibold">${eventoActual.lugar}, ${eventoActual.ciudad}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-success">👥</span>
                    <div>
                        <div class="text-xs text-textMuted">Asistentes</div>
                        <span class="font-semibold">${eventoActual.asistentes} confirmados</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-warning">⚠️</span>
                    <div>
                        <div class="text-xs text-textMuted">Días restantes</div>
                        <span class="font-semibold text-warning">${eventoActual.dias_restantes} días</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-purple">📊</span>
                    <div>
                        <div class="text-xs text-textMuted">Estado</div>
                        <span class="font-semibold text-success">${eventoActual.estado_evento === 'published' ? 'Publicado' : 'Borrador'}</span>
                    </div>
                </div>
            `;

            // Llenar formulario
            llenarFormulario();
            configurarRestricciones();
        }

        function llenarFormulario() {
            // Información básica
            document.getElementById('eventName').value = eventoActual.nombre;
            document.getElementById('eventCategory').value = eventoActual.categoria;
            document.getElementById('eventStatus').value = eventoActual.estado_evento;
            document.getElementById('eventDescription').value = eventoActual.descripcion;

            // Fechas y horarios
            document.getElementById('dateStart').value = eventoActual.fecha_inicio;
            document.getElementById('dateEnd').value = eventoActual.fecha_fin;
            document.getElementById('timeStart').value = eventoActual.hora_inicio;
            document.getElementById('timeEnd').value = eventoActual.hora_fin;

            // Ubicación
            document.getElementById('locationName').value = eventoActual.lugar;
            document.getElementById('capacity').value = eventoActual.capacidad;
            document.getElementById('address').value = eventoActual.direccion;
        }

        function configurarRestricciones() {
            const fechaModificable = document.getElementById('fecha-modificable');
            const fechaStatus = document.getElementById('fecha-status');
            const ubicacionRestriccion = document.getElementById('ubicacion-restriccion');
            const ubicacionStatus = document.getElementById('ubicacion-status');
            const locationName = document.getElementById('locationName');
            const capacity = document.getElementById('capacity');
            const address = document.getElementById('address');

            // Configurar restricciones de fecha
            if (!eventoActual.puede_modificar_fecha) {
                const inputs = fechaModificable.querySelectorAll('input');
                inputs.forEach(input => {
                    input.disabled = true;
                    input.classList.add('opacity-50', 'cursor-not-allowed');
                });
                fechaStatus.innerHTML = '❌ Campo no modificable - Muy cercano al evento';
                fechaStatus.className = 'text-xs text-warning mt-1';
            }

            // Configurar restricciones de ubicación
            if (!eventoActual.puede_modificar_ubicacion) {
                ubicacionRestriccion.classList.remove('hidden');
                [locationName, capacity, address].forEach(input => {
                    input.disabled = true;
                    input.classList.add('opacity-50', 'cursor-not-allowed');
                });
                ubicacionStatus.innerHTML = '❌ Campo no modificable por restricciones del venue';
                ubicacionStatus.className = 'text-xs text-warning mt-1';
            }
            
            // Agregar contador de caracteres para el motivo
            const changeReason = document.getElementById('changeReason');
            const reasonCount = document.getElementById('reasonCount');
            
            if (changeReason && reasonCount) {
                changeReason.addEventListener('input', function() {
                    const length = Math.min(this.value.length, 500);
                    reasonCount.textContent = length;
                    if (this.value.length > 500) {
                        this.value = this.value.substring(0, 500);
                    }
                    
                    // Cambiar color según la longitud
                    if (length < 20) {
                        reasonCount.className = 'text-accent';
                    } else if (length < 100) {
                        reasonCount.className = 'text-warning';
                    } else {
                        reasonCount.className = 'text-success';
                    }
                });
            }
        }

        function formatearFecha(fechaStr) {
            const fecha = new Date(fechaStr);
            return fecha.toLocaleDateString('es-ES', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        function mostrarError() {
            const loadingState = document.getElementById('loading-state');
            const errorState = document.getElementById('error-state');
            
            loadingState.classList.add('hidden');
            errorState.classList.remove('hidden');
        }

        // Manejar envío del formulario con mejor validación
        document.getElementById('modificationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const changeType = document.getElementById('changeType').value;
            const changeReason = document.getElementById('changeReason').value;
            let isValid = true;
            
            // Validar tipo de cambio
            if (!changeType) {
                document.getElementById('changeTypeError').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('changeTypeError').classList.add('hidden');
            }
            
            // Validar motivo (mínimo 20 caracteres)
            if (!changeReason.trim() || changeReason.trim().length < 20) {
                document.getElementById('changeReasonError').classList.remove('hidden');
                document.getElementById('changeReasonError').textContent = '⚠️ El motivo debe tener al menos 20 caracteres';
                isValid = false;
            } else {
                document.getElementById('changeReasonError').classList.add('hidden');
            }
            
            if (!isValid) {
                return;
            }
            
            if (confirm('¿Estás seguro de que quieres guardar estos cambios? Se notificará a todos los asistentes.')) {
                guardarCambios();
            }
        });

        function guardarCambios() {
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '⏳ Guardando...';
            submitBtn.disabled = true;
            
            // Simular guardado
            setTimeout(() => {
                alert('✅ Cambios guardados exitosamente. Se han enviado las notificaciones a todos los asistentes.');
                
                // Limpiar localStorage y redirigir
                localStorage.removeItem('eventoActual');
                window.location.href = '/mis-eventos';
            }, 2000);
        }
    </script>
</body>
</html>
</html>
