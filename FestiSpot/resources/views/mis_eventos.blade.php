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
                <img src="{{ asset('assets/images/logo-festispot.png') }}" alt="FestiSpot Logo" style="width: 70px; height: 70px; border-radius: 50%;">
                <h1 style="font-size: 22px; font-weight: 700; background: linear-gradient(135deg, #ff4081, #00e5ff, #7c4dff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.5px;">FestiSpot</h1>
            </div>
            
            <!-- Navigation central -->
            <nav style="display: flex; gap: 8px;">
                <a href="/" class="nav-link">Inicio</a>
                <a href="/mis-eventos" class="nav-link active">Mis eventos</a>
                <a href="/solicitudes-productores" class="nav-link">Productores</a>
            </nav>
            
            <!-- User avatar minimalista -->
            <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #ff4081, #00e5ff); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px; box-shadow: 0 4px 12px rgba(255, 64, 129, 0.3);">
                <a href="/configuration" style="color: white; text-decoration: none; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; border-radius: 50%;">U</a>
            </div>
        </div>
    </header>

    <div class="relative z-10 px-8 md:px-20 lg:px-40 py-8">
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
            <!-- Evento 1 -->
            <div class="evento-card bg-card rounded-2xl shadow-lg border border-cardLight/30 flex flex-col transition-all duration-300 cursor-pointer" data-evento-id="1" data-fecha="2025-08-22">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Evento" class="rounded-t-2xl h-40 w-full object-cover">
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-3 py-1 bg-accent/20 text-accent rounded-full text-xs font-bold">Festival</span>
                        <span class="px-3 py-1 bg-success/20 text-success rounded-full text-xs font-bold">Activo</span>
                    </div>
                    <h2 class="text-xl font-bold mb-1">Festival de Música Electrónica 2024</h2>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-calendar-days mr-1"></i> 22/08/2025</div>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-location-dot mr-1"></i> Explanada Central, CDMX</div>
                    <div class="flex items-center gap-2 mt-auto">
                        <span class="text-info"><i class="fa-solid fa-users"></i></span>
                        <span class="font-semibold">245 asistentes</span>
                    </div>
                </div>
            </div>
            <!-- Evento 2 -->
            <div class="evento-card bg-card rounded-2xl shadow-lg border border-cardLight/30 flex flex-col transition-all duration-300 cursor-pointer" data-evento-id="2" data-fecha="2025-09-05">
                <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80" alt="Evento" class="rounded-t-2xl h-40 w-full object-cover">
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-3 py-1 bg-tertiary/20 text-tertiary rounded-full text-xs font-bold">Conferencia</span>
                        <span class="px-3 py-1 bg-success/20 text-success rounded-full text-xs font-bold">Activo</span>
                    </div>
                    <h2 class="text-xl font-bold mb-1">Conferencia de Tecnología Web</h2>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-calendar-days mr-1"></i> 05/09/2025</div>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-location-dot mr-1"></i> Centro de Convenciones / Virtual</div>
                    <div class="flex items-center gap-2 mt-auto">
                        <span class="text-info"><i class="fa-solid fa-users"></i></span>
                        <span class="font-semibold">89 asistentes</span>
                    </div>
                </div>
            </div>
            <!-- Evento 3 -->
            <div class="evento-card bg-card rounded-2xl shadow-lg border border-cardLight/30 flex flex-col transition-all duration-300 cursor-pointer" data-evento-id="3" data-fecha="2024-12-15">
                <img src="https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=600&q=80" alt="Evento" class="rounded-t-2xl h-40 w-full object-cover">
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-3 py-1 bg-secondary/20 text-secondary rounded-full text-xs font-bold">Teatro</span>
                        <span class="px-3 py-1 bg-success/20 text-success rounded-full text-xs font-bold">Finalizado</span>
                    </div>
                    <h2 class="text-xl font-bold mb-1">Obra de Teatro: El Sueño de una Noche</h2>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-calendar-days mr-1"></i> 15/12/2024</div>
                    <div class="text-textMuted text-sm mb-2"><i class="fa-solid fa-location-dot mr-1"></i> Teatro Nacional, Monterrey</div>
                    <div class="flex items-center gap-2 mt-auto">
                        <span class="text-info"><i class="fa-solid fa-users"></i></span>
                        <span class="font-semibold">156 asistentes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Modificación de Evento -->
    <div id="modal-modificar-evento" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-gradient-to-br from-card/95 to-cardLight/90 backdrop-blur-xl rounded-3xl p-8 border border-cardLight/30 max-w-4xl w-full mx-4 shadow-2xl max-h-[90vh] overflow-y-auto">
            <!-- Header del modal -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-accent mb-2">✏️ Modificar Evento</h2>
                <p class="text-textMuted">Edita los detalles de tu evento</p>
            </div>
            
            <!-- Formulario de modificación -->
            <form id="form-modificar-evento" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Información básica -->
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-secondary mb-4">📝 Información Básica</h3>
                        
                        <div>
                            <label class="block text-sm font-bold text-text mb-2">Nombre del Evento</label>
                            <input type="text" id="edit-nombre" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-text mb-2">Descripción</label>
                            <textarea id="edit-descripcion" rows="3" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20"></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-text mb-2">Categoría</label>
                            <select id="edit-categoria" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20">
                                <option value="Festival">Festival</option>
                                <option value="Conferencia">Conferencia</option>
                                <option value="Teatro">Teatro</option>
                                <option value="Deportivo">Deportivo</option>
                                <option value="Cultural">Cultural</option>
                                <option value="Tecnología">Tecnología</option>
                                <option value="Música">Música</option>
                                <option value="Arte">Arte</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-text mb-2">Tipo de Evento</label>
                            <select id="edit-tipo" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20">
                                <option value="Presencial">Presencial</option>
                                <option value="Virtual">Virtual</option>
                                <option value="Híbrido">Híbrido</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Fecha y ubicación -->
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-tertiary mb-4">📅 Fecha y Ubicación</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-text mb-2">Fecha Inicio</label>
                                <input type="date" id="edit-fecha-inicio" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-text mb-2">Fecha Fin</label>
                                <input type="date" id="edit-fecha-fin" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-text mb-2">Hora Inicio</label>
                                <input type="time" id="edit-hora-inicio" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-text mb-2">Hora Fin</label>
                                <input type="time" id="edit-hora-fin" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-text mb-2">Lugar</label>
                            <input type="text" id="edit-lugar" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-text mb-2">Dirección</label>
                            <input type="text" id="edit-direccion" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-text mb-2">Ciudad</label>
                            <input type="text" id="edit-ciudad" class="w-full px-4 py-3 bg-card border border-cardLight/30 rounded-xl text-text focus:border-accent focus:ring-2 focus:ring-accent/20" required>
                        </div>
                    </div>
                </div>
                
                <!-- Botones de acción -->
                <div class="flex gap-4 pt-6 border-t border-cardLight/30">
                    <button type="button" onclick="cerrarModal()" class="flex-1 py-3 bg-cardLight text-textMuted border border-cardLight/30 rounded-xl font-bold hover:bg-card hover:text-text transition-all">
                        ❌ Cancelar
                    </button>
                    <button type="submit" class="flex-1 py-3 bg-gradient-to-r from-accent to-secondary text-white rounded-xl font-bold hover:from-secondary hover:to-accent transition-all shadow-lg">
                        ✅ Guardar Cambios
                    </button>
                </div>
            </form>
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
    .evento-card.expanded {
        /* No cambia tamaño ni z-index, solo resalta */
        border-color: #00e5ff;
        box-shadow: 0 0 0 6px #00e5ff55, 0 12px 48px 0 #ff408133, 0 4px 32px 0 #7c4dff33;
    }
    .evento-modal-bg {
        position: fixed;
        inset: 0;
        background: rgba(10,10,15,0.75);
        z-index: 50;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeInModalBg 0.2s;
    }
    @keyframes fadeInModalBg {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .evento-modal {
        min-width: 340px;
        max-width: 500px;
        width: 100%;
        border-radius: 2.5rem;
        background: linear-gradient(135deg, rgba(22,33,62,0.98) 0%, rgba(30,39,73,0.96) 100%);
        box-shadow: 0 8px 48px 0 #00e5ff55, 0 2px 16px 0 #ff408133;
        border: 2.5px solid #00e5ff44;
        padding: 0;
        overflow: hidden;
        animation: fadeInGestion 0.3s;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .evento-modal .evento-icono {
        margin-top: -48px;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #ff4081 0%, #00e5ff 100%);
        border-radius: 50%;
        box-shadow: 0 4px 32px 0 #00e5ff55, 0 2px 8px 0 #ff408133;
        padding: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 90px;
        height: 90px;
    }
    .evento-modal h2 {
        font-size: 2.2rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        margin-top: 0.2rem;
        letter-spacing: -1px;
        text-align: center;
    }
    .evento-modal .evento-datos {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        margin-bottom: 1.2rem;
    }
    .evento-modal .evento-datos span {
        font-size: 1.08rem;
        color: #b0bec5;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        justify-content: center;
    }
    .evento-modal .evento-datos .text-info {
        color: #00e5ff;
        font-weight: 600;
    }
    .evento-modal .acciones-titulo {
        font-size: 1.25rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.2rem;
        margin-top: 0.5rem;
        text-align: center;
    }
    .evento-modal .acciones-desc {
        color: #b0bec5;
        font-size: 1rem;
        margin-bottom: 1.2rem;
        text-align: center;
    }
    .evento-modal .evento-acciones {
        display: flex;
        flex-direction: row;
        gap: 1.2rem;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    .evento-modal .evento-acciones a {
        min-width: 120px;
        min-height: 120px;
        max-width: 150px;
        max-height: 150px;
        border-radius: 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 700;
        box-shadow: 0 2px 16px 0 #00e5ff33, 0 1.5px 8px 0 #ff408133;
        transition: transform 0.2s, box-shadow 0.2s;
        text-align: center;
        padding: 1.2rem 1rem 1rem 1rem;
        margin: 0;
    }
    .evento-modal .evento-acciones a i {
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
        filter: drop-shadow(0 2px 8px #fff2);
    }
    .evento-modal .evento-acciones a:hover {
        transform: scale(1.08) translateY(-4px);
        box-shadow: 0 0 0 4px #ff408155, 0 8px 32px 0 #00e5ff33, 0 2px 16px 0 #7c4dff22;
        z-index: 10;
    }
    .evento-modal .evento-acciones a:first-child {
        background: linear-gradient(135deg, #ff4081 0%, #ff80ab 100%);
        color: #fff;
    }
    .evento-modal .evento-acciones a:nth-child(2) {
        background: linear-gradient(135deg, #00e5ff 0%, #18ffff 100%);
        color: #fff;
    }
    .evento-modal .evento-acciones a:last-child {
        background: linear-gradient(135deg, #7c4dff 0%, #b388ff 100%);
        color: #fff;
    }
    .evento-modal .cerrar-modal-btn {
        display: block;
        margin: 0 auto 1.2rem auto;
        padding: 0.7rem 2.2rem;
        background: transparent;
        color: #ff4081;
        border: 2px solid #ff4081;
        border-radius: 1rem;
        font-weight: 700;
        font-size: 1.1rem;
        transition: background 0.2s, color 0.2s;
        box-shadow: 0 2px 8px 0 #ff408133;
    }
    .evento-modal .cerrar-modal-btn:hover {
        background: #ff4081;
        color: #fff;
    }
    }
    .evento-gestion {
        animation: none;
    }
    @keyframes fadeInGestion {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<script>
    // Base de datos de eventos
    const eventosData = {
        1: {
            id: 1,
            nombre: "Festival de Música Electrónica 2024",
            categoria: "Festival",
            tipo: "Presencial",
            descripcion: "Un festival increíble con los mejores DJs del mundo. Ven a disfrutar de una noche llena de música electrónica, luces espectaculares y una experiencia única que recordarás para siempre.",
            fecha_inicio: "2025-08-22",
            fecha_fin: "2025-08-22",
            hora_inicio: "20:00",
            hora_fin: "02:00",
            lugar: "Explanada Central",
            direccion: "Av. Insurgentes Sur 1457, Col. San José Insurgentes",
            ciudad: "Ciudad de México",
            estado: "CDMX",
            pais: "México",
            capacidad: "5000",
            asistentes: 245,
            estado_evento: "published",
            dias_restantes: 7,
            puede_modificar_fecha: true,
            puede_modificar_ubicacion: false,
            puede_modificar_basico: true,
            evento_pasado: false
        },
        2: {
            id: 2,
            nombre: "Conferencia de Tecnología Web",
            categoria: "Conferencia",
            tipo: "Híbrido",
            descripcion: "Conferencia sobre las últimas tendencias en desarrollo web, frameworks modernos y mejores prácticas. Incluye talleres prácticos y networking.",
            fecha_inicio: "2025-09-05",
            fecha_fin: "2025-09-05",
            hora_inicio: "09:00",
            hora_fin: "18:00",
            lugar: "Centro de Convenciones",
            direccion: "Av. López Mateos 2375, Col. Providencia",
            ciudad: "Guadalajara",
            estado: "Jalisco",
            pais: "México",
            enlace_virtual: "https://meet.google.com/abc-defg-hij",
            plataforma: "google-meet",
            capacidad: "300",
            asistentes: 89,
            estado_evento: "published",
            dias_restantes: 14,
            puede_modificar_fecha: true,
            puede_modificar_ubicacion: true,
            puede_modificar_basico: true,
            evento_pasado: false
        },
        3: {
            id: 3,
            nombre: "Obra de Teatro: El Sueño de una Noche",
            categoria: "Teatro",
            tipo: "Presencial",
            descripcion: "Una adaptación moderna de la clásica obra de Shakespeare. Una experiencia teatral única que combina tradición y vanguardia.",
            fecha_inicio: "2024-12-15",
            fecha_fin: "2024-12-15",
            hora_inicio: "19:30",
            hora_fin: "22:00",
            lugar: "Teatro Nacional",
            direccion: "Av. Constitución 435, Col. Centro",
            ciudad: "Monterrey",
            estado: "Nuevo León",
            pais: "México",
            capacidad: "500",
            asistentes: 156,
            estado_evento: "finished",
            dias_restantes: -30,
            puede_modificar_fecha: false,
            puede_modificar_ubicacion: false,
            puede_modificar_basico: true,
            evento_pasado: true,
            resenas: [
                {
                    id: 1,
                    usuario: "María García",
                    calificacion: 5,
                    comentario: "¡Increíble adaptación! Los actores estuvieron espectaculares y la puesta en escena fue sublime. Definitivamente recomiendo este tipo de eventos.",
                    fecha: "2024-12-16"
                },
                {
                    id: 2,
                    usuario: "Carlos Mendoza",
                    calificacion: 4,
                    comentario: "Muy buena obra, aunque el sonido podría mejorar un poco. La interpretación fue excelente y la historia muy bien contada.",
                    fecha: "2024-12-16"
                },
                {
                    id: 3,
                    usuario: "Ana López",
                    calificacion: 5,
                    comentario: "Una experiencia teatral única. Me encantó cómo modernizaron la obra sin perder su esencia. El venue también es perfecto.",
                    fecha: "2024-12-17"
                },
                {
                    id: 4,
                    usuario: "Roberto Silva",
                    calificacion: 4,
                    comentario: "Excelente producción. Los efectos visuales y la música fueron muy bien ejecutados. Solo el tiempo de espera fue un poco largo.",
                    fecha: "2024-12-18"
                }
            ]
        }
    };

    // Función para limpiar completamente el estado de los eventos
    function limpiarEstadoEventos() {
        // Limpiar todas las tarjetas expandidas
        document.querySelectorAll('.evento-card').forEach(card => {
            card.classList.remove('expanded');
        });
        
        // Reset de variables globales
        if (typeof expandedCard !== 'undefined') {
            expandedCard = null;
        }
        if (typeof window.expandedCard !== 'undefined') {
            window.expandedCard = null;
        }
        
        // Remover cualquier modal que pueda quedar
        const modals = document.querySelectorAll('#evento-modal-bg, #resenas-modal-bg, #anuncios-modal-bg');
        modals.forEach(modal => modal.remove());
    }

    // Expansión de evento y gestión
    document.addEventListener('DOMContentLoaded', function() {
        let expandedCard = null;
        
        // Hacer expandedCard accesible globalmente
        window.expandedCard = expandedCard;
        
        document.querySelectorAll('.evento-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Evitar expansión si ya está expandido
                if (card.classList.contains('expanded')) return;
                
                // Limpiar estado previo completamente
                limpiarEstadoEventos();
                
                // Expandir nueva tarjeta
                card.classList.add('expanded');
                expandedCard = card;
                window.expandedCard = expandedCard; // Actualizar referencia global
                
                // Obtener ID del evento
                const eventoId = card.getAttribute('data-evento-id');
                const evento = eventosData[eventoId];
                
                // Crear modal
                if (!document.getElementById('evento-modal-bg')) {
                    const modalBg = document.createElement('div');
                    modalBg.className = 'evento-modal-bg';
                    modalBg.id = 'evento-modal-bg';
                    const modal = document.createElement('div');
                    modal.className = 'evento-modal';
                    
                    // Obtener info del evento
                    const titulo = evento.nombre;
                    const fecha = new Date(evento.fecha_inicio).toLocaleDateString('es-ES', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    const lugar = `${evento.lugar}, ${evento.ciudad}`;
                    const asistentes = `${evento.asistentes} asistentes confirmados`;
                    
                    modal.innerHTML = `
                        <h2 class="bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">${titulo}</h2>
                        <div class="evento-datos">
                            <span><i class="fa-solid fa-calendar-days"></i> ${fecha}</span>
                            <span><i class="fa-solid fa-location-dot"></i> ${lugar}</span>
                            <span class="text-info"><i class="fa-solid fa-users"></i> ${asistentes}</span>
                        </div>
                        <div class="acciones-titulo">Acciones rápidas</div>
                        <div class="acciones-desc">Gestiona tu evento fácilmente</div>
                        <div class="evento-acciones">
                            <a href="#" onclick="event.preventDefault(); modificarEvento(${eventoId})" class="border-2 border-[#00e5ff] text-[#00e5ff] bg-transparent font-bold rounded-xl px-4 py-6 text-lg shadow-lg transition-all flex flex-col items-center justify-center hover:bg-[#00e5ff] hover:text-white"><i class="fa-solid fa-pen-to-square mb-2"></i>Modificar<br>evento</a>
                            <a href="#" onclick="event.preventDefault(); crearAnuncio(${eventoId})" class="border-2 border-[#7c4dff] text-[#7c4dff] bg-transparent font-bold rounded-xl px-4 py-6 text-lg shadow-lg transition-all flex flex-col items-center justify-center hover:bg-[#7c4dff] hover:text-white"><i class="fa-solid fa-bullhorn mb-2"></i>Crear<br>anuncios</a>
                            <a href="#" onclick="event.preventDefault(); verResenas(${eventoId})" class="border-2 border-[#ff4081] text-[#ff4081] bg-transparent font-bold rounded-xl px-4 py-6 text-lg shadow-lg transition-all flex flex-col items-center justify-center hover:bg-[#ff4081] hover:text-white"><i class="fa-solid fa-star mb-2"></i>Ver<br>reseñas</a>
                        </div>
                        <button class="cerrar-modal-btn">Cerrar gestión</button>
                    `;
                    modalBg.appendChild(modal);
                    document.body.appendChild(modalBg);
                    
                    // Cerrar modal principal
                    modal.querySelector('button').addEventListener('click', function(ev) {
                        ev.stopPropagation();
                        limpiarEstadoEventos();
                    });
                    
                    // Cerrar al hacer clic fuera
                    modalBg.addEventListener('click', function(ev) {
                        if (ev.target === modalBg) {
                            limpiarEstadoEventos();
                        }
                    });
                }
            });
        });
    });

    // Función para modificar evento - ahora abre modal
    function modificarEvento(eventoId) {
        console.log('Modificando evento:', eventoId);
        const evento = eventosData[eventoId];
        
        if (!evento) {
            alert('Error: No se encontraron los datos del evento');
            return;
        }
        
        // Cerrar el modal anterior (de opciones del evento)
        const modalBg = document.getElementById('evento-modal-bg');
        if (modalBg) {
            modalBg.remove();
        }
        
        // Limpiar estado expandido de todas las tarjetas
        document.querySelectorAll('.evento-card').forEach(card => {
            card.classList.remove('expanded');
        });
        
        // Reset del expandedCard global
        if (typeof expandedCard !== 'undefined') {
            expandedCard = null;
        }
        
        // Llenar el formulario con los datos del evento
        document.getElementById('edit-nombre').value = evento.nombre;
        document.getElementById('edit-descripcion').value = evento.descripcion;
        document.getElementById('edit-categoria').value = evento.categoria;
        document.getElementById('edit-tipo').value = evento.tipo;
        document.getElementById('edit-fecha-inicio').value = evento.fecha_inicio;
        document.getElementById('edit-fecha-fin').value = evento.fecha_fin;
        document.getElementById('edit-hora-inicio').value = evento.hora_inicio;
        document.getElementById('edit-hora-fin').value = evento.hora_fin;
        document.getElementById('edit-lugar').value = evento.lugar;
        document.getElementById('edit-direccion').value = evento.direccion;
        document.getElementById('edit-ciudad').value = evento.ciudad;
        
        // Guardar el ID del evento que se está editando
        window.eventoEditandoId = eventoId;
        
        // Mostrar el modal
        document.getElementById('modal-modificar-evento').classList.remove('hidden');
    }

    // Función para ver reseñas
    function verResenas(eventoId) {
        console.log('Viendo reseñas del evento:', eventoId);
        const evento = eventosData[eventoId];
        
        if (!evento) {
            alert('Error: No se encontraron los datos del evento');
            return;
        }
        
        // Cerrar modal actual y limpiar estado expandido
        const modalBg = document.getElementById('evento-modal-bg');
        if (modalBg) {
            modalBg.remove();
        }
        
        // Limpiar estado expandido de todas las tarjetas
        document.querySelectorAll('.evento-card').forEach(card => {
            card.classList.remove('expanded');
        });
        
        // Reset del expandedCard global
        if (typeof expandedCard !== 'undefined') {
            expandedCard = null;
        }
        
        // Crear modal de reseñas
        mostrarModalResenas(evento);
    }
    
    function mostrarModalResenas(evento) {
        const modalBg = document.createElement('div');
        modalBg.className = 'evento-modal-bg';
        modalBg.id = 'resenas-modal-bg';
        
        const modal = document.createElement('div');
        modal.className = 'resenas-modal';
        
        let contenidoResenas = '';
        
        if (!evento.evento_pasado) {
            // Evento futuro - no hay reseñas
            contenidoResenas = `
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">⏳</div>
                    <h3 class="text-2xl font-bold text-warning mb-4">Evento Próximo</h3>
                    <p class="text-textMuted text-lg">
                        Las reseñas estarán disponibles después de que el evento haya terminado.
                    </p>
                    <div class="mt-6 p-4 bg-info/10 rounded-xl">
                        <p class="text-info font-medium">
                            📅 Fecha del evento: ${new Date(evento.fecha_inicio).toLocaleDateString('es-ES', {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            })}
                        </p>
                    </div>
                </div>
            `;
        } else if (!evento.resenas || evento.resenas.length === 0) {
            // Evento pasado sin reseñas
            contenidoResenas = `
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📝</div>
                    <h3 class="text-2xl font-bold text-textMuted mb-4">Sin Reseñas</h3>
                    <p class="text-textMuted text-lg">
                        Aún no hay reseñas para este evento.
                    </p>
                </div>
            `;
        } else {
            // Evento pasado con reseñas
            const promedioCalificacion = evento.resenas.reduce((sum, r) => sum + r.calificacion, 0) / evento.resenas.length;
            const estrellas = '⭐'.repeat(Math.round(promedioCalificacion));
            
            contenidoResenas = `
                <div class="mb-6 text-center">
                    <div class="text-4xl mb-2">${estrellas}</div>
                    <div class="text-2xl font-bold text-success">${promedioCalificacion.toFixed(1)}/5</div>
                    <div class="text-textMuted">Basado en ${evento.resenas.length} reseña(s)</div>
                </div>
                
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    ${evento.resenas.map(resena => `
                        <div class="bg-cardLight/30 rounded-xl p-4 border border-cardLight/20">
                            <div class="flex items-center justify-between mb-3">
                                <div class="font-bold text-text">${resena.usuario}</div>
                                <div class="flex items-center gap-2">
                                    <div class="text-warning">${'⭐'.repeat(resena.calificacion)}</div>
                                    <div class="text-xs text-textMuted">${new Date(resena.fecha).toLocaleDateString('es-ES')}</div>
                                </div>
                            </div>
                            <p class="text-textMuted leading-relaxed">${resena.comentario}</p>
                        </div>
                    `).join('')}
                </div>
            `;
        }
        
        modal.innerHTML = `
            <div class="p-8">
                <h2 class="text-3xl font-bold text-center mb-6 bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">
                    Reseñas - ${evento.nombre}
                </h2>
                
                ${contenidoResenas}
                
                <button class="cerrar-resenas-btn">Cerrar</button>
            </div>
        `;
        
        modalBg.appendChild(modal);
        document.body.appendChild(modalBg);
        
        // Event listeners para cerrar y limpiar estado
        modal.querySelector('.cerrar-resenas-btn').addEventListener('click', function() {
            modalBg.remove();
            // Asegurar que el estado se limpia completamente
            limpiarEstadoEventos();
        });
        
        modalBg.addEventListener('click', function(ev) {
            if (ev.target === modalBg) {
                modalBg.remove();
                // Asegurar que el estado se limpia completamente
                limpiarEstadoEventos();
            }
        });
    }

    // Función para crear anuncio
    function crearAnuncio(eventoId) {
        console.log('Creando anuncio para evento:', eventoId);
        const evento = eventosData[eventoId];
        
        if (!evento) {
            alert('Error: No se encontraron los datos del evento');
            return;
        }
        
        // Cerrar modal actual y limpiar estado expandido
        const modalBg = document.getElementById('evento-modal-bg');
        if (modalBg) {
            modalBg.remove();
        }
        
        // Limpiar estado expandido de todas las tarjetas
        document.querySelectorAll('.evento-card').forEach(card => {
            card.classList.remove('expanded');
        });
        
        // Reset del expandedCard global
        if (typeof expandedCard !== 'undefined') {
            expandedCard = null;
        }
        
        // Crear modal de anuncios
        mostrarModalAnuncios(evento);
    }
    
    function mostrarModalAnuncios(evento) {
        const modalBg = document.createElement('div');
        modalBg.className = 'evento-modal-bg';
        modalBg.id = 'anuncios-modal-bg';
        
        const modal = document.createElement('div');
        modal.className = 'anuncios-modal';
        
        // Datos de suscripción simulados (en el futuro vendrán del backend)
        const suscripcionUsuario = {
            tipo: 'basic', // basic, premium, professional
            anunciosRestantes: 3,
            anunciosMaximos: 5,
            caracteristicasPermitidas: ['texto', 'imagen'],
            caracteristicasRestringidas: ['video', 'promociones_especiales', 'audiencia_avanzada']
        };
        
        let contenidoModal = '';
        
        // Header del modal
        contenidoModal += `
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent mb-2">
                    📢 Crear Anuncio
                </h2>
                <p class="text-lg font-semibold text-terciary">${evento.nombre}</p>
                <div class="mt-4 flex items-center justify-center gap-4 text-sm">
                    <div class="flex items-center gap-2 bg-info/10 px-3 py-1 rounded-lg">
                        <span class="text-info">📊</span>
                        <span class="text-textMuted">Suscripción: <span class="font-bold text-info">${suscripcionUsuario.tipo.charAt(0).toUpperCase() + suscripcionUsuario.tipo.slice(1)}</span></span>
                    </div>
                    <div class="flex items-center gap-2 bg-warning/10 px-3 py-1 rounded-lg">
                        <span class="text-warning">🎯</span>
                        <span class="text-textMuted">Restantes: <span class="font-bold text-warning">${suscripcionUsuario.anunciosRestantes}/${suscripcionUsuario.anunciosMaximos}</span></span>
                    </div>
                </div>
            </div>
        `;
        
        // Verificar si puede crear anuncios
        if (suscripcionUsuario.anunciosRestantes <= 0) {
            contenidoModal += `
                <div class="text-center py-8">
                    <div class="text-6xl mb-4">⚠️</div>
                    <h3 class="text-2xl font-bold text-warning mb-4">Límite Alcanzado</h3>
                    <p class="text-textMuted text-lg mb-6">
                        Has alcanzado el límite de anuncios para tu suscripción ${suscripcionUsuario.tipo}.
                    </p>
                    <div class="space-y-3">
                        <button onclick="window.location.href='/subscription/plans'" 
                                class="w-full px-6 py-3 bg-gradient-to-r from-accent to-secondary text-white rounded-xl font-bold hover:from-secondary hover:to-accent transition-all duration-300">
                            ⬆️ Mejorar Suscripción
                        </button>
                        <div class="text-xs text-textMuted">
                            💡 Las suscripciones Premium y Professional incluyen más anuncios y características avanzadas
                        </div>
                    </div>
                </div>
            `;
        } else {
            // Formulario para crear anuncio
            contenidoModal += `
                <form id="anuncio-form" class="space-y-6">
                    <!-- Tipo de Anuncio -->
                    <div>
                        <label class="block text-textMuted text-sm font-medium mb-3">
                            📋 Tipo de Anuncio *
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center p-4 border-2 border-cardLight/30 rounded-xl cursor-pointer hover:border-accent/50 transition-all bg-cardLight/20">
                                <input type="radio" name="tipo_anuncio" value="promocional" class="mr-3 text-accent" required>
                                <div>
                                    <div class="font-bold text-accent">🎉 Promocional</div>
                                    <div class="text-xs text-textMuted">Promociona tu evento</div>
                                </div>
                            </label>
                            <label class="flex items-center p-4 border-2 border-cardLight/30 rounded-xl cursor-pointer hover:border-info/50 transition-all bg-cardLight/20">
                                <input type="radio" name="tipo_anuncio" value="informativo" class="mr-3 text-info" required>
                                <div>
                                    <div class="font-bold text-info">📢 Informativo</div>
                                    <div class="text-xs text-textMuted">Comparte información</div>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Título del Anuncio -->
                    <div>
                        <label class="block text-textMuted text-sm font-medium mb-2">
                            📝 Título del Anuncio *
                        </label>
                        <input type="text" name="titulo" required maxlength="50"
                               placeholder="Ej: ¡Últimas entradas disponibles!"
                               class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent">
                        <div class="text-xs text-textMuted mt-1">Máximo 50 caracteres</div>
                    </div>
                    
                    <!-- Contenido del Anuncio -->
                    <div>
                        <label class="block text-textMuted text-sm font-medium mb-2">
                            📄 Contenido del Anuncio *
                        </label>
                        <textarea name="contenido" required rows="4" maxlength="200"
                                  placeholder="Escribe el mensaje de tu anuncio..."
                                  class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text placeholder-textMuted focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent resize-none"></textarea>
                        <div class="text-xs text-textMuted mt-1">Máximo 200 caracteres</div>
                    </div>
                    
                    <!-- Imagen (disponible en plan básico) -->
                    <div>
                        <label class="block text-textMuted text-sm font-medium mb-2">
                            🖼️ Imagen del Anuncio
                        </label>
                        <div class="border-2 border-dashed border-cardLight/50 rounded-xl p-6 text-center hover:border-accent/50 transition-all">
                            <input type="file" name="imagen" accept="image/*" class="hidden" id="imagen-upload">
                            <label for="imagen-upload" class="cursor-pointer">
                                <div class="text-4xl mb-2">📸</div>
                                <div class="text-textMuted">Haz clic para subir una imagen</div>
                                <div class="text-xs text-textMuted mt-1">JPG, PNG o GIF (máx. 2MB)</div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Características restringidas -->
                    <div class="bg-warning/10 border border-warning/30 rounded-xl p-4">
                        <h4 class="font-bold text-warning mb-2 flex items-center">
                            <span class="mr-2">🔒</span> Características Premium
                        </h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-textMuted">
                                <span class="text-warning">🎬</span>
                                <span>Videos promocionales</span>
                                <span class="text-xs bg-accent/20 text-accent px-2 py-1 rounded">Premium+</span>
                            </div>
                            <div class="flex items-center gap-2 text-textMuted">
                                <span class="text-warning">🎯</span>
                                <span>Audiencia segmentada avanzada</span>
                                <span class="text-xs bg-tertiary/20 text-tertiary px-2 py-1 rounded">Professional</span>
                            </div>
                            <div class="flex items-center gap-2 text-textMuted">
                                <span class="text-warning">💰</span>
                                <span>Promociones y descuentos</span>
                                <span class="text-xs bg-tertiary/20 text-tertiary px-2 py-1 rounded">Professional</span>
                            </div>
                        </div>
                        <button type="button" onclick="window.location.href='/subscription/plans'" 
                                class="mt-3 px-4 py-2 bg-warning/20 hover:bg-warning/30 text-warning rounded-lg text-sm font-medium transition-all">
                            ⬆️ Mejorar para desbloquear
                        </button>
                    </div>
                    
                    <!-- Audiencia -->
                    <div>
                        <label class="block text-textMuted text-sm font-medium mb-2">
                            🎯 Audiencia Objetivo
                        </label>
                        <select name="audiencia" class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-accent/50 focus:border-accent">
                            <option value="asistentes">👥 Asistentes confirmados (${evento.asistentes})</option>
                            <option value="seguidores">👤 Seguidores del evento</option>
                            <option value="publico_general" disabled>🌍 Público general (Premium+)</option>
                        </select>
                    </div>
                    
                    <!-- Programación -->
                    <div>
                        <label class="block text-textMuted text-sm font-medium mb-2">
                            ⏰ Programación
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center p-3 border border-cardLight/30 rounded-lg cursor-pointer hover:border-accent/50 transition-all">
                                <input type="radio" name="programacion" value="inmediato" class="mr-2 text-accent" checked>
                                <span class="text-sm">📤 Enviar ahora</span>
                            </label>
                            <label class="flex items-center p-3 border border-cardLight/30 rounded-lg cursor-pointer hover:border-info/50 transition-all">
                                <input type="radio" name="programacion" value="programado" class="mr-2 text-info">
                                <span class="text-sm">⏲️ Programar</span>
                            </label>
                        </div>
                        <div id="fecha-programada" class="hidden mt-3">
                            <input type="datetime-local" name="fecha_envio" 
                                   class="w-full bg-cardLight/50 border border-cardLight/30 rounded-xl px-4 py-3 text-text focus:outline-none focus:ring-2 focus:ring-info/50 focus:border-info">
                        </div>
                    </div>
                </form>
            `;
        }
        
        modal.innerHTML = `
            <div class="p-6 max-h-[80vh] overflow-y-auto">
                ${contenidoModal}
                
                <div class="flex gap-3 mt-6 pt-4 border-t border-cardLight/30">
                    <button class="cerrar-anuncios-btn flex-1 px-4 py-3 border-2 border-textMuted text-textMuted rounded-xl font-bold hover:bg-textMuted hover:text-background transition-all">
                        ✕ Cancelar
                    </button>
                    ${suscripcionUsuario.anunciosRestantes > 0 ? `
                        <button type="submit" form="anuncio-form" class="flex-1 px-4 py-3 bg-gradient-to-r from-tertiary to-purple text-white rounded-xl font-bold hover:from-purple hover:to-tertiary transition-all shadow-lg">
                            📢 Crear Anuncio
                        </button>
                    ` : ''}
                </div>
            </div>
        `;
        
        modalBg.appendChild(modal);
        document.body.appendChild(modalBg);
        
        // Event listeners
        modal.querySelector('.cerrar-anuncios-btn').addEventListener('click', function() {
            modalBg.remove();
            limpiarEstadoEventos();
        });
        
        modalBg.addEventListener('click', function(ev) {
            if (ev.target === modalBg) {
                modalBg.remove();
                limpiarEstadoEventos();
            }
        });
        
        // Event listener para programación
        const programacionRadios = modal.querySelectorAll('input[name="programacion"]');
        const fechaProgramada = modal.getElementById('fecha-programada');
        
        programacionRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'programado') {
                    fechaProgramada.classList.remove('hidden');
                } else {
                    fechaProgramada.classList.add('hidden');
                }
            });
        });
        
        // Event listener para el formulario
        if (suscripcionUsuario.anunciosRestantes > 0) {
            const form = modal.querySelector('#anuncio-form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                crearAnuncioSubmit(evento, new FormData(form));
            });
        }
    }
    
    function crearAnuncioSubmit(evento, formData) {
        // Mostrar loading
        const submitBtn = document.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '⏳ Creando...';
        submitBtn.disabled = true;
        
        // Simular creación del anuncio
        setTimeout(() => {
            const tipoAnuncio = formData.get('tipo_anuncio');
            const titulo = formData.get('titulo');
            const programacion = formData.get('programacion');
            
            let mensaje = `✅ ¡Anuncio creado exitosamente!\n\n`;
            mensaje += `📋 Tipo: ${tipoAnuncio === 'promocional' ? 'Promocional' : 'Informativo'}\n`;
            mensaje += `📝 Título: "${titulo}"\n`;
            mensaje += `👥 Audiencia: ${evento.asistentes} asistentes\n`;
            mensaje += `⏰ Envío: ${programacion === 'inmediato' ? 'Inmediato' : 'Programado'}\n\n`;
            mensaje += `📊 Te quedan 2 anuncios restantes en tu suscripción.`;
            
            alert(mensaje);
            
            // Cerrar modal
            document.getElementById('anuncios-modal-bg').remove();
            limpiarEstadoEventos();
        }, 2000);
    }

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
    
    // Función para cerrar el modal de modificación
    function cerrarModal() {
        document.getElementById('modal-modificar-evento').classList.add('hidden');
        window.eventoEditandoId = null;
    }
    
    // Función para guardar cambios del evento
    function guardarCambiosEvento() {
        const eventoId = window.eventoEditandoId;
        if (!eventoId) {
            alert('Error: No se encontró el evento a modificar');
            return;
        }
        
        // Obtener los valores del formulario
        const datosActualizados = {
            nombre: document.getElementById('edit-nombre').value,
            descripcion: document.getElementById('edit-descripcion').value,
            categoria: document.getElementById('edit-categoria').value,
            tipo: document.getElementById('edit-tipo').value,
            fecha_inicio: document.getElementById('edit-fecha-inicio').value,
            fecha_fin: document.getElementById('edit-fecha-fin').value,
            hora_inicio: document.getElementById('edit-hora-inicio').value,
            hora_fin: document.getElementById('edit-hora-fin').value,
            lugar: document.getElementById('edit-lugar').value,
            direccion: document.getElementById('edit-direccion').value,
            ciudad: document.getElementById('edit-ciudad').value
        };
        
        // Validaciones básicas
        if (!datosActualizados.nombre.trim()) {
            alert('El nombre del evento es obligatorio');
            return;
        }
        
        if (!datosActualizados.fecha_inicio) {
            alert('La fecha de inicio es obligatoria');
            return;
        }
        
        // Aquí normalmente harías una petición AJAX al servidor
        // Por ahora actualizamos los datos localmente
        eventosData[eventoId] = { ...eventosData[eventoId], ...datosActualizados };
        
        // Cerrar modal
        cerrarModal();
        
        // Mostrar mensaje de éxito
        alert('Evento actualizado correctamente');
        
        // Recargar la página para mostrar los cambios
        location.reload();
    }
    
    // Event listener para cerrar modal al hacer click en el fondo
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('modal-modificar-evento');
        const modalContent = modal.querySelector('.bg-gradient-to-br');
        
        modal.addEventListener('click', function(e) {
            // Solo cerrar si se hace click en el fondo (no en el contenido)
            if (e.target === modal) {
                cerrarModal();
            }
        });
        
        // Prevenir que el click en el contenido del modal lo cierre
        modalContent.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
</script>

<style>
    /* ...existing code... */
    
    .resenas-modal {
        min-width: 400px;
        max-width: 600px;
        width: 90%;
        border-radius: 2rem;
        background: linear-gradient(135deg, rgba(22,33,62,0.98) 0%, rgba(30,39,73,0.96) 100%);
        box-shadow: 0 8px 48px 0 #ff408155, 0 2px 16px 0 #00e5ff33;
        border: 2px solid #ff408144;
        overflow: hidden;
        animation: fadeInGestion 0.3s;
        position: relative;
    }
    
    .cerrar-resenas-btn {
        display: block;
        padding: 0.8rem 2rem;
        background: transparent;
        color: #ff4081;
        border: 2px solid #ff4081;
        border-radius: 1rem;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px 0 #ff408133;
        cursor: pointer;
    }
    
    .cerrar-resenas-btn:hover {
        background: #ff4081;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px 0 #ff408155;
    }
    
    .anuncios-modal {
        min-width: 500px;
        max-width: 700px;
        width: 95%;
        border-radius: 2rem;
        background: linear-gradient(135deg, rgba(22,33,62,0.98) 0%, rgba(30,39,73,0.96) 100%);
        box-shadow: 0 8px 48px 0 #7c4dff55, 0 2px 16px 0 #ff408133;
        border: 2px solid #7c4dff44;
        overflow: hidden;
        animation: fadeInGestion 0.3s;
        position: relative;
    }
    
    .cerrar-anuncios-btn {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .cerrar-anuncios-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px 0 rgba(255, 255, 255, 0.1);
    }
    
    /* Estilos para el modal de modificación de eventos */
    .modal-backdrop {
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
    }
    
    .modal-content {
        background: linear-gradient(135deg, rgba(22,33,62,0.98) 0%, rgba(30,39,73,0.96) 100%);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 8px 32px rgba(255, 64, 129, 0.1);
        border: 2px solid rgba(255, 64, 129, 0.2);
        animation: modalSlideIn 0.3s ease-out;
    }
    
    @keyframes modalSlideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .modal-content input,
    .modal-content textarea,
    .modal-content select {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.1);
        color: white;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .modal-content input:focus,
    .modal-content textarea:focus,
    .modal-content select:focus {
        border-color: #ff4081;
        box-shadow: 0 0 0 3px rgba(255, 64, 129, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 0.08);
    }
    
    .modal-content input::placeholder,
    .modal-content textarea::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }
    
    .modal-btn-primary {
        background: linear-gradient(135deg, #ff4081 0%, #e91e63 100%);
        transition: all 0.3s ease;
    }
    
    .modal-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 64, 129, 0.3);
    }
    
    .modal-btn-secondary {
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }
    
    .modal-btn-secondary:hover {
        border-color: rgba(255, 255, 255, 0.4);
        color: white;
        background: rgba(255, 255, 255, 0.05);
    }
</style>
@endsection
