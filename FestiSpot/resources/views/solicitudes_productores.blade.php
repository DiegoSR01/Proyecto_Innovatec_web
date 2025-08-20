<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiSpot - Solicitudes de Productores</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link rel="stylesheet" as="style" onload="this.rel='stylesheet'" 
          href="https://fonts.googleapis.com/css2?display=swap&family=Inter:wght@400;500;700;900&family=Noto+Sans:wght@400;500;700;900" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              background: '#0a0a0f',
              card: '#16213e',
              cardLight: '#1e2749',
              accent: '#ff4081',
              secondary: '#00e5ff',
              tertiary: '#7c4dff',
              success: '#00c853',
              warning: '#ffc107',
              info: '#2196f3',
              purple: '#9c27b0',
              text: '#ffffff',
              textMuted: '#b0bec5',
              textDark: '#78909c',
              glow: '#ff4081'
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
    <!-- Efectos de fondo -->
    <div class="fixed inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto">
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
                <button type="submit" class="px-6 py-2 bg-accent text-white rounded-lg font-bold hover:bg-secondary transition-all"><i class="fa-solid fa-filter"></i> Filtrar</button>
                <button type="button" id="btn-borrar-filtros" class="px-6 py-2 bg-warning text-white rounded-lg font-bold hover:bg-accent transition-all"><i class="fa-solid fa-xmark"></i></button>
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
                    <button class="btn-aceptar px-4 py-2 bg-success/80 text-white rounded-lg font-bold hover:bg-success transition-all"><i class="fa-solid fa-check"></i> Aceptar</button>
                    <button class="btn-rechazar px-4 py-2 bg-accent/80 text-white rounded-lg font-bold hover:bg-accent transition-all"><i class="fa-solid fa-xmark"></i> Rechazar</button>
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
                    <button class="btn-aceptar px-4 py-2 bg-success/80 text-white rounded-lg font-bold hover:bg-success transition-all"><i class="fa-solid fa-check"></i> Aceptar</button>
                    <button class="btn-rechazar px-4 py-2 bg-accent/80 text-white rounded-lg font-bold hover:bg-accent transition-all"><i class="fa-solid fa-xmark"></i> Rechazar</button>
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
                    <button class="btn-aceptar px-4 py-2 bg-success/80 text-white rounded-lg font-bold hover:bg-success transition-all"><i class="fa-solid fa-check"></i> Aceptar</button>
                    <button class="btn-rechazar px-4 py-2 bg-accent/80 text-white rounded-lg font-bold hover:bg-accent transition-all"><i class="fa-solid fa-xmark"></i> Rechazar</button>
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
</body>
</html>
