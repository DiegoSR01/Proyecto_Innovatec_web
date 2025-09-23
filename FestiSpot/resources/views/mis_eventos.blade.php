@extends('layouts.app')
@section('content')
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
    .date-selected {
        background: linear-gradient(135deg, #ff4081 0%, #00e5ff 100%) !important;
        color: white !important;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(255, 64, 129, 0.4);
        transform: scale(1.05);
    }
    .date-disabled {
        color: #6b7280 !important;
        cursor: not-allowed !important;
        opacity: 0.3;
    }
    .evento-card {
        box-shadow: 0 2px 16px 0 rgba(124,77,255,0.10), 0 1.5px 8px 0 rgba(255,64,129,0.10);
        border: 2px solid transparent;
        will-change: transform, box-shadow, border-color;
    }
    .evento-card:hover {
        transform: scale(1.04) translateY(-4px);
        border-color: #ff4081;
        box-shadow: 0 0 0 4px #ff408155, 0 8px 32px 0 #00e5ff33, 0 2px 16px 0 #7c4dff22;
        z-index: 10;
    }
</style>
<div class="bg-background text-text relative min-h-screen">
    <!-- Efectos de fondo -->
    <div class="fixed inset-0 opacity-10 pointer-events-none z-0">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <!-- Encabezado exactamente igual al de crear evento -->
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
                <a href="/mis-eventos" class="nav-link active">Mis eventos</a>
                <a href="/solicitudes-productores" class="nav-link">Productores</a>
            </nav>
            

        </div>
    </header>

    <div class="relative z-10 px-8 md:px-20 lg:px-40 pr-8 md:pr-20 lg:pr-24 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <h1 class="text-3xl font-black bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent drop-shadow-lg">Mis Eventos</h1>
            <a href="#" onclick="crearNuevoEventoMisEventos(event)" id="btn-nuevo-evento-mis-eventos" class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-secondary to-info text-white rounded-xl font-bold text-lg shadow-lg hover:from-info hover:to-secondary transition-all duration-300 transform hover:scale-105 hover:shadow-secondary/50"><i class="fa-solid fa-plus"></i> Nuevo Evento</a>
        </div>

        <!-- Calendario visual -->
        <div class="mb-10 max-w-3xl mx-auto">
            <div class="bg-gradient-to-br from-card/60 to-cardLight/40 backdrop-blur-xl rounded-3xl p-8 border border-cardLight/30 shadow-2xl">
                <div class="flex items-center justify-between mb-4">
                    <button id="prev-month" class="text-accent hover:text-secondary text-xl font-bold px-3 py-1 rounded transition-all">&lt;</button>
                    <div id="month-header" class="text-2xl font-bold text-center bg-gradient-to-r from-accent via-secondary to-warning bg-clip-text text-transparent"></div>
                    <button id="next-month" class="text-accent hover:text-secondary text-xl font-bold px-3 py-1 rounded transition-all">&gt;</button>
                </div>
                <div class="grid grid-cols-7 gap-2 text-center mb-2">
                    <div class="text-textMuted font-bold">Lun</div>
                    <div class="text-textMuted font-bold">Mar</div>
                    <div class="text-textMuted font-bold">Mié</div>
                    <div class="text-textMuted font-bold">Jue</div>
                    <div class="text-textMuted font-bold">Vie</div>
                    <div class="text-textMuted font-bold">Sáb</div>
                    <div class="text-textMuted font-bold">Dom</div>
                </div>
                <div id="calendar-days" class="grid grid-cols-7 gap-2"></div>
            </div>
        </div>

        <!-- Filtros -->
        <form id="filtros-form" class="flex flex-wrap gap-4 mb-8 bg-cardLight/80 p-4 rounded-xl shadow border border-card/30">
            <input type="date" class="bg-card px-4 py-2 rounded-lg text-text border border-cardLight/30 focus:border-accent focus:ring-2 focus:ring-accent/20" placeholder="Fecha" />
            <select class="bg-card px-4 py-2 rounded-lg text-text border border-cardLight/30 focus:border-accent focus:ring-2 focus:ring-accent/20">
                <option value="">Categoría</option>
                <option>Festival</option>
                <option>Conferencia</option>
                <option>Deportivo</option>
                <option>Cultural</option>
            </select>
            <select class="bg-card px-4 py-2 rounded-lg text-text border border-cardLight/30 focus:border-accent focus:ring-2 focus:ring-accent/20">
                <option value="">Estatus</option>
                <option>Activo</option>
                <option>Finalizado</option>
            </select>
            <button type="submit" class="ml-auto px-6 py-2 border-2 border-[#00e5ff] text-[#00e5ff] bg-transparent rounded-lg font-bold transition-all hover:bg-[#00e5ff] hover:text-white"><i class="fa-solid fa-filter"></i> Filtrar</button>
            <button type="button" id="btn-borrar-filtros" class="px-6 py-2 border-2 border-[#ff4081] text-[#ff4081] bg-transparent rounded-lg font-bold transition-all hover:bg-[#ff4081] hover:text-white"><i class="fa-solid fa-xmark"></i> Borrar filtros</button>
        </form>

        <!-- Lista de eventos (grid de tarjetas) -->
        <div id="eventos-lista" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($events as $event)
                <!-- Evento ID: {{ $event->id }} -->
                <div class="evento-card bg-card rounded-2xl shadow-lg border border-cardLight/30 flex flex-col transition-all duration-300" 
                     data-evento-id="{{ $event->id }}" 
                     data-fecha="{{ \Carbon\Carbon::parse($event->fecha_inicio)->format('Y-m-d') }}">
                    
                    @if($event->banner_image)
                        <img src="{{ asset('storage/events/banners/' . $event->banner_image) }}" 
                             alt="{{ $event->titulo ?? $event->name }}" 
                             class="rounded-t-2xl h-40 w-full object-cover">
                    @else
                        <div class="rounded-t-2xl h-40 w-full bg-gradient-to-br from-card to-cardLight flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-4xl text-textMuted"></i>
                        </div>
                    @endif
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-3 py-1 bg-accent/20 text-accent rounded-full text-xs font-bold">
                                {{ $event->category ?? $event->categoria->nombre ?? 'General' }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                @if($event->estado === 'publicado' || $event->status === 'published') bg-success/20 text-success 
                                @elseif($event->estado === 'borrador' || $event->status === 'draft') bg-warning/20 text-warning
                                @elseif($event->estado === 'cancelado' || $event->status === 'cancelled') bg-error/20 text-error
                                @elseif($event->estado === 'finalizado' || $event->status === 'completed') bg-info/20 text-info
                                @else bg-red-500/20 text-red-400 @endif">
                                @if($event->estado === 'publicado' || $event->status === 'published') Activo
                                @elseif($event->estado === 'borrador' || $event->status === 'draft') Borrador
                                @elseif($event->estado === 'finalizado' || $event->status === 'completed') Finalizado
                                @else Cancelado
                                @endif
                            </span>
                        </div>
                        
                        <h2 class="text-xl font-bold mb-1">{{ $event->titulo ?? $event->name }}</h2>
                        
                        <div class="text-textMuted text-sm mb-2">
                            <i class="fa-solid fa-calendar-days mr-1"></i> 
                            {{ \Carbon\Carbon::parse($event->fecha_inicio)->format('d/m/Y') }}
                            @if($event->fecha_fin && \Carbon\Carbon::parse($event->fecha_fin)->format('Y-m-d') != \Carbon\Carbon::parse($event->fecha_inicio)->format('Y-m-d'))
                                - {{ \Carbon\Carbon::parse($event->fecha_fin)->format('d/m/Y') }}
                            @endif
                        </div>
                        
                        <div class="text-textMuted text-sm mb-2">
                            <i class="fa-solid fa-location-dot mr-1"></i> 
                            @if($event->event_type === 'Virtual')
                                Virtual
                            @elseif($event->event_type === 'Híbrido')
                                {{ $event->venue_name ?? 'Híbrido' }} / Virtual
                            @else
                                {{ $event->venue_name ?? $event->city ?? 'Por definir' }}
                            @endif
                        </div>
                        
                        <div class="text-textMuted text-sm mb-4">
                            <i class="fa-solid fa-clock mr-1"></i> 
                            {{ \Carbon\Carbon::parse($event->fecha_inicio)->format('H:i') }}
                            @if($event->fecha_fin)
                                - {{ \Carbon\Carbon::parse($event->fecha_fin)->format('H:i') }}
                            @endif
                        </div>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <div class="flex items-center gap-2">
                                <span class="text-info"><i class="fa-solid fa-users"></i></span>
                                <span class="font-semibold">{{ $event->capacidad_total ?? $event->capacity ?? 'Sin límite' }}</span>
                            </div>
                            
                            <div class="flex gap-2">
                                <button onclick="editarEvento({{ $event->id }})" 
                                        class="p-2 bg-info/20 text-info rounded-lg hover:bg-info hover:text-white transition-all"
                                        title="Editar evento">
                                    <i class="fa-solid fa-edit text-sm"></i>
                                </button>
                                <button onclick="eliminarEvento({{ $event->id }})" 
                                        class="p-2 bg-error/20 text-error rounded-lg hover:bg-error hover:text-white transition-all"
                                        title="Eliminar evento">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Mensaje cuando no hay eventos -->
                <div class="col-span-full text-center py-16">
                    <div class="bg-card/60 backdrop-blur-xl rounded-3xl p-12 border border-cardLight/30 max-w-lg mx-auto">
                        <i class="fas fa-calendar-plus text-6xl text-textMuted mb-6"></i>
                        <h3 class="text-2xl font-bold mb-4">¡Aún no tienes eventos!</h3>
                        <p class="text-textMuted mb-6">Crea tu primer evento y comienza a organizar experiencias increíbles.</p>
                        <a href="{{ route('event.create') }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-secondary to-info text-white rounded-xl font-bold text-lg shadow-lg hover:from-info hover:to-secondary transition-all duration-300 transform hover:scale-105">
                            <i class="fa-solid fa-plus"></i> Crear mi primer evento
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    // Calendario visual para mis eventos
    let calendarDate = new Date();
    let selectedDate = null;
    const monthNames = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    document.addEventListener('DOMContentLoaded', function() {
        updateCalendar();
        document.getElementById('prev-month').addEventListener('click', function() {
            calendarDate.setMonth(calendarDate.getMonth() - 1);
            updateCalendar();
        });
        document.getElementById('next-month').addEventListener('click', function() {
            calendarDate.setMonth(calendarDate.getMonth() + 1);
            updateCalendar();
        });
        
        // Botón borrar filtros
        document.getElementById('btn-borrar-filtros').addEventListener('click', function() {
            selectedDate = null;
            filtrarEventosPorFecha(null);
            updateCalendar();
        });
    });

    function updateCalendar() {
        const monthHeader = document.getElementById('month-header');
        const calendarDays = document.getElementById('calendar-days');
        monthHeader.textContent = `${monthNames[calendarDate.getMonth()]} ${calendarDate.getFullYear()}`;
        calendarDays.innerHTML = '';

        const firstDay = new Date(calendarDate.getFullYear(), calendarDate.getMonth(), 1);
        const lastDay = new Date(calendarDate.getFullYear(), calendarDate.getMonth() + 1, 0);
        let startDay = firstDay.getDay();
        // Ajustar para que lunes sea el primer día
        startDay = (startDay === 0) ? 6 : startDay - 1;

        const today = new Date();
        today.setHours(0, 0, 0, 0);

        // Días vacíos al inicio
        for (let i = 0; i < startDay; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.className = 'h-10';
            calendarDays.appendChild(emptyDay);
        }

        // Días del mes
        for (let day = 1; day <= lastDay.getDate(); day++) {
            const dayElement = document.createElement('div');
            const currentDate = new Date(calendarDate.getFullYear(), calendarDate.getMonth(), day);
            const dateString = currentDate.toISOString().split('T')[0];

            dayElement.className = 'h-10 flex items-center justify-center text-sm rounded cursor-pointer transition-colors';
            dayElement.textContent = day;

            if (currentDate < today) {
                dayElement.className += ' date-disabled';
            } else {
                dayElement.className += ' text-text hover:bg-accent hover:text-white';
                if (selectedDate === dateString) {
                    dayElement.className += ' date-selected';
                }
                dayElement.addEventListener('click', () => selectDate(dateString, dayElement));
            }
            calendarDays.appendChild(dayElement);
        }
    }

    function selectDate(dateString, el) {
        selectedDate = dateString;
        updateCalendar();
        filtrarEventosPorFecha(dateString);
    }

    function filtrarEventosPorFecha(fecha) {
        const eventos = document.querySelectorAll('#eventos-lista > div[data-fecha]');
        let count = 0;
        if (!fecha) {
            eventos.forEach(ev => { ev.style.display = ''; count++; });
            mostrarMensajeSinEventos(false);
            return;
        }
        eventos.forEach(ev => {
            if (ev.getAttribute('data-fecha') === fecha) {
                ev.style.display = '';
                count++;
            } else {
                ev.style.display = 'none';
            }
        });
        mostrarMensajeSinEventos(count === 0);
    }

    function mostrarMensajeSinEventos(show) {
        let msg = document.getElementById('sin-eventos-msg');
        if (!msg) {
            msg = document.createElement('div');
            msg.id = 'sin-eventos-msg';
            msg.className = 'col-span-full text-center py-12 text-xl font-bold text-textMuted animate-fade-in';
            msg.innerHTML = '😕 No hay eventos para la fecha seleccionada.';
            document.getElementById('eventos-lista').appendChild(msg);
        }
        msg.style.display = show ? '' : 'none';
    }

    // Función para crear nuevo evento desde mis eventos
    function crearNuevoEventoMisEventos(event) {
        event.preventDefault();
        
        const btn = document.getElementById('btn-nuevo-evento-mis-eventos');
        const originalText = btn.innerHTML;
        
        // Mostrar estado de carga
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Preparando...';
        btn.disabled = true;
        
        // Obtener token CSRF
        const token = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = token ? token.getAttribute('content') : '{{ csrf_token() }}';
        
        // Limpiar datos del servidor antes de redirigir
        fetch('/event/clear-all', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken
            },
            body: JSON.stringify({})
        })
        .then(response => {
            console.log('✅ Datos limpiados del servidor desde mis eventos');
            // Redirigir después de limpiar
            window.location.href = '/event/create';
        })
        .catch(error => {
            console.error('❌ Error al limpiar datos del servidor:', error);
            // Redirigir de todas formas aunque falle la limpieza
            console.log('🔄 Redirigiendo de todas formas...');
            window.location.href = '/event/create';
        })
        .finally(() => {
            // Restaurar botón después de un tiempo por si no se redirige
            setTimeout(() => {
                if (btn) {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            }, 3000);
        });
    }

    // Función para eliminar evento
    function eliminarEvento(eventoId) {
        if (confirm('¿Estás seguro de que quieres eliminar este evento? Esta acción no se puede deshacer.')) {
            const token = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = token ? token.getAttribute('content') : '{{ csrf_token() }}';
            
            fetch(`/event/${eventoId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✅ Evento eliminado exitosamente');
                    // Recargar la página para mostrar los cambios
                    window.location.reload();
                } else {
                    alert('❌ Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error al eliminar evento:', error);
                alert('❌ Error al eliminar el evento. Por favor intenta de nuevo.');
            });
        }
    }

    // Función para editar evento (redirige al formulario de edición)
    function editarEvento(eventoId) {
        // Por ahora redirigir a una página de edición simple
        // Más adelante se puede implementar un modal de edición completo
        alert('Funcionalidad de edición en desarrollo. Evento ID: ' + eventoId);
        // window.location.href = `/event/${eventoId}/edit`;
    }
</script>
@endsection
