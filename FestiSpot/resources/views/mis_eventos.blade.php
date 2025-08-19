@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-background text-text px-4 py-8 relative">
    <!-- Efectos de fondo -->
    <div class="fixed inset-0 opacity-10 pointer-events-none z-0">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="relative z-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <h1 class="text-3xl font-black bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent drop-shadow-lg">Mis Eventos</h1>
            <a href="/event/create" class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-accent to-secondary text-white rounded-xl font-bold text-lg shadow-lg hover:from-secondary hover:to-accent transition-all duration-300 transform hover:scale-105 hover:shadow-accent/50"><i class="fa-solid fa-plus"></i> Nuevo Evento</a>
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
                <option value="">Estado</option>
                <option>Activo</option>
                <option>Finalizado</option>
            </select>
            <button type="submit" class="ml-auto px-6 py-2 bg-accent text-white rounded-lg font-bold hover:bg-secondary transition-all"><i class="fa-solid fa-filter"></i> Filtrar</button>
            <button type="button" id="btn-borrar-filtros" class="px-6 py-2 bg-warning text-white rounded-lg font-bold hover:bg-accent transition-all"><i class="fa-solid fa-xmark"></i> Borrar filtros</button>
        </form>

        <!-- Lista de eventos (grid de tarjetas) -->
    <div id="eventos-lista" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Evento 1 -->
            <div class="bg-card rounded-2xl shadow-lg border border-cardLight/30 flex flex-col" data-fecha="2025-08-22">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Evento" class="rounded-t-2xl h-40 w-full object-cover">
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-3 py-1 bg-accent/20 text-accent rounded-full text-xs font-bold">Festival</span>
                        <span class="px-3 py-1 bg-success/20 text-success rounded-full text-xs font-bold">Activo</span>
                    </div>
                    <h2 class="text-xl font-bold mb-1">Festival Jazz</h2>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-calendar-days mr-1"></i> 22/08/2025</div>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-location-dot mr-1"></i> Auditorio Nacional</div>
                    <div class="flex items-center gap-2 mt-auto">
                        <span class="text-info"><i class="fa-solid fa-users"></i></span>
                        <span class="font-semibold">120 asistentes</span>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <a href="#" class="px-3 py-1 bg-info/20 text-info rounded-lg text-sm font-bold hover:bg-info/40 transition-all"><i class="fa-solid fa-pen"></i> Editar</a>
                        <a href="#" class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-bold hover:bg-accent/40 transition-all"><i class="fa-solid fa-trash"></i> Eliminar</a>
                        <a href="#" class="px-3 py-1 bg-secondary/20 text-secondary rounded-lg text-sm font-bold hover:bg-secondary/40 transition-all"><i class="fa-solid fa-chart-line"></i> Estadísticas</a>
                    </div>
                </div>
            </div>
            <!-- Evento 2 -->
            <div class="bg-card rounded-2xl shadow-lg border border-cardLight/30 flex flex-col" data-fecha="2025-09-05">
                <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80" alt="Evento" class="rounded-t-2xl h-40 w-full object-cover">
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-3 py-1 bg-tertiary/20 text-tertiary rounded-full text-xs font-bold">Conferencia</span>
                        <span class="px-3 py-1 bg-warning/20 text-warning rounded-full text-xs font-bold">Finalizado</span>
                    </div>
                    <h2 class="text-xl font-bold mb-1">Tech Summit</h2>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-calendar-days mr-1"></i> 05/09/2025</div>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-location-dot mr-1"></i> Centro de Convenciones</div>
                    <div class="flex items-center gap-2 mt-auto">
                        <span class="text-info"><i class="fa-solid fa-users"></i></span>
                        <span class="font-semibold">80 asistentes</span>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <a href="#" class="px-3 py-1 bg-info/20 text-info rounded-lg text-sm font-bold hover:bg-info/40 transition-all"><i class="fa-solid fa-pen"></i> Editar</a>
                        <a href="#" class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-bold hover:bg-accent/40 transition-all"><i class="fa-solid fa-trash"></i> Eliminar</a>
                        <a href="#" class="px-3 py-1 bg-secondary/20 text-secondary rounded-lg text-sm font-bold hover:bg-secondary/40 transition-all"><i class="fa-solid fa-chart-line"></i> Estadísticas</a>
                    </div>
                </div>
            </div>
            <!-- Evento 3 -->
            <div class="bg-card rounded-2xl shadow-lg border border-cardLight/30 flex flex-col" data-fecha="2025-09-15">
                <img src="https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=600&q=80" alt="Evento" class="rounded-t-2xl h-40 w-full object-cover">
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-3 py-1 bg-secondary/20 text-secondary rounded-full text-xs font-bold">Cultural</span>
                        <span class="px-3 py-1 bg-success/20 text-success rounded-full text-xs font-bold">Activo</span>
                    </div>
                    <h2 class="text-xl font-bold mb-1">Expo Cultura</h2>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-calendar-days mr-1"></i> 15/09/2025</div>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-location-dot mr-1"></i> Museo de Arte</div>
                    <div class="flex items-center gap-2 mt-auto">
                        <span class="text-info"><i class="fa-solid fa-users"></i></span>
                        <span class="font-semibold">60 asistentes</span>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <a href="#" class="px-3 py-1 bg-info/20 text-info rounded-lg text-sm font-bold hover:bg-info/40 transition-all"><i class="fa-solid fa-pen"></i> Editar</a>
                        <a href="#" class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-bold hover:bg-accent/40 transition-all"><i class="fa-solid fa-trash"></i> Eliminar</a>
                        <a href="#" class="px-3 py-1 bg-secondary/20 text-secondary rounded-lg text-sm font-bold hover:bg-secondary/40 transition-all"><i class="fa-solid fa-chart-line"></i> Estadísticas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Estilos para el calendario -->
<style>
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
</style>
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

    // Mostrar todos los eventos si no hay fecha seleccionada
    document.addEventListener('DOMContentLoaded', function() {
        filtrarEventosPorFecha(null);
        // Botón borrar filtros
        document.getElementById('btn-borrar-filtros').addEventListener('click', function() {
            selectedDate = null;
            filtrarEventosPorFecha(null);
            updateCalendar();
        });
    });
</script>
@endsection
