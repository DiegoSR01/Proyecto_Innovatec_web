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

    <!-- Efectos de fondo con gradientes sutiles -->
    <div class="fixed inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="relative flex size-full min-h-screen flex-col bg-background z-10">
        <!-- Header -->
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
                    <a href="/subscription/plans" class="nav-link">Suscripciones</a>
                    <a href="/subscription/success" class="nav-link active">Éxito</a>
                    <a href="/configuration" class="nav-link">Configuración</a>
                </nav>
                
                <!-- User section -->
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="position: relative;">
                        <button class="nav-link" style="padding: 8px 12px;">
                            <i class="fas fa-bell" style="font-size: 16px;"></i>
                        </button>
                    </div>
                </div>
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