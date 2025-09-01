<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Pago de Suscripción</title>
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
                    <img src="{{ asset('assets/images/logo-festispot.png') }}" alt="FestiSpot Logo" style="width: 70px; height: 70px; border-radius: 50%;">
                    <h1 style="font-size: 22px; font-weight: 700; background: linear-gradient(135deg, #ff4081, #00e5ff, #7c4dff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.5px;">FestiSpot</h1>
                </div>
                
                <!-- Navigation central -->
                <nav style="display: flex; gap: 8px;">
                    <a href="/" class="nav-link">Inicio</a>
                    <a href="/subscription/plans" class="nav-link">Suscripciones</a>
                    <a href="/subscription/checkout" class="nav-link active">Pago</a>
                    <a href="/configuration" class="nav-link">Configuración</a>
                </nav>
                
                <!-- User section -->
                <div style="display: flex; align-items: center; gap: 12px;">
                    <a href="/subscription/plans" class="nav-link" style="padding: 8px 16px;">← Volver a planes</a>
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
            <div class="max-w-6xl mx-auto">
                
                <div class="grid lg:grid-cols-2 gap-12">
                    
                    <!-- Plan Summary -->
                    <div class="order-2 lg:order-1">
                        <h2 class="text-3xl font-bold text-text mb-8 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent">
                            💳 Información de Pago
                        </h2>
                        
                        <form id="paymentForm" class="space-y-6">
                            <!-- Payment Method -->
                            <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-6">
                                <h3 class="text-xl font-bold text-text mb-6 flex items-center">
                                    <span class="mr-3">💳</span> Método de Pago
                                </h3>
                                
                                <div class="space-y-4">
                                    <label class="flex items-center p-4 bg-cardLight/50 rounded-xl border border-cardLight/30 cursor-pointer hover:border-accent/50 transition-all">
                                        <input type="radio" name="payment_method" value="card" checked class="mr-4 text-accent">
                                        <div class="flex items-center gap-3">
                                            <span class="text-2xl">💳</span>
                                            <div>
                                                <div class="font-semibold text-text">Tarjeta de Crédito/Débito</div>
                                                <div class="text-sm text-textMuted">Visa, Mastercard, American Express</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Card Information -->
                            <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-6">
                                <h3 class="text-xl font-bold text-text mb-6 flex items-center">
                                    <span class="mr-3">🔐</span> Datos de la Tarjeta
                                </h3>
                                
                                <div class="space-y-6">
                                    <!-- Card Number -->
                                    <div>
                                        <label class="block text-textMuted text-sm font-medium mb-2">
                                            Número de Tarjeta *
                                        </label>
                                        <input type="text" id="cardNumber" name="card_number" required maxlength="19"
                                               placeholder="1234 5678 9012 3456"
                                               class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                        <div class="text-xs text-textMuted mt-1">Los 16 dígitos de tu tarjeta</div>
                                    </div>

                                    <div class="grid md:grid-cols-2 gap-6">
                                        <!-- Expiry Date -->
                                        <div>
                                            <label class="block text-textMuted text-sm font-medium mb-2">
                                                Fecha de Vencimiento *
                                            </label>
                                            <input type="text" id="expiryDate" name="expiry_date" required maxlength="5"
                                                   placeholder="MM/YY"
                                                   class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                        </div>

                                        <!-- CVV -->
                                        <div>
                                            <label class="block text-textMuted text-sm font-medium mb-2">
                                                Código de Seguridad (CVV) *
                                            </label>
                                            <input type="text" id="cvv" name="cvv" required maxlength="4"
                                                   placeholder="123"
                                                   class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                        </div>
                                    </div>

                                    <!-- Cardholder Name -->
                                    <div>
                                        <label class="block text-textMuted text-sm font-medium mb-2">
                                            Nombre del Titular *
                                        </label>
                                        <input type="text" id="cardholderName" name="cardholder_name" required
                                               placeholder="Juan Pérez García"
                                               class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                        <div class="text-xs text-textMuted mt-1">Como aparece en tu tarjeta</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Billing Address -->
                            <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-6">
                                <h3 class="text-xl font-bold text-text mb-6 flex items-center">
                                    <span class="mr-3">🏠</span> Dirección de Facturación
                                </h3>
                                
                                <div class="space-y-6">
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <!-- Country -->
                                        <div>
                                            <label class="block text-textMuted text-sm font-medium mb-2">
                                                País *
                                            </label>
                                            <select id="country" name="country" required
                                                    class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                                <option value="">Seleccionar país</option>
                                                <option value="MX">México</option>
                                                <option value="US">Estados Unidos</option>
                                                <option value="CA">Canadá</option>
                                                <option value="ES">España</option>
                                                <option value="CO">Colombia</option>
                                                <option value="AR">Argentina</option>
                                            </select>
                                        </div>

                                        <!-- State -->
                                        <div>
                                            <label class="block text-textMuted text-sm font-medium mb-2">
                                                Estado/Provincia *
                                            </label>
                                            <input type="text" id="state" name="state" required
                                                   placeholder="Ciudad de México"
                                                   class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div>
                                        <label class="block text-textMuted text-sm font-medium mb-2">
                                            Dirección *
                                        </label>
                                        <input type="text" id="address" name="address" required
                                               placeholder="Av. Insurgentes Sur 1234, Col. Del Valle"
                                               class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                    </div>

                                    <div class="grid md:grid-cols-2 gap-6">
                                        <!-- City -->
                                        <div>
                                            <label class="block text-textMuted text-sm font-medium mb-2">
                                                Ciudad *
                                            </label>
                                            <input type="text" id="city" name="city" required
                                                   placeholder="Ciudad de México"
                                                   class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                        </div>

                                        <!-- Postal Code -->
                                        <div>
                                            <label class="block text-textMuted text-sm font-medium mb-2">
                                                Código Postal *
                                            </label>
                                            <input type="text" id="postalCode" name="postal_code" required
                                                   placeholder="03100"
                                                   class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent backdrop-blur-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Privacy -->
                            <div class="bg-gradient-to-br from-warning/20 to-warning/5 border border-warning/30 rounded-xl p-4">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" id="agreeTerms" name="agree_terms" required
                                           class="mt-1 text-accent focus:ring-accent">
                                    <div class="text-sm text-textMuted">
                                        Acepto los <a href="#" class="text-accent hover:underline">Términos de Servicio</a> 
                                        y la <a href="#" class="text-accent hover:underline">Política de Privacidad</a> 
                                        de FestiSpot. Autorizo el cargo recurrente según el plan seleccionado.
                                    </div>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" id="submitPayment"
                                    class="w-full px-8 py-4 bg-gradient-to-r from-accent to-secondary text-white rounded-xl font-bold hover:from-secondary hover:to-accent transition-all duration-300 shadow-2xl hover:shadow-accent/40 text-lg transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span id="submitText">🔒 Procesar Pago Seguro</span>
                                <span id="loadingText" class="hidden">⏳ Procesando...</span>
                            </button>
                        </form>
                    </div>

                    <!-- Order Summary -->
                    <div class="order-1 lg:order-2">
                        <div class="bg-gradient-to-br from-card/80 to-cardLight/60 backdrop-blur-xl rounded-2xl shadow-2xl border border-cardLight/30 p-8 sticky top-8">
                            <h2 class="text-3xl font-bold text-text mb-8 bg-gradient-to-r from-accent to-secondary bg-clip-text text-transparent">
                                📋 Resumen del Pedido
                            </h2>
                            
                            <div id="orderSummary">
                                <div class="text-center py-8">
                                    <div class="text-4xl mb-4">⚠️</div>
                                    <p class="text-textMuted">No se ha seleccionado ningún plan.</p>
                                    <a href="/subscription/plans" class="inline-block mt-4 px-6 py-2 bg-accent text-white rounded-lg hover:bg-secondary transition-colors">
                                        Seleccionar Plan
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Security Info -->
                            <div class="mt-8 pt-6 border-t border-cardLight/30">
                                <div class="flex items-center justify-center gap-4 text-success text-sm">
                                    <span class="text-lg">🔒</span>
                                    <span>Pago 100% seguro con SSL</span>
                                </div>
                                <div class="flex items-center justify-center gap-4 mt-2 text-textMuted text-sm">
                                    <span>💳 Visa</span>
                                    <span>💳 Mastercard</span>
                                    <span>💳 AMEX</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedPlan = null;

        document.addEventListener('DOMContentLoaded', function() {
            loadOrderSummary();
            setupFormValidation();
            setupCardFormatting();
        });

        function loadOrderSummary() {
            const planData = localStorage.getItem('selectedPlan');
            if (!planData) {
                return;
            }

            selectedPlan = JSON.parse(planData);
            const orderSummaryDiv = document.getElementById('orderSummary');
            
            const discount = selectedPlan.billing === 'annual' ? 'Descuento 20%' : '';
            const nextBilling = selectedPlan.billing === 'monthly' ? 
                new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toLocaleDateString('es-ES') :
                new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toLocaleDateString('es-ES');

            orderSummaryDiv.innerHTML = `
                <div class="space-y-6">
                    <div class="text-center">
                        <div class="text-4xl mb-3">${selectedPlan.type === 'basic' ? '🎪' : selectedPlan.type === 'pro' ? '🎭' : '🏢'}</div>
                        <h3 class="text-xl font-bold text-text">${selectedPlan.name}</h3>
                        <div class="text-textMuted text-sm mt-1">
                            Facturación ${selectedPlan.billing === 'monthly' ? 'mensual' : 'anual'}
                        </div>
                    </div>
                    
                    <div class="space-y-3 border-t border-cardLight/30 pt-4">
                        <div class="flex justify-between">
                            <span class="text-textMuted">Subtotal:</span>
                            <span class="text-text font-semibold">$${selectedPlan.price.toLocaleString()}</span>
                        </div>
                        ${selectedPlan.billing === 'annual' ? `
                            <div class="flex justify-between text-success">
                                <span>Descuento anual (20%):</span>
                                <span>-$${Math.round(selectedPlan.price * 0.2).toLocaleString()}</span>
                            </div>
                        ` : ''}
                        <div class="flex justify-between">
                            <span class="text-textMuted">IVA (16%):</span>
                            <span class="text-text">$${Math.round(selectedPlan.price * 0.16).toLocaleString()}</span>
                        </div>
                        <div class="border-t border-cardLight/30 pt-3">
                            <div class="flex justify-between text-xl font-bold">
                                <span class="text-text">Total:</span>
                                <span class="text-accent">$${Math.round(selectedPlan.price * 1.16).toLocaleString()}</span>
                            </div>
                            <div class="text-xs text-textMuted mt-1">
                                Próximo cobro: ${nextBilling}
                            </div>
                        </div>
                    </div>
                    
                    ${selectedPlan.billing === 'annual' ? `
                        <div class="bg-success/10 border border-success/30 rounded-lg p-3 text-center">
                            <div class="text-success text-sm font-semibold">
                                🎉 ¡Ahorras $${Math.round(selectedPlan.price * 0.2 * 12).toLocaleString()} al año!
                            </div>
                        </div>
                    ` : ''}
                </div>
            `;
        }

        function setupFormValidation() {
            const form = document.getElementById('paymentForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                processPayment();
            });
        }

        function setupCardFormatting() {
            // Format card number
            document.getElementById('cardNumber').addEventListener('input', function(e) {
                let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
                let formattedValue = value.match(/.{1,4}/g)?.join(' ') || '';
                e.target.value = formattedValue;
            });

            // Format expiry date
            document.getElementById('expiryDate').addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
                e.target.value = value;
            });

            // Format CVV (numbers only)
            document.getElementById('cvv').addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/\D/g, '');
            });
        }

        async function processPayment() {
            const submitBtn = document.getElementById('submitPayment');
            const submitText = document.getElementById('submitText');
            const loadingText = document.getElementById('loadingText');
            
            // Show loading state
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            
            try {
                // Simulate payment processing
                await new Promise(resolve => setTimeout(resolve, 3000));
                
                // Simulate success
                alert('🎉 ¡Pago procesado exitosamente! Tu suscripción está activa.');
                
                // Redirect to dashboard or success page
                window.location.href = '/subscription/success';
                
            } catch (error) {
                alert('❌ Error al procesar el pago. Por favor, verifica tus datos e intenta nuevamente.');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
            }
        }
    </script>
</body>
</html>