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
            <div class="flex items-center gap-4">
                <a href="/subscription/plans" class="text-textMuted hover:text-accent transition-colors">
                    ← Volver a planes
                </a>
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