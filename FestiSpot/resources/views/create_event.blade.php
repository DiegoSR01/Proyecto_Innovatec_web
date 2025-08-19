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
              // Nueva paleta modo oscuro elegante con vibra festival
              background: '#0a0a0f',           // Negro azulado muy oscuro
              card: '#16213e',                // Azul naval profundo
              cardLight: '#1e2749',           // Azul naval más claro
              accent: '#ff4081',              // Rosa vibrante
              secondary: '#00e5ff',           // Cyan eléctrico
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
<body class="bg-background text-text min-h-screen relative overflow-x-hidden">
    <!-- Efectos de fondo con gradientes sutiles -->
    <div class="fixed inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    @php
        $eventBasic = session('event_basic', []);
    @endphp

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

                <!-- Mostrar mensaje si se está editando -->
                @if(!empty($eventBasic))
                    <div class="mb-8 p-6 bg-gradient-to-r from-info/20 to-tertiary/20 border-2 border-info/40 text-info rounded-2xl backdrop-blur-lg shadow-2xl shadow-info/20">
                        <div class="font-bold text-xl flex items-center">
                            ✨ <span class="ml-3">Editando evento existente</span>
                        </div>
                        <div class="text-base mt-3 text-textMuted">Los campos ya contienen la información guardada anteriormente</div>
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
                <form method="POST" action="{{ route('event.storeName') }}" class="space-y-10">
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
                        
                        <button type="submit" 
                                class="px-14 py-5 bg-gradient-to-r from-accent to-secondary text-white rounded-2xl font-bold hover:from-secondary hover:to-accent transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl hover:shadow-accent/50 backdrop-blur-sm text-xl">
                            Siguiente: Fechas → <span class="text-2xl ml-2">🗓️</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Actualizar contador de caracteres con colores más elegantes
            const textarea = document.querySelector('textarea[name="event_description"]');
            const charCount = document.getElementById('char-count');
            const charDisplay = document.getElementById('char-display');
            
            if (textarea && charCount && charDisplay) {
                function updateCount() {
                    const count = textarea.value.length;
                    charCount.textContent = count;
                    
                    // Cambiar colores según el progreso con la nueva paleta
                    if (count > 200) {
                        charDisplay.className = 'text-base font-bold px-4 py-2 rounded-full bg-accent/20 text-accent border-2 border-accent/40 shadow-lg shadow-accent/20';
                    } else if (count > 150) {
                        charDisplay.className = 'text-base font-bold px-4 py-2 rounded-full bg-warning/20 text-warning border-2 border-warning/40 shadow-lg shadow-warning/20';
                    } else if (count > 50) {
                        charDisplay.className = 'text-base font-bold px-4 py-2 rounded-full bg-secondary/20 text-secondary border-2 border-secondary/40 shadow-lg shadow-secondary/20';
                    } else {
                        charDisplay.className = 'text-base font-bold px-4 py-2 rounded-full bg-textDark/20 text-textDark border-2 border-textDark/30';
                    }
                }
                
                textarea.addEventListener('input', function() {
                    if (this.value.length > 250) {
                        this.value = this.value.substring(0, 250);
                    }
                    updateCount();
                });
                
                updateCount();
            }

            // Log para verificar datos existentes
            const eventBasic = @json($eventBasic);
            if (Object.keys(eventBasic).length > 0) {
                console.log('✅ Datos existentes del evento cargados:', eventBasic);
            } else {
                console.log('📝 Creando nuevo evento');
            }
            
            // Botón para nuevo evento (reset completo)
            document.getElementById('btn-nuevo-evento').addEventListener('click', function() {
                if (confirm('¿Quieres crear un evento completamente nuevo? Esto borrará TODA la información del evento actual (datos básicos, fechas, ubicación y media) y empezará desde cero.')) {
                    // Mostrar loading
                    const btn = this;
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '⏳ Limpiando...';
                    btn.disabled = true;
                    
                    // Limpiar formulario actual primero
                    document.querySelector('input[name="event_name"]').value = '';
                    document.querySelector('textarea[name="event_description"]').value = '';
                    document.querySelector('select[name="event_category"]').value = '';
                    
                    // Actualizar contador
                    const charCount = document.getElementById('char-count');
                    if (charCount) charCount.textContent = '0';
                    
                    // Limpiar TODA la sesión del servidor
                    fetch('{{ route("event.clearAll") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => response.json())
                      .then(data => {
                          console.log('✅ Todos los datos del evento limpiados');
                          
                          // Mostrar mensaje de éxito
                          const messageDiv = document.createElement('div');
                          messageDiv.className = 'mb-6 p-4 bg-green-500/20 border border-green-500/30 text-green-400 rounded-lg animate-pulse';
                          messageDiv.innerHTML = `
                              <div class="font-semibold">🎉 ¡Listo para un nuevo evento!</div>
                              <div class="text-sm mt-1">Toda la información anterior ha sido eliminada. Puedes empezar desde cero.</div>
                          `;
                          
                          // Remover mensaje de "editando" si existe
                          const editingMessage = document.querySelector('.bg-blue-500\\/20');
                          if (editingMessage) {
                              editingMessage.remove();
                          }
                          
                          // Agregar mensaje de éxito
                          document.querySelector('.max-w-4xl').insertBefore(messageDiv, document.querySelector('form'));
                          
                          // Remover mensaje después de 5 segundos
                          setTimeout(() => {
                              messageDiv.remove();
                          }, 5000);
                          
                          // Restaurar botón
                          btn.innerHTML = originalText;
                          btn.disabled = false;
                      })
                      .catch(error => {
                          console.error('Error al limpiar datos:', error);
                          alert('❌ Error al limpiar los datos. Por favor intenta de nuevo.');
                          btn.innerHTML = originalText;
                          btn.disabled = false;
                      });
                }
            });
            
            // Botón para limpiar datos básicos
            document.getElementById('btn-limpiar-basicos').addEventListener('click', function() {
                if (confirm('¿Estás seguro de que quieres limpiar todos los datos básicos del evento? Esta acción no se puede deshacer.')) {
                    // Limpiar formulario
                    document.querySelector('input[name="event_name"]').value = '';
                    document.querySelector('textarea[name="event_description"]').value = '';
                    document.querySelector('select[name="event_category"]').value = '';
                    
                    // Actualizar contador
                    const charCount = document.getElementById('char-count');
                    if (charCount) charCount.textContent = '0';
                    
                    // Limpiar sesión del servidor
                    fetch('{{ route("event.clearBasic") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(() => {
                        console.log('Datos básicos limpiados del servidor');
                        // Mostrar mensaje de confirmación
                        const messageDiv = document.createElement('div');
                        messageDiv.className = 'mb-6 p-4 bg-green-500/20 border border-green-500/30 text-green-400 rounded-lg';
                        messageDiv.innerHTML = `
                            <div class="font-semibold">✅ Datos básicos limpiados</div>
                            <div class="text-sm mt-1">Puedes empezar desde cero</div>
                        `;
                        document.querySelector('.max-w-4xl').insertBefore(messageDiv, document.querySelector('form'));
                        setTimeout(() => messageDiv.remove(), 3000);
                    });
                }
            });
        });
    </script>
</body>
</html>
