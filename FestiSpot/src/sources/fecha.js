(function() {
    'use strict';
    
    let elementos = {};
    
    // Ejecutar inmediatamente cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', inicializar);
    } else {
        // Si el DOM ya está cargado, ejecutar inmediatamente
        inicializar();
    }
    
    function inicializar() {
        console.log('=== INICIO FECHA.JS ===');
        console.log('Estado del documento:', document.readyState);

        // Buscar elementos con más detalle
        elementos = {
            horaInicio: document.getElementById('hora-inicio'),
            horaFin: document.getElementById('hora-fin'),
            eventoUnDia: document.getElementById('evento-un-dia'),
            repetirHorario: document.getElementById('repetir-horario')
        };

        // Diagnóstico detallado
        console.log('=== DIAGNÓSTICO DE ELEMENTOS ===');
        console.log('hora-inicio encontrado:', !!elementos.horaInicio);
        console.log('hora-fin encontrado:', !!elementos.horaFin);
        
        if (elementos.horaInicio) {
            console.log('hora-inicio id:', elementos.horaInicio.id);
            console.log('hora-inicio tagName:', elementos.horaInicio.tagName);
            console.log('hora-inicio opciones actuales:', elementos.horaInicio.options.length);
        }
        
        if (elementos.horaFin) {
            console.log('hora-fin id:', elementos.horaFin.id);
            console.log('hora-fin disabled:', elementos.horaFin.disabled);
            console.log('hora-fin opciones actuales:', elementos.horaFin.options.length);
        }

        if (!elementos.horaInicio) {
            console.error('ERROR CRÍTICO: No se encontró #hora-inicio');
            console.log('Todos los selects en la página:', document.querySelectorAll('select'));
            return;
        }
        
        if (!elementos.horaFin) {
            console.error('ERROR CRÍTICO: No se encontró #hora-fin');
            return;
        }

        // Forzar configuración
        try {
            configurarHoras();
            configurarEventListeners();
            console.log('=== CONFIGURACIÓN EXITOSA ===');
        } catch (error) {
            console.error('Error durante configuración:', error);
        }

        console.log('=== FIN FECHA.JS ===');
    }
    
    function generarHoras() {
        const horas = [];
        for (let h = 6; h <= 23; h++) {
            for (let m = 0; m < 60; m += 30) {
                const hora = h.toString().padStart(2, '0');
                const minuto = m.toString().padStart(2, '0');
                horas.push(`${hora}:${minuto}`);
            }
        }
        console.log('Horas generadas:', horas.length, horas.slice(0, 3), '...');
        return horas;
    }
    
    function configurarHoras() {
        console.log('>>> Iniciando configurarHoras()');
        
        const horas = generarHoras();
        console.log('Horas generadas:', horas.length);
        
        try {
            // Forzar limpieza total
            elementos.horaInicio.innerHTML = '';
            console.log('Select hora-inicio limpiado');
            
            // Agregar opción por defecto
            const optionDefault = document.createElement('option');
            optionDefault.value = '';
            optionDefault.textContent = 'Selecciona hora de inicio';
            elementos.horaInicio.appendChild(optionDefault);
            console.log('Opción por defecto agregada');
            
            // Agregar todas las horas
            horas.forEach((hora, index) => {
                const option = document.createElement('option');
                option.value = hora;
                option.textContent = hora;
                elementos.horaInicio.appendChild(option);
                if (index < 3) console.log(`Hora ${index + 1} agregada:`, hora);
            });
            
            console.log('Total opciones en hora-inicio después de llenar:', elementos.horaInicio.options.length);
            
            // Configurar hora-fin
            elementos.horaFin.innerHTML = '';
            elementos.horaFin.appendChild(new Option('Primero selecciona hora de inicio', ''));
            elementos.horaFin.disabled = true;
            
            console.log('>>> configurarHoras() completado exitosamente');
            
        } catch (error) {
            console.error('Error en configurarHoras():', error);
        }
    }
    
    function actualizarHorasFin(horaInicioSeleccionada) {
        console.log('Actualizando horas fin para:', horaInicioSeleccionada);
        
        const todasLasHoras = generarHoras();
        const indiceInicio = todasLasHoras.indexOf(horaInicioSeleccionada);
        
        elementos.horaFin.innerHTML = '';
        elementos.horaFin.appendChild(new Option('Selecciona hora de fin', ''));
        
        if (indiceInicio === -1 || indiceInicio >= todasLasHoras.length - 1) {
            elementos.horaFin.disabled = true;
            elementos.horaFin.appendChild(new Option('No hay horas disponibles', ''));
            console.log('Sin horas disponibles para:', horaInicioSeleccionada);
            return;
        }
        
        const horasDisponibles = todasLasHoras.slice(indiceInicio + 1);
        horasDisponibles.forEach(hora => {
            elementos.horaFin.appendChild(new Option(hora, hora));
        });
        
        elementos.horaFin.disabled = false;
        console.log(`Agregadas ${horasDisponibles.length} horas fin`);
    }
    
    function configurarEventListeners() {
        console.log('Configurando event listeners...');
        
        // Solo checkbox de repetir horario
        if (elementos.repetirHorario) {
            elementos.repetirHorario.addEventListener('change', function() {
                const hiddenRepetir = document.getElementById('repetir_horario_hidden');
                if (hiddenRepetir) {
                    hiddenRepetir.value = this.checked ? '1' : '0';
                }
            });
        }
        
        // Checkbox de evento de un día (solo para deshabilitar repetir horario)
        if (elementos.eventoUnDia) {
            elementos.eventoUnDia.addEventListener('change', function() {
                if (this.checked && elementos.repetirHorario) {
                    elementos.repetirHorario.checked = false;
                    elementos.repetirHorario.disabled = true;
                    const hiddenRepetir = document.getElementById('repetir_horario_hidden');
                    if (hiddenRepetir) hiddenRepetir.value = '0';
                } else if (elementos.repetirHorario) {
                    elementos.repetirHorario.disabled = false;
                }
            });
        }
        
        // Event listeners básicos para horas
        elementos.horaInicio.addEventListener('change', function() {
            console.log('*** HORA INICIO CHANGE:', this.value);
            actualizarHorasFin(this.value);
            elementos.horaFin.value = '';

            const hiddenInicio = document.getElementById('hora_inicio_hidden');
            if (hiddenInicio) hiddenInicio.value = this.value;
        });
        
        elementos.horaFin.addEventListener('change', function() {
            console.log('*** HORA FIN CHANGE:', this.value);
            const hiddenFin = document.getElementById('hora_fin_hidden');
            if (hiddenFin) hiddenFin.value = this.value;
        });
        
        console.log('Event listeners configurados');
    }

    
    function mostrarError(errorId, mensaje) {
        const errorElement = document.getElementById(errorId);
        if (errorElement) {
            errorElement.textContent = mensaje;
            errorElement.style.display = 'block';
        }
    }
    
    function ocultarError(errorId) {
        const errorElement = document.getElementById(errorId);
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }
    
    function actualizarTextoFecha() {
        const textoFecha = document.getElementById('texto-fecha');
        if (textoFecha) {
            if (esEventoUnDia) {
                textoFecha.textContent = `Fecha del evento: ${fechaInicio}`;
            } else {
                textoFecha.textContent = `Fecha de inicio: ${fechaInicio} - Fecha de fin: ${fechaFin}`;
            }
        }
    }
    
    function actualizarTextoFechaUnDia() {
        const textoFecha = document.getElementById('texto-fecha-un-dia');
        if (textoFecha) {
            textoFecha.textContent = `Fecha del evento: ${fechaInicio}`;
        }
    }
})();
