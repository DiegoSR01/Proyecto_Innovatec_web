<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Fechas y Horarios</title>
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
      
      .date-selected {
        background: linear-gradient(135deg, #ff4081 0%, #00e5ff 100%) !important;
        color: white !important;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(255, 64, 129, 0.4);
        transform: scale(1.05);
      }
      .date-in-range {
        background: linear-gradient(135deg, rgba(255, 64, 129, 0.3) 0%, rgba(0, 229, 255, 0.3) 100%) !important;
        border: 1px solid rgba(255, 64, 129, 0.5);
      }
      .date-disabled {
        color: #6b7280 !important;
        cursor: not-allowed !important;
        opacity: 0.3;
      }
      .calendar-hidden {
        display: none !important;
      }
      
      /* Estilos para media y preview en fechas */
      .time-preview {
        background: linear-gradient(135deg, rgba(22, 33, 62, 0.8) 0%, rgba(30, 39, 73, 0.6) 100%);
        border: 1px solid rgba(0, 229, 255, 0.3);
        backdrop-filter: blur(10px);
      }
      .schedule-card {
        background: linear-gradient(135deg, rgba(124, 77, 255, 0.1) 0%, rgba(255, 64, 129, 0.05) 100%);
        border: 1px solid rgba(124, 77, 255, 0.3);
      }
    </style>
</head>
<body class="bg-background text-text min-h-screen">
    @php
        $eventDate = session('event_date', []);
    @endphp

    <!-- Efectos de fondo -->
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
                    <a href="/mis-eventos" class="nav-link">Mis eventos</a>
                    <a href="/solicitudes-productores" class="nav-link">Productores</a>
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
                    <h1 class="text-4xl font-bold leading-tight mb-4 bg-gradient-to-r from-accent via-secondary to-warning bg-clip-text text-transparent">
                        📅 Fechas y Horarios del Evento
                    </h1>
                    <p class="text-textMuted text-lg leading-relaxed max-w-3xl mx-auto">
                        ⏰ Configura cuándo sucederá la magia. Selecciona las fechas perfectas y establece horarios que funcionen para todos.
                    </p>
                </div>

                <!-- Mostrar mensaje si se está editando -->
                @if(!empty($eventDate))
                    <div class="mb-8 p-6 bg-gradient-to-r from-info/20 to-tertiary/20 border-2 border-info/40 text-info rounded-2xl backdrop-blur-lg shadow-2xl shadow-info/20">
                        <div class="font-bold text-xl">📅 Editando fechas existentes</div>
                        <div class="text-base mt-2 text-textMuted">Los horarios y fechas ya configurados se mantendrán</div>
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

                <!-- Form -->
                <form method="POST" action="{{ route('event.storeDate') }}" id="date-form">
                    @csrf

                    <!-- Horarios Section -->
                    <div class="mb-10">
                        <h3 class="text-3xl font-bold mb-8 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent text-center">
                            ⏰ Horarios del Evento
                        </h3>
                        
                        <div class="bg-gradient-to-br from-card/60 to-cardLight/40 backdrop-blur-xl rounded-3xl p-10 space-y-10 border border-cardLight/30 shadow-2xl">
                            <!-- Time Selection -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <div class="bg-gradient-to-br from-cardLight/60 to-card/40 backdrop-blur-lg rounded-2xl p-6 border border-cardLight/20">
                                    <label class="block text-text font-bold mb-4 text-xl flex items-center">
                                        <span class="text-2xl mr-3">🌅</span> Hora de inicio *
                                    </label>
                                    <select name="hora_inicio" id="hora_inicio" required
                                            class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text focus:border-accent focus:ring-4 focus:ring-accent/30 focus:outline-none transition-all duration-200 backdrop-blur-sm text-lg font-medium">
                                        <option value="">Selecciona hora de inicio</option>
                                    </select>
                                    <div id="error-hora-inicio" class="text-accent text-sm font-bold mt-3 hidden bg-accent/10 p-3 rounded-lg border border-accent/30">
                                        ⚠️ Selecciona una hora de inicio
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-cardLight/60 to-card/40 backdrop-blur-lg rounded-2xl p-6 border border-cardLight/20">
                                    <label class="block text-text font-bold mb-4 text-xl flex items-center">
                                        <span class="text-2xl mr-3">🌆</span> Hora de fin *
                                    </label>
                                    <select name="hora_fin" id="hora_fin" required disabled
                                            class="w-full px-6 py-4 bg-cardLight/70 border-2 border-cardLight/50 rounded-xl text-text focus:border-secondary focus:ring-4 focus:ring-secondary/30 focus:outline-none transition-all duration-200 backdrop-blur-sm disabled:opacity-50 text-lg font-medium">
                                        <option value="">Primero selecciona hora de inicio</option>
                                    </select>
                                    <div id="error-hora-fin" class="text-accent text-sm font-bold mt-3 hidden bg-accent/10 p-3 rounded-lg border border-accent/30">
                                        ⚠️ Selecciona una hora de fin
                                    </div>
                                </div>
                            </div>

                            <!-- Options - Solo repetir horario (se detecta automáticamente si es un día) -->
                            <div class="flex justify-center">
                                <label class="flex items-center p-6 bg-gradient-to-br from-purple/20 to-tertiary/20 rounded-2xl border-2 border-purple/30 hover:bg-purple/30 transition-all duration-300 cursor-pointer backdrop-blur-lg shadow-lg hover:shadow-xl hover:shadow-purple/30">
                                    <input type="checkbox" name="repetir_horario" id="repetir_horario" value="1"
                                           class="rounded-lg border-purple bg-purple/20 text-purple focus:ring-0 mr-4 w-6 h-6"
                                           {{ old('repetir_horario', $eventDate['repetir_horario'] ?? false) ? 'checked' : '' }}>
                                    <span class="text-text font-bold text-lg">🔄 Repetir horario para todos los días</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Fechas Section -->
                    <div class="mb-10">
                        <h3 class="text-3xl font-bold mb-8 bg-gradient-to-r from-secondary to-tertiary bg-clip-text text-transparent text-center">
                            📅 Fechas del Evento
                        </h3>
                        
                        <!-- Date Display mejorado -->
                        <div class="mb-8">
                            <div class="p-8 bg-gradient-to-r from-card/60 to-cardLight/40 rounded-3xl border-2 border-cardLight/30 backdrop-blur-xl shadow-2xl">
                                <div class="text-accent font-bold text-2xl mb-3 text-center">🎯 Fechas seleccionadas</div>
                                <div id="fechas-display" class="text-text text-xl text-center font-medium">
                                    Sin fechas seleccionadas
                                </div>
                                <div id="evento-tipo-display" class="text-textMuted text-lg text-center mt-2 font-medium">
                                    <!-- Se actualizará automáticamente -->
                                </div>
                            </div>
                        </div>

                        <!-- Calendar Container -->
                        <div class="bg-gradient-to-br from-card/60 to-cardLight/40 backdrop-blur-xl rounded-3xl p-10 border border-cardLight/30 shadow-2xl">
                            <div class="grid grid-cols-1 xl:grid-cols-2 gap-10" id="calendar-container">
                                <!-- Calendar 1 -->
                                <div class="calendar-month bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl p-6 backdrop-blur-lg border border-cardLight/20">
                                    <div class="flex items-center justify-between mb-8">
                                        <button type="button" id="prev-month-1" class="p-4 hover:bg-accent hover:text-white rounded-2xl text-accent border-2 border-accent/40 transition-all duration-300 hover:scale-110 shadow-lg hover:shadow-2xl hover:shadow-accent/40">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                                            </svg>
                                        </button>
                                        <div class="text-text font-bold text-2xl bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent" id="month-header-1"></div>
                                        <div class="w-12"></div>
                                    </div>
                                    <div class="grid grid-cols-7 gap-3 mb-6">
                                        <div class="text-center text-accent text-base font-bold py-3">Dom</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Lun</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Mar</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Mié</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Jue</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Vie</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Sáb</div>
                                    </div>
                                    <div id="calendar-days-1" class="grid grid-cols-7 gap-3"></div>
                                </div>

                                <!-- Calendar 2 -->
                                <div class="calendar-month bg-gradient-to-br from-cardLight/40 to-card/60 rounded-2xl p-6 backdrop-blur-lg border border-cardLight/20" id="calendar-2">
                                    <div class="flex items-center justify-between mb-8">
                                        <div class="w-12"></div>
                                        <div class="text-text font-bold text-2xl bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent" id="month-header-2"></div>
                                        <button type="button" id="next-month-2" class="p-4 hover:bg-accent hover:text-white rounded-2xl text-accent border-2 border-accent/40 transition-all duration-300 hover:scale-110 shadow-lg hover:shadow-2xl hover:shadow-accent/40">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-7 gap-3 mb-6">
                                        <div class="text-center text-accent text-base font-bold py-3">Dom</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Lun</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Mar</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Mié</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Jue</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Vie</div>
                                        <div class="text-center text-accent text-base font-bold py-3">Sáb</div>
                                    </div>
                                    <div id="calendar-days-2" class="grid grid-cols-7 gap-3"></div>
                                </div>
                            </div>
                            
                            <!-- Calendar Actions -->
                            <div class="flex justify-center gap-6 mt-10">
                                <button type="button" id="clear-dates" 
                                        class="px-8 py-4 border-2 border-warning/60 text-warning rounded-2xl font-bold hover:bg-warning hover:text-background transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-2xl hover:shadow-warning/40">
                                    🧹 Limpiar Fechas
                                </button>
                            </div>
                        </div>
                        
                        <div id="error-fechas" class="text-accent text-base font-bold mt-4 hidden bg-accent/10 p-4 rounded-2xl border border-accent/30 text-center">
                            ⚠️ Selecciona al menos una fecha para el evento
                        </div>
                    </div>

                    <!-- Hidden Fields -->
                    <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', $eventDate['fecha_inicio'] ?? '') }}">
                    <input type="hidden" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', $eventDate['fecha_fin'] ?? '') }}">

                    <!-- Navigation -->
                    <div class="flex justify-between items-center pt-10 border-t-2 border-gradient-to-r from-accent/30 to-secondary/30">
                        <button type="button" id="btn-limpiar-fechas" 
                                class="px-10 py-5 border-3 border-accent/60 text-accent rounded-2xl font-bold hover:bg-accent hover:text-white transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl hover:shadow-accent/40 backdrop-blur-sm">
                            <span class="text-xl">🗑️</span> Limpiar Todo
                        </button>
                        
                        <button type="submit" 
                                class="px-14 py-5 bg-gradient-to-r from-secondary to-tertiary text-white rounded-2xl font-bold hover:from-tertiary hover:to-secondary transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl hover:shadow-secondary/50 text-xl">
                            Siguiente: Ubicación → <span class="text-2xl ml-2">📍</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Variables globales
        let startDate = null;
        let endDate = null;
        let currentMonth1 = new Date();
        let currentMonth2 = new Date();
        let isSelectingStart = true;
        let isSingleDay = false;
        
        // Configurar segundo calendario para el mes siguiente
        currentMonth2.setMonth(currentMonth2.getMonth() + 1);
        
        const monthNames = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        document.addEventListener('DOMContentLoaded', function() {
            console.log('🗓️ Inicializando vista de fechas...');
            
            // Restaurar datos existentes si los hay
            const existingData = @json($eventDate);
            console.log('Datos existentes:', existingData);
            
            // Inicializar componentes
            initializeTimeSelectors();
            initializeCalendars();
            setupEventListeners();
            
            // Restaurar datos si existen
            if (Object.keys(existingData).length > 0) {
                restoreExistingData(existingData);
            }
            
            console.log('✅ Vista de fechas inicializada correctamente');
        });

        function initializeTimeSelectors() {
            console.log('Inicializando selectores de hora...');
            
            const horaInicio = document.getElementById('hora_inicio');
            const horaFin = document.getElementById('hora_fin');
            
            // Generar opciones de hora (6:00 AM a 11:00 PM cada 30 minutos)
            const times = [];
            for (let hour = 6; hour <= 23; hour++) {
                for (let minute = 0; minute < 60; minute += 30) {
                    const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    times.push(timeString);
                }
            }
            
            // Llenar selector de hora de inicio
            times.forEach(time => {
                const option = document.createElement('option');
                option.value = time;
                option.textContent = time;
                horaInicio.appendChild(option);
            });
            
            console.log(`✅ ${times.length} opciones de hora agregadas`);
        }

        function setupEventListeners() {
            const horaInicio = document.getElementById('hora_inicio');
            const horaFin = document.getElementById('hora_fin');
            const form = document.getElementById('date-form');
            
            // Event listener para hora de inicio
            horaInicio.addEventListener('change', function() {
                console.log('Hora de inicio seleccionada:', this.value);
                if (this.value) {
                    updateEndTimeOptions(this.value);
                    document.getElementById('error-hora-inicio').classList.add('hidden');
                } else {
                    horaFin.disabled = true;
                    horaFin.innerHTML = '<option value="">Primero selecciona hora de inicio</option>';
                }
            });
            
            // Event listener para hora de fin
            horaFin.addEventListener('change', function() {
                if (this.value) {
                    document.getElementById('error-hora-fin').classList.add('hidden');
                }
            });
            
            // Navigation buttons
            document.getElementById('prev-month-1').addEventListener('click', function() {
                currentMonth1.setMonth(currentMonth1.getMonth() - 1);
                updateCalendar(1, currentMonth1);
            });
            
            document.getElementById('next-month-2').addEventListener('click', function() {
                currentMonth2.setMonth(currentMonth2.getMonth() + 1);
                updateCalendar(2, currentMonth2);
            });
            
            // Clear dates button
            document.getElementById('clear-dates').addEventListener('click', function() {
                if (confirm('¿Estás seguro de que quieres limpiar las fechas seleccionadas?')) {
                    clearDates();
                }
            });
            
            // Limpiar todo button
            document.getElementById('btn-limpiar-fechas').addEventListener('click', function() {
                if (confirm('¿Estás seguro de que quieres limpiar toda la información de fechas y horarios? Esta acción no se puede deshacer.')) {
                    clearAllData();
                }
            });
            
            // Form submission
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                }
            });
        }

        function updateEndTimeOptions(startTime) {
            const horaFin = document.getElementById('hora_fin');
            const times = [];
            
            // Generar todas las horas
            for (let hour = 6; hour <= 23; hour++) {
                for (let minute = 0; minute < 60; minute += 30) {
                    const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    times.push(timeString);
                }
            }
            
            // Encontrar el índice de la hora de inicio
            const startIndex = times.indexOf(startTime);
            
            // Limpiar opciones existentes
            horaFin.innerHTML = '<option value="">Selecciona hora de fin</option>';
            
            if (startIndex !== -1 && startIndex < times.length - 1) {
                // Agregar solo las horas posteriores a la hora de inicio
                for (let i = startIndex + 1; i < times.length; i++) {
                    const option = document.createElement('option');
                    option.value = times[i];
                    option.textContent = times[i];
                    horaFin.appendChild(option);
                }
                horaFin.disabled = false;
                console.log('✅ Hora de fin habilitada con', times.length - startIndex - 1, 'opciones');
            } else {
                horaFin.disabled = true;
                console.log('❌ No hay horas disponibles después de', startTime);
            }
        }

        function initializeCalendars() {
            console.log('Inicializando calendarios...');
            updateCalendar(1, currentMonth1);
            updateCalendar(2, currentMonth2);
        }

        function updateCalendar(calendarNum, date) {
            const monthHeader = document.getElementById(`month-header-${calendarNum}`);
            const calendarDays = document.getElementById(`calendar-days-${calendarNum}`);
            
            monthHeader.textContent = `${monthNames[date.getMonth()]} ${date.getFullYear()}`;
            calendarDays.innerHTML = '';
            
            const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            const startOfWeek = firstDay.getDay();
            
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            // Días vacíos al inicio
            for (let i = 0; i < startOfWeek; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'h-10';
                calendarDays.appendChild(emptyDay);
            }
            
            // Días del mes
            for (let day = 1; day <= lastDay.getDate(); day++) {
                const dayElement = document.createElement('div');
                const currentDate = new Date(date.getFullYear(), date.getMonth(), day);
                const dateString = currentDate.toISOString().split('T')[0];
                
                dayElement.className = 'h-10 flex items-center justify-center text-sm rounded cursor-pointer transition-all duration-200 font-medium';
                dayElement.textContent = day;
                
                // Estilos según el estado
                if (currentDate < today) {
                    dayElement.className += ' date-disabled';
                } else {
                    dayElement.className += ' text-text hover:bg-accent hover:text-white hover:scale-105';
                    
                    // Verificar si está seleccionado
                    if (startDate && dateString === startDate) {
                        dayElement.className += ' date-selected';
                    } else if (endDate && dateString === endDate && !isSingleDay) {
                        dayElement.className += ' date-selected';
                    } else if (startDate && endDate && !isSingleDay && dateString > startDate && dateString < endDate) {
                        dayElement.className += ' date-in-range';
                    }
                    
                    dayElement.addEventListener('click', () => selectDate(dateString));
                }
                
                calendarDays.appendChild(dayElement);
            }
        }

        function selectDate(dateString) {
            console.log('Fecha seleccionada:', dateString);
            
            if (isSelectingStart || !startDate) {
                // Primera selección
                startDate = dateString;
                endDate = null;
                isSelectingStart = false;
                isSingleDay = false;
            } else {
                // Segunda selección
                if (dateString === startDate) {
                    // Misma fecha = evento de un día
                    endDate = startDate;
                    isSingleDay = true;
                    isSelectingStart = true;
                } else if (dateString > startDate) {
                    // Rango válido
                    endDate = dateString;
                    isSingleDay = false;
                    isSelectingStart = true;
                } else {
                    // Fecha anterior, intercambiar
                    endDate = startDate;
                    startDate = dateString;
                    isSingleDay = false;
                    isSelectingStart = true;
                }
            }
            
            updateDateDisplay();
            updateCalendars();
            updateHiddenFields();
            updateRepeatOption();
        }

        function updateCalendars() {
            updateCalendar(1, currentMonth1);
            updateCalendar(2, currentMonth2);
        }

        function updateDateDisplay() {
            const display = document.getElementById('fechas-display');
            const tipoDisplay = document.getElementById('evento-tipo-display');
            
            if (!startDate) {
                display.textContent = 'Sin fechas seleccionadas';
                tipoDisplay.innerHTML = '<span class="text-warning">👆 Selecciona una fecha para comenzar</span>';
                return;
            }
            
            const formatDate = (dateStr) => {
                const date = new Date(dateStr + 'T00:00:00');
                return date.toLocaleDateString('es-ES', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            };
            
            if (!endDate) {
                // Solo fecha de inicio seleccionada
                display.innerHTML = `
                    <div class="text-lg font-semibold">${formatDate(startDate)}</div>
                `;
                tipoDisplay.innerHTML = '<span class="text-info">👆 Selecciona la fecha de fin o la misma fecha para evento de un día</span>';
            } else if (startDate === endDate || isSingleDay) {
                // Evento de un día
                display.innerHTML = `
                    <div class="text-lg font-semibold">${formatDate(startDate)}</div>
                `;
                tipoDisplay.innerHTML = '<span class="text-success">📅 Evento de un solo día</span>';
            } else {
                // Evento de múltiples días
                const daysDiff = Math.ceil((new Date(endDate) - new Date(startDate)) / (1000 * 60 * 60 * 24)) + 1;
                display.innerHTML = `
                    <div class="text-lg font-semibold">${formatDate(startDate)}</div>
                    <div class="text-base text-textMuted">hasta</div>
                    <div class="text-lg font-semibold">${formatDate(endDate)}</div>
                `;
                tipoDisplay.innerHTML = `<span class="text-secondary">🗓️ Evento de ${daysDiff} días</span>`;
            }
        }

        function updateRepeatOption() {
            const repetirHorario = document.getElementById('repetir_horario');
            
            if (isSingleDay) {
                // Para eventos de un día, deshabilitar y desmarcar repetir horario
                repetirHorario.checked = false;
                repetirHorario.disabled = true;
                repetirHorario.parentElement.style.opacity = '0.5';
                repetirHorario.parentElement.style.pointerEvents = 'none';
            } else {
                // Para eventos de múltiples días, habilitar la opción
                repetirHorario.disabled = false;
                repetirHorario.parentElement.style.opacity = '1';
                repetirHorario.parentElement.style.pointerEvents = 'auto';
            }
        }

        function updateHiddenFields() {
            document.getElementById('fecha_inicio').value = startDate || '';
            document.getElementById('fecha_fin').value = endDate || '';
        }

        function clearDates() {
            startDate = null;
            endDate = null;
            isSelectingStart = true;
            isSingleDay = false;
            
            updateDateDisplay();
            updateCalendars();
            updateHiddenFields();
            updateRepeatOption();
            
            console.log('✅ Fechas limpiadas');
        }

        function clearAllData() {
            // Limpiar fechas
            clearDates();
            
            // Limpiar horarios
            document.getElementById('hora_inicio').value = '';
            document.getElementById('hora_fin').value = '';
            document.getElementById('hora_fin').disabled = true;
            document.getElementById('hora_fin').innerHTML = '<option value="">Primero selecciona hora de inicio</option>';
            
            // Limpiar checkbox
            document.getElementById('repetir_horario').checked = false;
            
            // Limpiar errores
            document.getElementById('error-hora-inicio').classList.add('hidden');
            document.getElementById('error-hora-fin').classList.add('hidden');
            document.getElementById('error-fechas').classList.add('hidden');
            
            // Limpiar sesión del servidor si la ruta existe
            @if(Route::has('event.clearDate'))
                fetch('{{ route("event.clearDate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => {
                    console.log('✅ Datos de fechas limpiados del servidor');
                    alert('✅ Información de fechas y horarios limpiada correctamente');
                }).catch(error => {
                    console.error('Error al limpiar fechas:', error);
                    alert('✅ Información limpiada localmente');
                });
            @else
                console.log('Ruta clearDate no disponible, solo limpieza local');
                alert('✅ Información de fechas y horarios limpiada correctamente');
            @endif
        }

        function restoreExistingData(data) {
            console.log('🔄 Restaurando datos existentes...');
            
            // Restaurar horarios
            if (data.hora_inicio) {
                document.getElementById('hora_inicio').value = data.hora_inicio;
                updateEndTimeOptions(data.hora_inicio);
            }
            
            if (data.hora_fin) {
                document.getElementById('hora_fin').value = data.hora_fin;
            }
            
            if (data.repetir_horario) {
                document.getElementById('repetir_horario').checked = true;
            }
            
            // Restaurar fechas
            if (data.fecha_inicio) {
                startDate = data.fecha_inicio;
                if (data.fecha_fin) {
                    endDate = data.fecha_fin;
                    isSingleDay = (data.fecha_inicio === data.fecha_fin);
                }
                
                updateDateDisplay();
                updateCalendars();
                updateHiddenFields();
                updateRepeatOption();
                
                console.log('✅ Fechas restauradas:', { startDate, endDate, isSingleDay });
            }
        }

        function validateForm() {
            let isValid = true;
            
            // Validar hora de inicio
            const horaInicio = document.getElementById('hora_inicio').value;
            if (!horaInicio) {
                document.getElementById('error-hora-inicio').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('error-hora-inicio').classList.add('hidden');
            }
            
            // Validar hora de fin
            const horaFin = document.getElementById('hora_fin').value;
            if (!horaFin) {
                document.getElementById('error-hora-fin').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('error-hora-fin').classList.add('hidden');
            }
            
            // Validar fechas
            if (!startDate || !endDate) {
                document.getElementById('error-fechas').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('error-fechas').classList.add('hidden');
            }
            
            if (!isValid) {
                console.log('❌ Validación fallida');
                return false;
            }
            
            console.log('✅ Formulario válido, enviando...');
            return true;
        }
    </script>
</body>
</html>