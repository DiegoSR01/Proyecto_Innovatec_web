<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Suscripción Activada</title>
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
        </header>

        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center px-8 py-12">
            <div class="max-w-2xl mx-auto text-center">
                
                <!-- Success Animation -->
                <div class="mb-8">
                    <div class="inline-block animate-bounce">
                        <div class="text-8xl mb-4">🎉</div>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="bg-gradient-to-br from-success/20 to-success/5 border-2 border-success/30 rounded-2xl p-8 mb-8 backdrop-blur-lg">
                    <h1 class="text-4xl font-bold text-success mb-4">
                        ¡Suscripción Activada!
                    </h1>
                    <p class="text-textMuted text-xl leading-relaxed">
                        🚀 Tu cuenta FestiSpot Pro está lista. Ya puedes crear eventos ilimitados y acceder a todas las funciones premium.
                    </p>
                </div>

                <!-- Plan Details -->
                <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-8 mb-8">
                    <h2 class="text-2xl font-bold text-text mb-6 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent">
                        📋 Detalles de tu Suscripción
                    </h2>
                    
                    <div class="grid md:grid-cols-2 gap-6 text-left">
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-textMuted">Plan:</span>
                                <span class="text-text font-semibold">Plan Pro</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-textMuted">Facturación:</span>
                                <span class="text-text font-semibold">Mensual</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-textMuted">Próximo cobro:</span>
                                <span class="text-text font-semibold">15 Feb 2024</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-textMuted">Monto:</span>
                                <span class="text-accent font-bold text-xl">$599/mes</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-textMuted">Estado:</span>
                                <span class="text-success font-semibold">✅ Activa</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-textMuted">ID Suscripción:</span>
                                <span class="text-textMuted text-sm">sub_1234567890</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- What's Next -->
                <div class="bg-gradient-to-br from-info/20 to-info/5 border border-info/30 rounded-2xl p-6 mb-8">
                    <h3 class="text-xl font-bold text-info mb-4">🔥 ¿Qué sigue?</h3>
                    <div class="text-textMuted text-left space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="text-success">✅</span>
                            <span>Crear eventos ilimitados</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-success">✅</span>
                            <span>Acceso a reportes avanzados</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-success">✅</span>
                            <span>Soporte prioritario</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-success">✅</span>
                            <span>Integraciones con redes sociales</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/event/create" 
                       class="px-8 py-4 bg-gradient-to-r from-accent to-secondary text-white rounded-xl font-bold hover:from-secondary hover:to-accent transition-all duration-300 shadow-2xl hover:shadow-accent/40 text-lg transform hover:scale-105">
                        🚀 Crear mi Primer Evento
                    </a>
                    <a href="/dashboard" 
                       class="px-8 py-4 bg-gradient-to-r from-card/50 to-cardLight/40 text-text rounded-xl font-bold hover:from-cardLight/50 hover:to-card/60 transition-all duration-300 border border-cardLight/30 backdrop-blur-sm text-lg">
                        📊 Ir al Panel
                    </a>
                </div>

                <!-- Support Info -->
                <div class="mt-8 text-center">
                    <p class="text-textMuted text-sm">
                        ¿Tienes preguntas? <a href="#" class="text-accent hover:underline">Contacta soporte</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Clear stored plan data since payment is complete
        localStorage.removeItem('selectedPlan');

        // Optional: Send analytics event
        console.log('🎉 Subscription activated successfully');
        
        // Auto redirect to dashboard after 10 seconds (optional)
        setTimeout(() => {
            if (confirm('¿Quieres ir al panel de control ahora?')) {
                window.location.href = '/dashboard';
            }
        }, 10000);
    </script>
</body>
</html>