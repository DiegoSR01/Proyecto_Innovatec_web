<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Modificar Eventos</title>
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
              warning: '#ffc107',
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
</head>
<body class="bg-background text-text min-h-screen">
    <!-- Background effects -->
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
        </header>

        <!-- Main Content -->
        <div class="flex-1 px-8 md:px-20 lg:px-40 py-6">
            <div class="max-w-7xl mx-auto">
                
                <!-- Title Section -->
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-bold leading-tight mb-4 bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">
                        ✏️ Modificar Eventos
                    </h1>
                    <p class="text-textMuted text-lg leading-relaxed max-w-3xl mx-auto">
                        📝 Selecciona un evento activo para modificar. Solo se pueden editar eventos actuales y futuros.
                    </p>
                </div>

                <!-- Events List -->
                <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30">
                    <!-- List Header -->
                    <div class="bg-gradient-to-r from-accent to-secondary p-6 text-white rounded-t-2xl">
                        <h2 class="text-2xl font-bold flex items-center">
                            <span class="mr-3">📅</span> Eventos Disponibles para Modificación
                        </h2>
                        <p class="text-white/80 mt-2">Solo se muestran eventos actuales y futuros</p>
                    </div>
                    
                    <!-- Events Container -->
                    <div class="p-6 space-y-4">
                        <!-- Event 1 -->
                        <div class="bg-gradient-to-br from-cardLight/40 to-card/60 backdrop-blur-lg border border-success/50 bg-success/5 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                                <div class="flex-1 space-y-3">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <h3 class="text-xl font-bold text-text">Festival de Música Electrónica 2024</h3>
                                        <span class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-medium">
                                            🎵 Música
                                        </span>
                                        <span class="px-3 py-1 bg-secondary/20 text-secondary rounded-lg text-sm font-medium">
                                            🏢 Presencial
                                        </span>
                                    </div>
                                    
                                    <div class="grid md:grid-cols-2 gap-4 text-textMuted">
                                        <div class="flex items-center gap-2">
                                            <span class="text-info">📅</span>
                                            <span>Viernes, 15 de febrero de 2024</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-tertiary">⏰</span>
                                            <span>20:00 - 02:00</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-warning">📍</span>
                                            <span>Ciudad de México, México</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-success">👥</span>
                                            <span>245 asistentes confirmados</span>
                                        </div>
                                    </div>
                                    
                                    <div class="text-sm text-warning">
                                        ⚠️ No modificables: 📍 Ubicación
                                    </div>
                                    
                                    <div class="text-sm">
                                        <span class="text-textMuted">Días hasta el evento:</span>
                                        <span class="font-bold text-warning">7 días</span>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <button onclick="alert('Ver detalles próximamente')" 
                                            class="px-4 py-2 bg-info/20 text-info border border-info/30 rounded-lg hover:bg-info hover:text-white transition-all duration-300 font-medium">
                                        👁️ Ver Detalles
                                    </button>
                                    <button onclick="window.location.href='/events/modify/1'" 
                                            class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-secondary transition-all duration-300 font-medium shadow-lg">
                                        ✏️ Modificar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Event 2 -->
                        <div class="bg-gradient-to-br from-cardLight/40 to-card/60 backdrop-blur-lg border border-info/50 bg-info/5 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                                <div class="flex-1 space-y-3">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <h3 class="text-xl font-bold text-text">Conferencia de Tecnología Web</h3>
                                        <span class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-medium">
                                            💻 Tecnología
                                        </span>
                                        <span class="px-3 py-1 bg-secondary/20 text-secondary rounded-lg text-sm font-medium">
                                            🌐 Híbrido
                                        </span>
                                    </div>
                                    
                                    <div class="grid md:grid-cols-2 gap-4 text-textMuted">
                                        <div class="flex items-center gap-2">
                                            <span class="text-info">📅</span>
                                            <span>Viernes, 22 de febrero de 2024</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-tertiary">⏰</span>
                                            <span>09:00 - 18:00</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-warning">📍</span>
                                            <span>Guadalajara, México / Virtual</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-success">👥</span>
                                            <span>89 asistentes confirmados</span>
                                        </div>
                                    </div>
                                    
                                    <div class="text-sm text-success">
                                        ✅ Todos los campos modificables
                                    </div>
                                    
                                    <div class="text-sm">
                                        <span class="text-textMuted">Días hasta el evento:</span>
                                        <span class="font-bold text-info">14 días</span>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <button onclick="alert('Ver detalles próximamente')" 
                                            class="px-4 py-2 bg-info/20 text-info border border-info/30 rounded-lg hover:bg-info hover:text-white transition-all duration-300 font-medium">
                                        👁️ Ver Detalles
                                    </button>
                                    <button onclick="window.location.href='/events/modify/2'" 
                                            class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-secondary transition-all duration-300 font-medium shadow-lg">
                                        ✏️ Modificar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Event 3 -->
                        <div class="bg-gradient-to-br from-cardLight/40 to-card/60 backdrop-blur-lg border border-success/50 bg-success/5 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                                <div class="flex-1 space-y-3">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <h3 class="text-xl font-bold text-text">Obra de Teatro: El Sueño de una Noche</h3>
                                        <span class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-medium">
                                            🎭 Teatro
                                        </span>
                                        <span class="px-3 py-1 bg-secondary/20 text-secondary rounded-lg text-sm font-medium">
                                            🏢 Presencial
                                        </span>
                                    </div>
                                    
                                    <div class="grid md:grid-cols-2 gap-4 text-textMuted">
                                        <div class="flex items-center gap-2">
                                            <span class="text-info">📅</span>
                                            <span>Sábado, 8 de marzo de 2024</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-tertiary">⏰</span>
                                            <span>19:30 - 22:00</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-warning">📍</span>
                                            <span>Teatro Nacional, Monterrey</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-success">👥</span>
                                            <span>156 asistentes confirmados</span>
                                        </div>
                                    </div>
                                    
                                    <div class="text-sm text-warning">
                                        ⚠️ No modificables: 📅 Fecha, 📍 Ubicación
                                    </div>
                                    
                                    <div class="text-sm">
                                        <span class="text-textMuted">Días hasta el evento:</span>
                                        <span class="font-bold text-success">30 días</span>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <button onclick="alert('Ver detalles próximamente')" 
                                            class="px-4 py-2 bg-info/20 text-info border border-info/30 rounded-lg hover:bg-info hover:text-white transition-all duration-300 font-medium">
                                        👁️ Ver Detalles
                                    </button>
                                    <button onclick="window.location.href='/events/modify/3'" 
                                            class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-secondary transition-all duration-300 font-medium shadow-lg">
                                        ✏️ Modificar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
