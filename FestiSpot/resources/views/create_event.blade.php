<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Crear Evento</title>
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
<body class="bg-background text-text min-h-screen relative overflow-x-hidden">
    <!-- Icono de usuario en esquina superior derecha -->
    <div class="fixed top-4 right-4 z-50">
        @include('partials.user-icon')
    </div>

    <!-- Efectos de fondo con gradientes sutiles -->
    <div class="fixed inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    @php
        $eventBasic = session('event_basic', []);
        $isEditing = !empty($eventBasic);
    @endphp

    <div class="relative flex size-full min-h-screen flex-col bg-background z-10">
        <!-- Header minimalista como la imagen -->
        <header class="header">
            <div style="max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 16px 40px;">
                <!-- Logo -->
                <div style="display: flex; align-items: center; gap: 12px;">
                    <img src="{{ asset('assets/images/logo-festispot.png') }}" alt="FestiSpot Logo" style="width: 70px; height: 70px; border-radius: 50%;">
                    <h1 style="font-size: 22px; font-weight: 700; background: linear-gradient(135deg, #ff4081, #00e5ff, #7c4dff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.5px;">FestiSpot</h1>
                </div>
                
                <!-- Navigation central -->
                <nav style="display: flex; gap: 8px;">
                    <a href="/" class="nav-link">Inicio</a>
                    <a href="/event/create" class="nav-link active">Crear evento</a>
                    <a href="/subscription/plans" class="nav-link">Suscripción</a>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <div class="flex-1 px-8 md:px-20 lg:px-40 py-8 relative z-10">
            <div class="max-w-4xl mx-auto">
                
                <!-- Title Section -->
                <div class="mb-12 text-center">
                    <h1 class="text-5xl font-black leading-tight mb-6 bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent drop-shadow-2xl">
                        ✨ Crear Nuevo Evento
                    </h1>
                    <p class="text-textMuted text-xl leading-relaxed max-w-3xl mx-auto font-medium">
                        🎭 Dale vida a tus ideas más brillantes. Crea experiencias inolvidables que conecten y emocionen.
                    </p>
                </div>

                <!-- Mostrar mensaje solo si realmente se está editando -->
                @if($isEditing)
                    <div class="mb-8 p-6 bg-gradient-to-r from-info/20 to-tertiary/20 border-2 border-info/40 text-info rounded-2xl backdrop-blur-lg shadow-2xl shadow-info/20">
                        <div class="font-bold text-xl">✨ Editando evento existente</div>
                        <div class="text-base mt-2 text-textMuted">Los campos ya contienen la información guardada anteriormente</div>
                        <button type="button" onclick="limpiarYEmpezarNuevo()" class="mt-3 px-4 py-2 bg-info/20 hover:bg-info/30 rounded-lg text-sm font-medium transition-all">
                            🗑️ Limpiar y empezar nuevo evento
                        </button>
                    </div>
                @else
                    <div class="mb-8 p-6 bg-gradient-to-r from-success/20 to-accent/20 border-2 border-success/40 text-success rounded-2xl backdrop-blur-lg shadow-2xl shadow-success/20">
                        <div class="font-bold text-xl">🆕 Creando nuevo evento</div>
                        <div class="text-base mt-2 text-textMuted">Comienza desde cero con tu nueva experiencia</div>
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-8 p-6 bg-gradient-to-r from-accent/20 to-red-500/20 border-2 border-accent/40 text-accent rounded-2xl backdrop-blur-lg shadow-2xl shadow-accent/20">
                        <ul class="list-disc list-inside space-y-2">
                            @foreach ($errors->all() as $error)
                                <li class="text-base font-medium">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('event.storeName') }}" class="space-y-10" id="event-form">
                    @csrf
                    
                    <!-- Event Name -->
                    <div class="bg-gradient-to-br from-card/60 to-cardLight/40 backdrop-blur-xl rounded-3xl p-8 border border-cardLight/30 shadow-2xl hover:shadow-accent/20 transition-all duration-500 group">
                        <label class="block text-text font-bold mb-4 text-xl flex items-center group-hover:text-accent transition-colors duration-300">
                            <span class="text-2xl mr-3">🎯</span> Nombre del evento *
                        </label>
                        <input
                            name="event_name"
                            type="text"
                            class="w-full px-8 py-5 bg-cardLight/50 border-2 border-cardLight/50 rounded-2xl text-text placeholder-textDark focus:border-accent focus:ring-4 focus:ring-accent/30 focus:outline-none transition-all duration-300 backdrop-blur-sm text-xl font-medium focus:shadow-lg focus:shadow-accent/20"
                            placeholder="Ej: Festival de Música Electrónica 2024"
                            required
                            value="{{ old('event_name', $eventBasic['event_name'] ?? '') }}"
                        />
                    </div>
                    
                    <!-- Event Description -->
                    <div class="bg-gradient-to-br from-card/60 to-cardLight/40 backdrop-blur-xl rounded-3xl p-8 border border-cardLight/30 shadow-2xl hover:shadow-secondary/20 transition-all duration-500 group">
                        <label class="block text-text font-bold mb-4 text-xl flex items-center group-hover:text-secondary transition-colors duration-300">
                            <span class="text-2xl mr-3">📝</span> Descripción del evento *
                        </label>
                        <textarea
                            name="event_description"
                            rows="6"
                            maxlength="250"
                            class="w-full px-8 py-5 bg-cardLight/50 border-2 border-cardLight/50 rounded-2xl text-text placeholder-textDark focus:border-secondary focus:ring-4 focus:ring-secondary/30 focus:outline-none transition-all duration-300 backdrop-blur-sm resize-vertical text-xl leading-relaxed font-medium focus:shadow-lg focus:shadow-secondary/20"
                            placeholder="Describe tu evento de manera atractiva y detallada..."
                            required
                        >{{ old('event_description', $eventBasic['event_description'] ?? '') }}</textarea>
                        <div class="flex justify-between items-center mt-4">
                            <div class="text-base text-textMuted font-medium">💡 Máximo 250 caracteres - Haz que cuente cada palabra</div>
                            <div class="text-base font-bold px-4 py-2 rounded-full transition-all duration-300" id="char-display">
                                <span id="char-count">{{ strlen(old('event_description', $eventBasic['event_description'] ?? '')) }}</span> / 250
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event Category -->
                    <div class="bg-gradient-to-br from-card/60 to-cardLight/40 backdrop-blur-xl rounded-3xl p-8 border border-cardLight/30 shadow-2xl hover:shadow-tertiary/20 transition-all duration-500 group">
                        <label class="block text-text font-bold mb-4 text-xl flex items-center group-hover:text-tertiary transition-colors duration-300">
                            <span class="text-2xl mr-3">🎪</span> Categoría del evento *
                        </label>
                        <select
                            name="event_category"
                            class="w-full px-8 py-5 bg-cardLight/50 border-2 border-cardLight/50 rounded-2xl text-text focus:border-tertiary focus:ring-4 focus:ring-tertiary/30 focus:outline-none transition-all duration-300 backdrop-blur-sm text-xl font-medium focus:shadow-lg focus:shadow-tertiary/20"
                            required
                        >
                            <option value="">🎭 Selecciona una categoría</option>
                            <option value="Conferencia" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Conferencia' ? 'selected' : '' }}>🎤 Conferencia</option>
                            <option value="Seminario" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Seminario' ? 'selected' : '' }}>📚 Seminario</option>
                            <option value="Taller" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Taller' ? 'selected' : '' }}>🔧 Taller</option>
                            <option value="Networking" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Networking' ? 'selected' : '' }}>🤝 Networking</option>
                            <option value="Festival" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Festival' ? 'selected' : '' }}>🎉 Festival</option>
                            <option value="Deportivo" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Deportivo' ? 'selected' : '' }}>⚽ Evento Deportivo</option>
                            <option value="Cultural" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Cultural' ? 'selected' : '' }}>🎭 Evento Cultural</option>
                            <option value="Empresarial" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Empresarial' ? 'selected' : '' }}>💼 Evento Empresarial</option>
                            <option value="Educativo" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Educativo' ? 'selected' : '' }}>🎓 Educativo</option>
                            <option value="Social" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Social' ? 'selected' : '' }}>👥 Evento Social</option>
                            <option value="Otro" {{ old('event_category', $eventBasic['event_category'] ?? '') == 'Otro' ? 'selected' : '' }}>🌟 Otro</option>
                        </select>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between items-center pt-10 border-t-2 border-gradient-to-r from-accent/30 to-secondary/30">
                        <div class="flex gap-6">
                            <button type="button" id="btn-nuevo-evento" 
                                    class="px-10 py-5 border-3 border-success/60 text-success rounded-2xl font-bold hover:bg-success hover:text-background transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl hover:shadow-success/40 backdrop-blur-sm">
                                <span class="text-xl">🆕</span> Nuevo Evento
                            </button>
                            
                            <button type="button" id="btn-limpiar-basicos" 
                                    class="px-10 py-5 border-3 border-warning/60 text-warning rounded-2xl font-bold hover:bg-warning hover:text-background transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl hover:shadow-warning/40 backdrop-blur-sm">
                                <span class="text-xl">🗑️</span> Limpiar Datos
                            </button>
                        </div>
                        
                        <button type="submit" id="submit-btn"
                                class="px-14 py-5 bg-gradient-to-r from-secondary to-info text-white rounded-2xl font-bold hover:from-info hover:to-secondary transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl hover:shadow-secondary/50 backdrop-blur-sm text-xl">
                            Siguiente: Fechas → <span class="text-2xl ml-2">🗓️</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🎨 Inicializando formulario de creación...');
            
            // Restaurar estado del botón al cargar la página
            restaurarEstadoBoton();
            
            // Verificar si hay datos existentes
            const eventData = @json($eventBasic);
            const isEditing = @json($isEditing);
            
            console.log('¿Editando?', isEditing);
            console.log('Datos del evento:', eventData);
            
            if (!isEditing) {
                console.log('✅ Nuevo evento - formulario limpio');
            } else {
                console.log('📝 Editando evento existente');
            }

            setupFormValidation();
            setupCharacterCounters();
            setupEventListeners();
            
            // Evento para detectar cuando el usuario regresa con el botón atrás
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    console.log('🔄 Página restaurada desde caché, restaurando estado...');
                    restaurarEstadoBoton();
                }
            });
        });

        function restaurarEstadoBoton() {
            const submitBtn = document.getElementById('submit-btn');
            if (submitBtn) {
                // Restaurar texto y habilitar botón
                submitBtn.innerHTML = 'Siguiente: Fechas → <span class="text-2xl ml-2">🗓️</span>';
                submitBtn.disabled = false;
                
                // Restaurar clases CSS
                submitBtn.className = 'px-14 py-5 bg-gradient-to-r from-secondary to-info text-white rounded-2xl font-bold hover:from-info hover:to-secondary transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl hover:shadow-secondary/50 backdrop-blur-sm text-xl';
                
                console.log('✅ Estado del botón restaurado');
            }
        }

        function limpiarYEmpezarNuevo() {
            if (confirm('¿Estás seguro de que quieres eliminar toda la información actual y empezar un evento completamente nuevo?')) {
                // Mostrar loading
                const btn = event.target;
                const originalText = btn.innerHTML;
                btn.innerHTML = '⏳ Limpiando...';
                btn.disabled = true;
                
                // Limpiar formulario inmediatamente
                limpiarFormulario();
                
                // Intentar limpiar en el servidor
                fetch('{{ route("event.clearAll") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    console.log('✅ Datos limpiados del servidor');
                    location.reload(); // Recargar la página para mostrar el formulario limpio
                })
                .catch(error => {
                    console.error('❌ Error al limpiar datos del servidor:', error);
                    console.log('✅ Formulario limpiado localmente');
                    // Ocultar mensaje de edición
                    const editingMessage = document.querySelector('.bg-gradient-to-r.from-info\\/20');
                    if (editingMessage) {
                        editingMessage.style.display = 'none';
                    }
                    // Restaurar botón
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
            }
        }

        function limpiarFormulario() {
            // Limpiar todos los campos del formulario
            document.querySelector('input[name="event_name"]').value = '';
            document.querySelector('textarea[name="event_description"]').value = '';
            document.querySelector('select[name="event_category"]').value = '';
            
            // Actualizar contador de caracteres
            actualizarContadorCaracteres();
        }

        function actualizarContadorCaracteres() {
            const charCount = document.getElementById('char-count');
            const charDisplay = document.getElementById('char-display');
            
            if (charCount) {
                charCount.textContent = '0';
            }
            
            if (charDisplay) {
                charDisplay.className = 'text-base font-bold px-4 py-2 rounded-full transition-all duration-300 text-textMuted';
            }
        }

        function setupFormValidation() {
            const form = document.getElementById('event-form');
            const submitBtn = document.getElementById('submit-btn');
            
            form.addEventListener('submit', function(e) {
                console.log('📝 Enviando formulario...');
                
                // Validar campos antes de proceder
                const eventName = document.querySelector('input[name="event_name"]').value.trim();
                const eventDescription = document.querySelector('textarea[name="event_description"]').value.trim();
                const eventCategory = document.querySelector('select[name="event_category"]').value;
                
                if (!eventName || !eventDescription || !eventCategory) {
                    console.log('❌ Formulario incompleto');
                    return; // No proceder si faltan campos
                }
                
                // Cambiar estado del botón solo si la validación pasa
                submitBtn.disabled = true;
                submitBtn.innerHTML = '⏳ Guardando...';
                submitBtn.className = 'px-14 py-5 bg-gray-500 text-white rounded-2xl font-bold cursor-not-allowed opacity-50 text-xl';
                
                console.log('✅ Formulario válido, enviando...');
                
                // Timeout de seguridad para restaurar el botón si algo sale mal
                setTimeout(() => {
                    if (submitBtn.disabled) {
                        console.log('⚠️ Timeout de seguridad: restaurando botón');
                        restaurarEstadoBoton();
                    }
                }, 10000); // 10 segundos
            });
            
            // Prevenir envíos múltiples
            form.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                    if (!submitBtn.disabled) {
                        form.requestSubmit();
                    }
                }
            });
        }

        function setupCharacterCounters() {
            // Contador para descripción
            const descriptionTextarea = document.querySelector('textarea[name="event_description"]');
            const charCount = document.getElementById('char-count');
            const charDisplay = document.getElementById('char-display');
            
            if (descriptionTextarea && charCount && charDisplay) {
                // Establecer valor inicial
                const initialLength = descriptionTextarea.value.length;
                charCount.textContent = initialLength;
                
                descriptionTextarea.addEventListener('input', function() {
                    const length = Math.min(this.value.length, 250);
                    charCount.textContent = length;
                    
                    // Cambiar color del contador según la longitud
                    if (length >= 200) {
                        charDisplay.className = 'text-base font-bold px-4 py-2 rounded-full transition-all duration-300 text-accent bg-accent/10';
                    } else if (length >= 150) {
                        charDisplay.className = 'text-base font-bold px-4 py-2 rounded-full transition-all duration-300 text-warning bg-warning/10';
                    } else {
                        charDisplay.className = 'text-base font-bold px-4 py-2 rounded-full transition-all duration-300 text-textMuted';
                    }
                    
                    // Limitar a 250 caracteres
                    if (this.value.length > 250) {
                        this.value = this.value.substring(0, 250);
                        charCount.textContent = '250';
                    }
                });
            }
        }

        function setupEventListeners() {
            // Botón para nuevo evento
            const btnNuevoEvento = document.getElementById('btn-nuevo-evento');
            if (btnNuevoEvento) {
                btnNuevoEvento.addEventListener('click', function() {
                    if (confirm('¿Quieres crear un evento completamente nuevo? Esto borrará TODA la información actual y empezará desde cero.')) {
                        const btn = this;
                        const originalText = btn.innerHTML;
                        btn.innerHTML = '<span class="text-xl">⏳</span> Limpiando...';
                        btn.disabled = true;
                        
                        // Limpiar formulario inmediatamente
                        limpiarFormulario();
                        
                        // Intentar limpiar en el servidor
                        fetch('{{ route("event.clearAll") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            console.log('✅ Todos los datos limpiados del servidor');
                            location.reload();
                        })
                        .catch(error => {
                            console.error('❌ Error al limpiar datos del servidor:', error);
                            console.log('✅ Formulario limpiado localmente');
                            
                            // Ocultar mensaje de edición si existe
                            const editingMessage = document.querySelector('.bg-gradient-to-r.from-info\\/20');
                            if (editingMessage) {
                                editingMessage.style.display = 'none';
                            }
                            
                            // Restaurar botón
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                            
                            alert('✅ Formulario limpiado correctamente');
                        });
                    }
                });
            }
            
            // Botón para limpiar datos básicos
            const btnLimpiarBasicos = document.getElementById('btn-limpiar-basicos');
            if (btnLimpiarBasicos) {
                btnLimpiarBasicos.addEventListener('click', function() {
                    if (confirm('¿Estás seguro de que quieres limpiar todos los datos básicos del evento? Esta acción no se puede deshacer.')) {
                        const btn = this;
                        const originalText = btn.innerHTML;
                        
                        // Limpiar formulario localmente primero
                        limpiarFormulario();
                        
                        // Mostrar estado de carga
                        btn.innerHTML = '<span class="text-xl">🗑️</span> Limpiando...';
                        btn.disabled = true;
                        
                        // Limpiar sesión del servidor
                        fetch('{{ route("event.clearBasic") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            console.log('✅ Datos básicos limpiados del servidor');
                            alert('✅ Datos básicos limpiados correctamente');
                        })
                        .catch(error => {
                            console.error('Error al limpiar datos básicos del servidor:', error);
                            alert('✅ Datos limpiados localmente');
                        })
                        .finally(() => {
                            // Restaurar botón
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                        });
                    }
                });
            }
            
            // Detectar cambios en los campos para habilitar el botón si estaba deshabilitado
            const formFields = document.querySelectorAll('input[name="event_name"], textarea[name="event_description"], select[name="event_category"]');
            formFields.forEach(field => {
                field.addEventListener('input', function() {
                    const submitBtn = document.getElementById('submit-btn');
                    if (submitBtn && submitBtn.disabled && submitBtn.innerHTML.includes('Guardando')) {
                        console.log('🔄 Campo modificado, restaurando botón...');
                        restaurarEstadoBoton();
                    }
                });
            });
        }
    </script>
</body>
</html>
