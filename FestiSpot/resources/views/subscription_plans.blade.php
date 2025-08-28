<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Planes de Suscripción</title>
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
                    <img src="{{ asset('assets/images/logo-festispot.png') }}" alt="FestiSpot Logo" style="width: 56px; height: 56px; border-radius: 50%;">
                    <h1 style="font-size: 22px; font-weight: 700; background: linear-gradient(135deg, #ff4081, #00e5ff, #7c4dff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.5px;">FestiSpot</h1>
                </div>
                
                <!-- Navigation central -->
                <nav style="display: flex; gap: 8px;">
                    <a href="/" class="nav-link">Inicio</a>
                    <a href="/subscription/plans" class="nav-link active">Suscripciones</a>
                    <a href="/configuration" class="nav-link">Configuración</a>
                </nav>
                
                <!-- User section -->
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="position: relative;">
                        <button class="nav-link" style="padding: 8px 12px;">
                            <i class="fas fa-bell" style="font-size: 16px;"></i>
                        </button>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #ff4081, #00e5ff); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <span style="color: white; font-weight: 600; font-size: 14px;">U</span>
                        </div>
                        <span style="color: #ffffff; font-weight: 500; font-size: 14px;">Usuario</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="flex-1 px-8 md:px-20 lg:px-40 py-8">
            <div class="max-w-7xl mx-auto">
                
                <!-- Title Section -->
                <div class="mb-12 text-center">
                    <h1 class="text-5xl font-bold leading-tight mb-6 bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">
                        💳 Planes de Suscripción
                    </h1>
                    <p class="text-textMuted text-xl leading-relaxed max-w-4xl mx-auto">
                        🚀 Elige el plan perfecto para tu negocio de eventos. Obtén acceso completo a todas las herramientas profesionales de FestiSpot.
                    </p>
                </div>

                <!-- Billing Toggle -->
                <div class="flex justify-center mb-12">
                    <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl p-2 border border-cardLight/30">
                        <div class="flex items-center gap-4">
                            <button id="monthlyToggle" onclick="toggleBilling('monthly')" 
                                    class="billing-toggle active px-8 py-3 rounded-xl font-bold transition-all duration-300">
                                💰 Mensual
                            </button>
                            <button id="annualToggle" onclick="toggleBilling('annual')" 
                                    class="billing-toggle px-8 py-3 rounded-xl font-bold transition-all duration-300">
                                🎉 Anual (20% descuento)
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Plans Grid -->
                <div class="grid lg:grid-cols-3 gap-8 mb-12">
                    
                    <!-- Plan Básico -->
                    <div class="plan-card bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-8 relative transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <div class="text-center mb-8">
                            <div class="text-6xl mb-4">🎪</div>
                            <h3 class="text-3xl font-bold text-text mb-4">Plan Básico</h3>
                            <div class="price-container">
                                <div class="monthly-price">
                                    <span class="text-4xl font-bold text-accent">$299</span>
                                    <span class="text-textMuted">/mes</span>
                                </div>
                                <div class="annual-price hidden">
                                    <span class="text-4xl font-bold text-accent">$2,390</span>
                                    <span class="text-textMuted">/año</span>
                                    <div class="text-success text-sm mt-1">¡Ahorra $1,198 al año!</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Hasta 5 eventos por mes</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Gestión básica de asistentes</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Notificaciones por email</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Soporte básico</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-textMuted text-xl">❌</span>
                                <span class="text-textMuted">Reportes avanzados</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-textMuted text-xl">❌</span>
                                <span class="text-textMuted">Integración API</span>
                            </div>
                        </div>
                        
                        <button onclick="selectPlan('basic')" 
                                class="w-full px-8 py-4 bg-gradient-to-r from-info to-tertiary text-white rounded-xl font-bold hover:from-tertiary hover:to-info transition-all duration-300 shadow-lg hover:shadow-info/40 transform hover:scale-105">
                            🚀 Comenzar con Básico
                        </button>
                    </div>

                    <!-- Plan Pro (Recomendado) -->
                    <div class="plan-card bg-gradient-to-br from-accent/20 to-secondary/10 backdrop-blur-xl rounded-2xl shadow-2xl border-2 border-accent/50 p-8 relative transition-all duration-500 hover:scale-105 hover:shadow-2xl transform scale-105">
                        <!-- Badge Recomendado -->
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                            <span class="bg-gradient-to-r from-accent to-secondary text-white px-6 py-2 rounded-full text-sm font-bold shadow-lg">
                                ⭐ MÁS POPULAR
                            </span>
                        </div>
                        
                        <div class="text-center mb-8">
                            <div class="text-6xl mb-4">🎭</div>
                            <h3 class="text-3xl font-bold text-text mb-4">Plan Pro</h3>
                            <div class="price-container">
                                <div class="monthly-price">
                                    <span class="text-4xl font-bold text-accent">$599</span>
                                    <span class="text-textMuted">/mes</span>
                                </div>
                                <div class="annual-price hidden">
                                    <span class="text-4xl font-bold text-accent">$4,790</span>
                                    <span class="text-textMuted">/año</span>
                                    <div class="text-success text-sm mt-1">¡Ahorra $2,398 al año!</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Eventos ilimitados</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Gestión avanzada de asistentes</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Notificaciones multi-canal</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Soporte prioritario</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Reportes avanzados</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Integración con redes sociales</span>
                            </div>
                        </div>
                        
                        <button onclick="selectPlan('pro')" 
                                class="w-full px-8 py-4 bg-gradient-to-r from-accent to-secondary text-white rounded-xl font-bold hover:from-secondary hover:to-accent transition-all duration-300 shadow-lg hover:shadow-accent/40 transform hover:scale-105">
                            🚀 Elegir Plan Pro
                        </button>
                    </div>

                    <!-- Plan Enterprise -->
                    <div class="plan-card bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-8 relative transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <div class="text-center mb-8">
                            <div class="text-6xl mb-4">🏢</div>
                            <h3 class="text-3xl font-bold text-text mb-4">Plan Enterprise</h3>
                            <div class="price-container">
                                <div class="monthly-price">
                                    <span class="text-4xl font-bold text-accent">$1,299</span>
                                    <span class="text-textMuted">/mes</span>
                                </div>
                                <div class="annual-price hidden">
                                    <span class="text-4xl font-bold text-accent">$10,390</span>
                                    <span class="text-textMuted">/año</span>
                                    <div class="text-success text-sm mt-1">¡Ahorra $5,198 al año!</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Todo del Plan Pro</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Múltiples organizadores</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">API completa</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Branding personalizado</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Soporte dedicado 24/7</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-success text-xl">✅</span>
                                <span class="text-textMuted">Capacitación personalizada</span>
                            </div>
                        </div>
                        
                        <button onclick="selectPlan('enterprise')" 
                                class="w-full px-8 py-4 bg-gradient-to-r from-purple to-tertiary text-white rounded-xl font-bold hover:from-tertiary hover:to-purple transition-all duration-300 shadow-lg hover:shadow-purple/40 transform hover:scale-105">
                            🚀 Ir a Enterprise
                        </button>
                    </div>
                </div>

                <!-- Features Comparison -->
                <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-8">
                    <h3 class="text-3xl font-bold text-center text-text mb-8 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent">
                        🔍 Comparación Detallada
                    </h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-cardLight/30">
                                    <th class="pb-4 text-textMuted font-semibold">Características</th>
                                    <th class="pb-4 text-center text-info font-semibold">Básico</th>
                                    <th class="pb-4 text-center text-accent font-semibold">Pro</th>
                                    <th class="pb-4 text-center text-purple font-semibold">Enterprise</th>
                                </tr>
                            </thead>
                            <tbody class="text-textMuted">
                                <tr class="border-b border-cardLight/20">
                                    <td class="py-4">Eventos por mes</td>
                                    <td class="py-4 text-center">5</td>
                                    <td class="py-4 text-center text-accent">Ilimitados</td>
                                    <td class="py-4 text-center text-accent">Ilimitados</td>
                                </tr>
                                <tr class="border-b border-cardLight/20">
                                    <td class="py-4">Asistentes por evento</td>
                                    <td class="py-4 text-center">500</td>
                                    <td class="py-4 text-center">5,000</td>
                                    <td class="py-4 text-center text-accent">Ilimitados</td>
                                </tr>
                                <tr class="border-b border-cardLight/20">
                                    <td class="py-4">Reportes y analytics</td>
                                    <td class="py-4 text-center">❌</td>
                                    <td class="py-4 text-center text-success">✅</td>
                                    <td class="py-4 text-center text-success">✅ Avanzado</td>
                                </tr>
                                <tr class="border-b border-cardLight/20">
                                    <td class="py-4">Soporte</td>
                                    <td class="py-4 text-center">Email</td>
                                    <td class="py-4 text-center">Prioritario</td>
                                    <td class="py-4 text-center text-accent">24/7 Dedicado</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        let selectedPlan = null;
        let billingType = 'monthly';

        function toggleBilling(type) {
            billingType = type;
            
            // Update toggle buttons
            document.querySelectorAll('.billing-toggle').forEach(btn => {
                btn.classList.remove('active');
            });
            document.getElementById(type + 'Toggle').classList.add('active');
            
            // Show/hide prices
            document.querySelectorAll('.monthly-price').forEach(el => {
                el.classList.toggle('hidden', type === 'annual');
            });
            document.querySelectorAll('.annual-price').forEach(el => {
                el.classList.toggle('hidden', type === 'monthly');
            });
        }

        function selectPlan(planType) {
            selectedPlan = planType;
            
            const planNames = {
                'basic': 'Plan Básico',
                'pro': 'Plan Pro', 
                'enterprise': 'Plan Enterprise'
            };

            const prices = {
                'basic': { monthly: 299, annual: 2390 },
                'pro': { monthly: 599, annual: 4790 },
                'enterprise': { monthly: 1299, annual: 10390 }
            };

            // Store plan data for checkout
            const planData = {
                type: planType,
                name: planNames[planType],
                billing: billingType,
                price: prices[planType][billingType]
            };

            localStorage.setItem('selectedPlan', JSON.stringify(planData));
            
            // Redirect to payment page
            window.location.href = '/subscription/checkout';
        }

        // Add CSS for active toggle
        document.addEventListener('DOMContentLoaded', function() {
            const style = document.createElement('style');
            style.textContent = `
                .billing-toggle.active {
                    background: linear-gradient(135deg, #ff4081, #00e5ff);
                    color: white;
                    box-shadow: 0 8px 25px rgba(255, 64, 129, 0.3);
                }
                .billing-toggle:not(.active) {
                    background: rgba(176, 190, 197, 0.1);
                    color: #b0bec5;
                }
                .billing-toggle:not(.active):hover {
                    background: rgba(176, 190, 197, 0.2);
                    color: #ffffff;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>
