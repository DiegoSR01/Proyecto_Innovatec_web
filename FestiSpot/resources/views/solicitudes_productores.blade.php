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
                <div style="width: 28px; height: 28px; color: #ff4081;">
                    <svg viewBox="0 0 48 48" fill="currentColor">
                        <path d="M39.475 21.6262C40.358 21.4363 40.6863 21.5589 40.7581 21.5934C40.7876 21.655 40.8547 21.857 40.8082 22.3336C40.7408 23.0255 40.4502 24.0046 39.8572 25.2301C38.6799 27.6631 36.5085 30.6631 33.5858 33.5858C30.6631 36.5085 27.6632 38.6799 25.2301 39.8572C24.0046 40.4502 23.0255 40.7407 22.3336 40.8082C21.8571 40.8547 21.6551 40.7875 21.5934 40.7581C21.5589 40.6863 21.4363 40.358 21.6262 39.475C21.8562 38.4054 22.4689 36.9657 23.5038 35.2817C24.7575 33.2417 26.5497 30.9744 28.7621 28.762C30.9744 26.5497 33.2417 24.7574 35.2817 23.5037C36.9657 22.4689 38.4054 21.8562 39.475 21.6262ZM4.41189 29.2403L18.7597 43.5881C19.8813 44.7097 21.4027 44.9179 22.7217 44.7893C24.0585 44.659 25.5148 44.1631 26.9723 43.4579C29.9052 42.0387 33.2618 39.5667 36.4142 36.4142C39.5667 33.2618 42.0387 29.9052 43.4579 26.9723C44.1631 25.5148 44.659 24.0585 44.7893 22.7217C44.9179 21.4027 44.7097 19.8813 43.5881 18.7597L29.2403 4.41187C27.8527 3.02428 25.8765 3.02573 24.2861 3.36776C22.6081 3.72863 20.7334 4.58419 18.8396 5.74801C16.4978 7.18716 13.9881 9.18353 11.5858 11.5858C9.18354 13.988 7.18717 16.4978 5.74802 18.8396C4.58421 20.7334 3.72865 22.6081 3.36778 24.2861C3.02574 25.8765 3.02429 27.8527 4.41189 29.2403Z"></path>
                    </svg>
                </div>
                <h1 style="font-size: 22px; font-weight: 700; background: linear-gradient(135deg, #ff4081, #00e5ff, #7c4dff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.5px;">FestiSpot</h1>
            </div>
            
            <!-- Navigation central -->
            <nav style="display: flex; gap: 8px;">
                <a href="/" class="nav-link">Inicio</a>
                <a href="/mis-eventos" class="nav-link">Mis eventos</a>
                <a href="/solicitudes-productores" class="nav-link active">Productores</a>
            </nav>
            
            <!-- User avatar minimalista -->
            <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #ff4081, #00e5ff); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px; box-shadow: 0 4px 12px rgba(255, 64, 129, 0.3);">
                U
            </div>
        </div>
    </header>

    <div class="relative z-10 px-8 md:px-20 lg:px-40 py-8">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
                <h1 class="text-3xl font-black bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent drop-shadow-lg">Solicitudes de Productores</h1>
                <form class="flex gap-2 w-full md:w-auto">
                    <input type="text" placeholder="Buscar productor, producto..." class="bg-card px-4 py-2 rounded-lg text-text border border-cardLight/30 focus:border-accent focus:ring-2 focus:ring-accent/20 w-full md:w-64" />
                    <select class="bg-card px-4 py-2 rounded-lg text-text border border-cardLight/30 focus:border-accent focus:ring-2 focus:ring-accent/20">
                        <option value="">Evento</option>
                        <option>Festival Jazz</option>
                        <option>Tech Summit</option>
                        <option>Expo Cultura</option>
                    </select>
                    <select class="bg-card px-4 py-2 rounded-lg text-text border border-cardLight/30 focus:border-accent focus:ring-2 focus:ring-accent/20">
                        <option value="">Estado</option>
                        <option>Pendiente</option>
                        <option>Aceptada</option>
                        <option>Rechazada</option>
                    </select>
                    <button type="submit" class="px-6 py-2 border-2 border-[#00e5ff] text-[#00e5ff] bg-transparent rounded-lg font-bold transition-all hover:bg-[#00e5ff] hover:text-white"><i class="fa-solid fa-filter"></i> Filtrar</button>
                    <button type="button" id="btn-borrar-filtros" class="px-6 py-2 border-2 border-[#ff4081] text-[#ff4081] bg-transparent rounded-lg font-bold transition-all hover:bg-[#ff4081] hover:text-white"><i class="fa-solid fa-xmark"></i></button>
                </form>
            </div>
            <!-- Lista de solicitudes -->
            <div id="solicitudes-lista" class="space-y-6">
                <!-- Solicitud 1 -->
                <div class="solicitud bg-card rounded-2xl shadow-lg border border-cardLight/30 flex flex-col md:flex-row items-center gap-6 p-6"
                    data-productor="Juan Pérez" data-producto="Cerveza Artesanal" data-evento="Festival Jazz" data-estado="Pendiente">
                    <div class="flex-1 flex flex-col md:flex-row md:items-center gap-4">
                        <div>
                            <div class="text-lg font-bold">Juan Pérez</div>
                            <div class="text-textMuted text-sm">Productor</div>
                        </div>
                        <div class="text-base font-semibold">Cerveza Artesanal</div>
                        <div class="text-textMuted text-sm"><i class="fa-solid fa-calendar-days mr-1"></i> Festival Jazz</div>
                        <div class="text-textMuted text-sm"><i class="fa-solid fa-clock mr-1"></i> 18/08/2025</div>
                        <div>
                            <span class="estado px-3 py-1 bg-warning/20 text-warning rounded-full text-xs font-bold">Pendiente</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4 md:mt-0">
                        <button class="btn-aceptar px-4 py-2 border-2 border-[#00e676] text-[#00e676] bg-transparent rounded-lg font-bold transition-all hover:bg-[#00e676] hover:text-white"><i class="fa-solid fa-check"></i> Aceptar</button>
                        <button class="btn-rechazar px-4 py-2 border-2 border-[#ff4081] text-[#ff4081] bg-transparent rounded-lg font-bold transition-all hover:bg-[#ff4081] hover:text-white"><i class="fa-solid fa-xmark"></i> Rechazar</button>
                    </div>
                </div>
                <!-- Solicitud 2 -->
                <div class="solicitud bg-card rounded-2xl shadow-lg border border-cardLight/30 flex flex-col md:flex-row items-center gap-6 p-6"
                    data-productor="María López" data-producto="Comida Vegana" data-evento="Tech Summit" data-estado="Pendiente">
                    <div class="flex-1 flex flex-col md:flex-row md:items-center gap-4">
                        <div>
                            <div class="text-lg font-bold">María López</div>
                            <div class="text-textMuted text-sm">Productora</div>
                        </div>
                        <div class="text-base font-semibold">Comida Vegana</div>
                        <div class="text-textMuted text-sm"><i class="fa-solid fa-calendar-days mr-1"></i> Tech Summit</div>
                        <div class="text-textMuted text-sm"><i class="fa-solid fa-clock mr-1"></i> 17/08/2025</div>
                        <div>
                            <span class="estado px-3 py-1 bg-warning/20 text-warning rounded-full text-xs font-bold">Pendiente</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4 md:mt-0">
                        <button class="btn-aceptar px-4 py-2 border-2 border-[#00e676] text-[#00e676] bg-transparent rounded-lg font-bold transition-all hover:bg-[#00e676] hover:text-white"><i class="fa-solid fa-check"></i> Aceptar</button>
                        <button class="btn-rechazar px-4 py-2 border-2 border-[#ff4081] text-[#ff4081] bg-transparent rounded-lg font-bold transition-all hover:bg-[#ff4081] hover:text-white"><i class="fa-solid fa-xmark"></i> Rechazar</button>
                    </div>
                </div>
                <!-- Solicitud 3 -->
                <div class="solicitud bg-card rounded-2xl shadow-lg border border-cardLight/30 flex flex-col md:flex-row items-center gap-6 p-6"
                    data-productor="Carlos Ruiz" data-producto="Sonido e Iluminación" data-evento="Expo Cultura" data-estado="Pendiente">
                    <div class="flex-1 flex flex-col md:flex-row md:items-center gap-4">
                        <div>
                            <div class="text-lg font-bold">Carlos Ruiz</div>
                            <div class="text-textMuted text-sm">Productor</div>
                        </div>
                        <div class="text-base font-semibold">Sonido e Iluminación</div>
                        <div class="text-textMuted text-sm"><i class="fa-solid fa-calendar-days mr-1"></i> Expo Cultura</div>
                        <div class="text-textMuted text-sm"><i class="fa-solid fa-clock mr-1"></i> 16/08/2025</div>
                        <div>
                            <span class="estado px-3 py-1 bg-warning/20 text-warning rounded-full text-xs font-bold">Pendiente</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4 md:mt-0">
                        <button class="btn-aceptar px-4 py-2 border-2 border-[#00e676] text-[#00e676] bg-transparent rounded-lg font-bold transition-all hover:bg-[#00e676] hover:text-white"><i class="fa-solid fa-check"></i> Aceptar</button>
                        <button class="btn-rechazar px-4 py-2 border-2 border-[#ff4081] text-[#ff4081] bg-transparent rounded-lg font-bold transition-all hover:bg-[#ff4081] hover:text-white"><i class="fa-solid fa-xmark"></i> Rechazar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Funcionalidad completa de solicitudes
document.addEventListener('DOMContentLoaded', function() {
    // Borrar filtros funcional
    document.getElementById('btn-borrar-filtros').addEventListener('click', function() {
        const form = this.closest('form');
        form.querySelectorAll('input, select').forEach(el => el.value = '');
        filtrarSolicitudes();
    });

    // Filtros y búsqueda
    const form = document.querySelector('.flex.gap-2');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        filtrarSolicitudes();
    });
    form.querySelectorAll('input, select').forEach(el => {
        el.addEventListener('change', filtrarSolicitudes);
    });

    function filtrarSolicitudes() {
        const busqueda = form.querySelector('input[type="text"]').value.toLowerCase();
        const evento = form.querySelectorAll('select')[0].value;
        const estado = form.querySelectorAll('select')[1].value;
        document.querySelectorAll('.solicitud').forEach(card => {
            let visible = true;
            if (busqueda && !(
                card.dataset.productor.toLowerCase().includes(busqueda) ||
                card.dataset.producto.toLowerCase().includes(busqueda)
            )) visible = false;
            if (evento && card.dataset.evento !== evento) visible = false;
            if (estado && card.dataset.estado !== estado) visible = false;
            card.style.display = visible ? '' : 'none';
        });
    }

    // Estado de solicitudes (aceptar/rechazar)
    document.querySelectorAll('.solicitud').forEach(card => {
        const btnAceptar = card.querySelector('.btn-aceptar');
        const btnRechazar = card.querySelector('.btn-rechazar');
        const estadoSpan = card.querySelector('.estado');
        btnAceptar.addEventListener('click', function() {
            estadoSpan.textContent = 'Aceptada';
            estadoSpan.className = 'estado px-3 py-1 bg-success/20 text-success rounded-full text-xs font-bold';
            card.dataset.estado = 'Aceptada';
            btnAceptar.disabled = true;
            btnRechazar.disabled = true;
            filtrarSolicitudes();
        });
        btnRechazar.addEventListener('click', function() {
            estadoSpan.textContent = 'Rechazada';
            estadoSpan.className = 'estado px-3 py-1 bg-accent/20 text-accent rounded-full text-xs font-bold';
            card.dataset.estado = 'Rechazada';
            btnAceptar.disabled = true;
            btnRechazar.disabled = true;
            filtrarSolicitudes();
        });
    });
    // Inicial: mostrar todas
    filtrarSolicitudes();
});
</script>

@endsection
