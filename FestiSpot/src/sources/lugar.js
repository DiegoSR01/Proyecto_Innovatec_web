(function() {
    'use strict';
    
    console.log('🚀 INICIO - Script lugar.js cargando...');
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('📄 DOM cargado - Iniciando configuración');
        
        // Obtener elementos principales
        const direccionSection = document.getElementById('direccion-section');
        const enlaceSection = document.getElementById('enlace-section');
        const seccionActiva = document.getElementById('seccion-activa');
        const form = document.querySelector('form');
        
        console.log('🔍 Elementos encontrados:', {
            direccion: direccionSection ? 'SÍ' : 'NO',
            enlace: enlaceSection ? 'SÍ' : 'NO',
            seccion: seccionActiva ? 'SÍ' : 'NO',
            form: form ? 'SÍ' : 'NO'
        });
        
        // Si no encontramos los elementos principales, mostrar un mensaje y continuar
        if (!direccionSection || !enlaceSection) {
            console.warn('⚠️ ADVERTENCIA: No se encontraron las secciones principales');
            return; // Evitar continuar si faltan elementos críticos
        }
        
        // Configurar visibilidad inicial
        direccionSection.style.display = 'none';
        enlaceSection.style.display = 'none';
        console.log('👁️ Secciones configuradas inicialmente');
        
        // Obtener todos los radio buttons de tipo de evento
        const radioButtons = document.querySelectorAll('input[name="tipo_evento"]');
        console.log(`📻 Se encontraron ${radioButtons.length} radio buttons`);
        
        // Agregar event listeners
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    console.log(`🔄 Cambio a: ${this.value}`);
                    mostrarSeccionesSegunTipo(this.value);
                }
            });
        });
        
        // Configurar contadores de caracteres y otras funcionalidades
        setupContadores();
        
        // Configurar validación del formulario
        setupFormulario(form);
        
        // Verificar si hay tipo preseleccionado
        const tipoPreseleccionado = document.querySelector('input[name="tipo_evento"]:checked');
        if (tipoPreseleccionado) {
            console.log(`🔄 Tipo preseleccionado: ${tipoPreseleccionado.value}`);
            mostrarSeccionesSegunTipo(tipoPreseleccionado.value);
        }
        
        console.log('✅ Script configurado completamente');
    });
    
    // Función principal para mostrar/ocultar secciones
    function mostrarSeccionesSegunTipo(tipo) {
        console.log(`🎭 Configurando interfaz para: ${tipo}`);
        
        const direccionSection = document.getElementById('direccion-section');
        const enlaceSection = document.getElementById('enlace-section');
        const seccionActiva = document.getElementById('seccion-activa');
        
        if (!direccionSection || !enlaceSection) return;
        
        // Actualizar mensaje informativo
        if (seccionActiva) {
            actualizarMensajeInformativo(seccionActiva, tipo);
        }
        
        // Aplicar lógica de visibilidad
        switch(tipo) {
            case 'Presencial':
                console.log('🏢 Configurando PRESENCIAL');
                direccionSection.style.display = 'block';
                enlaceSection.style.display = 'none';
                break;
                
            case 'Virtual':
                console.log('💻 Configurando VIRTUAL');
                direccionSection.style.display = 'none';
                enlaceSection.style.display = 'block';
                break;
                
            case 'Híbrido':
                console.log('🌐 Configurando HÍBRIDO');
                direccionSection.style.display = 'block';
                enlaceSection.style.display = 'block';
                break;
                
            default:
                console.log('❓ Tipo no reconocido:', tipo);
        }
    }
    
    function actualizarMensajeInformativo(seccionActiva, tipo) {
        const mensajes = {
            'Presencial': {
                texto: '📍 Evento presencial - Completa la información de ubicación física',
                descripcion: 'Los asistentes irán físicamente al lugar del evento'
            },
            'Virtual': {
                texto: '💻 Evento virtual - Configura el enlace de acceso online',
                descripcion: 'Los asistentes participarán desde cualquier lugar con internet'
            },
            'Híbrido': {
                texto: '🌐 Evento híbrido - Configura tanto la ubicación física como el acceso virtual',
                descripcion: 'Algunos asistentes irán presencialmente y otros participarán virtualmente'
            }
        };
        
        const info = mensajes[tipo];
        if (info) {
            seccionActiva.innerHTML = `
                <div>
                    <div class="font-medium">${info.texto}</div>
                    <div class="text-xs opacity-75 mt-1">${info.descripcion}</div>
                </div>
            `;
        }
    }
    
    function setupContadores() {
        // Contador para detalles
        const detallesTextarea = document.getElementById('input-detalles');
        const charCountDetalles = document.getElementById('char-count-detalles');
        
        if (detallesTextarea && charCountDetalles) {
            detallesTextarea.addEventListener('input', function() {
                const count = Math.min(this.value.length, 200);
                charCountDetalles.textContent = count;
                if (this.value.length > 200) {
                    this.value = this.value.substring(0, 200);
                }
            });
            charCountDetalles.textContent = detallesTextarea.value.length;
        }
        
        // Contador para instrucciones
        const instruccionesTextarea = document.getElementById('input-instrucciones');
        const charCountInstrucciones = document.getElementById('char-count-instrucciones');
        
        if (instruccionesTextarea && charCountInstrucciones) {
            instruccionesTextarea.addEventListener('input', function() {
                const count = Math.min(this.value.length, 150);
                charCountInstrucciones.textContent = count;
                if (this.value.length > 150) {
                    this.value = this.value.substring(0, 150);
                }
            });
            charCountInstrucciones.textContent = instruccionesTextarea.value.length;
        }
        
        // Validación de código postal (solo números)
        const codigoPostalInput = document.getElementById('input-codigo-postal');
        if (codigoPostalInput) {
            codigoPostalInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }
        
        // Auto-completar ciudad según estado seleccionado
        const estadoSelect = document.getElementById('select-estado');
        const ciudadInput = document.getElementById('input-ciudad');
        
        if (estadoSelect && ciudadInput) {
            estadoSelect.addEventListener('change', function() {
                const ciudades = {
                    'cdmx': 'Ciudad de México',
                    'jalisco': 'Guadalajara',
                    'nuevo-leon': 'Monterrey',
                    'puebla': 'Puebla',
                    'veracruz': 'Veracruz'
                };
                
                if (ciudades[this.value] && !ciudadInput.value.trim()) {
                    ciudadInput.value = ciudades[this.value];
                }
            });
        }
        
        // Checkbox sin número
        const sinNumeroCheckbox = document.getElementById('sin-numero');
        const direccionInput = document.getElementById('input-direccion-completa');
        
        if (sinNumeroCheckbox && direccionInput) {
            sinNumeroCheckbox.addEventListener('change', function() {
                direccionInput.placeholder = this.checked ? 
                    'Ej: Calle sin número, Colonia Centro' : 
                    'Ej: Av. Insurgentes Sur 1457, Col. San José Insurgentes';
            });
        }
    }
    
    function setupFormulario(form) {
        if (!form) {
            console.log('⚠️ No se encontró el formulario');
            return;
        }
        
        form.addEventListener('submit', function(e) {
            console.log('📤 SUBMIT - Validando formulario...');
            
            const tipoSeleccionado = document.querySelector('input[name="tipo_evento"]:checked');
            
            if (!tipoSeleccionado) {
                console.log('❌ No se seleccionó tipo de evento');
                const errorTipo = document.getElementById('error-tipo');
                if (errorTipo) errorTipo.style.display = 'block';
                e.preventDefault();
                return;
            }
            
            const tipo = tipoSeleccionado.value;
            console.log(`✅ Validando para tipo: ${tipo}`);
            
            let esValido = true;
            
            // Validar según el tipo
            if (tipo === 'Presencial' || tipo === 'Híbrido') {
                esValido = validarCamposFisicos() && esValido;
            }
            
            if (tipo === 'Virtual' || tipo === 'Híbrido') {
                esValido = validarCamposVirtuales() && esValido;
            }
            
            if (!esValido) {
                console.log('❌ Validación fallida');
                e.preventDefault();
            } else {
                console.log('✅ Formulario válido - enviando...');
                
                // Deshabilitar el botón para evitar doble envío
                const btnSiguiente = document.getElementById('btn-siguiente');
                if (btnSiguiente) {
                    btnSiguiente.disabled = true;
                    btnSiguiente.innerHTML = '<span class="truncate">Procesando...</span>';
                }
            }
        });
    }
    
    function validarCamposFisicos() {
        let valido = true;
        const campos = {
            nombre: document.getElementById('input-nombre-lugar'),
            direccion: document.getElementById('input-direccion-completa'),
            ciudad: document.getElementById('input-ciudad'),
            estado: document.getElementById('select-estado')
        };
        
        if (!campos.nombre?.value.trim()) {
            alert('❌ El nombre del lugar es obligatorio');
            valido = false;
        } else if (!campos.direccion?.value.trim()) {
            alert('❌ La dirección es obligatoria');
            valido = false;
        } else if (!campos.ciudad?.value.trim()) {
            alert('❌ La ciudad es obligatoria');
            valido = false;
        } else if (!campos.estado?.value) {
            alert('❌ Selecciona un estado');
            valido = false;
        }
        
        return valido;
    }
    
    function validarCamposVirtuales() {
        const enlace = document.getElementById('input-evento-enlace');
        
        if (!enlace?.value.trim()) {
            alert('❌ El enlace es obligatorio para eventos virtuales');
            return false;
        }
        
        if (!enlace.value.match(/^https?:\/\/.+/)) {
            alert('❌ El enlace debe ser una URL válida (http:// o https://)');
            return false;
        }
        
        return true;
    }
})();
