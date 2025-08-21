<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>FestiSpot · Dashboard</title>
  <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
  <link rel="stylesheet" as="style" onload="this.rel='stylesheet'" 
      href="https://fonts.googleapis.com/css2?display=swap&family=Inter:wght@400;500;700;900&family=Noto+Sans:wght@400;500;700;900" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            warning: '#ff6b35',
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
</head>
<body class="bg-background text-text min-h-screen flex">
  <!-- Sidebar -->
  <aside class="hidden md:flex flex-col w-64 min-h-screen bg-cardLight/90 border-r border-card/30 shadow-xl z-20">
    <!-- Logo -->
    <div class="flex items-center gap-3 px-8 py-8 border-b border-card/30">
      <span class="text-accent text-3xl"><i class="fa-solid fa-bolt"></i></span>
      <span class="font-black text-2xl bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">FestiSpot</span>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 flex flex-col gap-2 px-6 py-8">
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-base hover:bg-accent/10 transition-all text-accent">
        <i class="fa-solid fa-house"></i> Inicio
      </a>
      <a href="/mis-eventos" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-base hover:bg-secondary/10 transition-all text-secondary">
        <i class="fa-solid fa-calendar-days"></i> Mis Eventos
      </a>
      <a href="/solicitudes-productores" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-base hover:bg-tertiary/10 transition-all text-tertiary">
        <i class="fa-solid fa-users"></i> Productores
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-base hover:bg-info/10 transition-all text-info">
        <i class="fa-solid fa-chart-line"></i> Estadísticas
      </a>
      <a href="/subscription/plans" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-base hover:bg-purple/10 transition-all text-purple">
        <i class="fa-solid fa-crown"></i> Suscripción
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-base hover:bg-warning/10 transition-all text-warning">
        <i class="fa-solid fa-gear"></i> Configuración
      </a>
    </nav>
    
    <!-- Create Event Button -->
    <div class="mt-auto px-6 pb-8">
      <button onclick="crearNuevoEvento()" id="btn-crear-evento" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-secondary to-info text-white rounded-xl font-bold text-lg shadow-lg hover:from-info hover:to-secondary transition-all duration-300 transform hover:scale-105 hover:shadow-secondary/50">
        <i class="fa-solid fa-plus"></i> Nuevo Evento
      </button>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 flex flex-col min-h-screen relative z-10 bg-background/90">
    <!-- Header -->
    <header class="flex items-center justify-between border-b border-b-cardLight/30 px-6 py-6 bg-card/80 backdrop-blur-xl sticky top-0 z-10">
      <div class="flex items-center gap-4 text-text">
        <span class="text-accent text-2xl md:hidden"><i class="fa-solid fa-bolt"></i></span>
        <span class="font-black text-xl md:text-2xl bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">FestiSpot</span>
      </div>
      <div class="flex gap-4">
        <button onclick="crearNuevoEvento()" id="btn-crear-evento-header" class="flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-secondary to-info text-white rounded-xl font-bold text-base shadow-lg hover:from-info hover:to-secondary transition-all">
          <i class="fa-solid fa-plus"></i> Crear Evento
        </button>
        <button class="flex items-center gap-2 px-5 py-2 bg-cardLight text-accent border border-accent/40 rounded-xl font-bold text-base shadow hover:bg-accent/10 transition-all">
          <i class="fa-solid fa-file-arrow-down"></i> Descargar Reporte
        </button>
      </div>
    </header>

    <!-- Métricas -->
    <section class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 px-6 py-8">
      <div class="bg-card rounded-2xl p-6 flex flex-col items-center shadow-lg border border-cardLight/30">
        <span class="text-3xl text-accent mb-2"><i class="fa-solid fa-calendar-check"></i></span>
        <div class="text-3xl font-bold">8</div>
        <div class="text-textMuted mt-1 text-sm">Eventos Activos</div>
      </div>
      <div class="bg-card rounded-2xl p-6 flex flex-col items-center shadow-lg border border-cardLight/30">
        <span class="text-3xl text-secondary mb-2"><i class="fa-solid fa-users"></i></span>
        <div class="text-3xl font-bold">245</div>
        <div class="text-textMuted mt-1 text-sm">Asistentes Interesados</div>
      </div>
      <div class="bg-card rounded-2xl p-6 flex flex-col items-center shadow-lg border border-cardLight/30">
        <span class="text-3xl text-tertiary mb-2"><i class="fa-solid fa-user-tie"></i></span>
        <div class="text-3xl font-bold">12</div>
        <div class="text-textMuted mt-1 text-sm">Productores Postulados</div>
      </div>
      <div class="bg-card rounded-2xl p-6 flex flex-col items-center shadow-lg border border-cardLight/30">
        <span class="text-3xl text-success mb-2"><i class="fa-solid fa-star"></i></span>
        <div class="text-3xl font-bold">4.8</div>
        <div class="text-textMuted mt-1 text-sm">Calificación Promedio</div>
      </div>
      <div class="bg-card rounded-2xl p-6 flex flex-col items-center shadow-lg border border-cardLight/30">
        <span class="text-3xl text-warning mb-2"><i class="fa-solid fa-comments"></i></span>
        <div class="text-3xl font-bold">37</div>
        <div class="text-textMuted mt-1 text-sm">Comentarios Recibidos</div>
      </div>
    </section>

    <!-- Gráficas y Notificaciones -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 px-6 pb-8">
      <!-- Gráfica -->
      <div class="bg-cardLight rounded-2xl p-8 shadow-lg border border-card/30 col-span-2 flex flex-col">
        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
          <i class="fa-solid fa-chart-column text-info"></i> Interacción de Asistentes
        </h3>
        <canvas id="chartAsistentes" height="120"></canvas>
      </div>
      
      <!-- Notificaciones -->
      <div class="bg-cardLight rounded-2xl p-8 shadow-lg border border-card/30 flex flex-col">
        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
          <i class="fa-solid fa-bell text-warning"></i> Notificaciones Recientes
        </h3>
        <ul class="space-y-4">
          <li class="flex items-center gap-3">
            <span class="text-accent"><i class="fa-solid fa-user-plus"></i></span> 
            Nueva solicitud de productor: <span class="font-semibold">María López</span>
          </li>
          <li class="flex items-center gap-3">
            <span class="text-success"><i class="fa-solid fa-comment-dots"></i></span> 
            Nuevo comentario en <span class="font-semibold">Festival Jazz</span>
          </li>
          <li class="flex items-center gap-3">
            <span class="text-secondary"><i class="fa-solid fa-user-check"></i></span> 
            Asistente confirmado: <span class="font-semibold">Juan Pérez</span>
          </li>
          <li class="flex items-center gap-3">
            <span class="text-tertiary"><i class="fa-solid fa-calendar-plus"></i></span> 
            Evento <span class="font-semibold">Tech Summit</span> creado
          </li>
        </ul>
      </div>
    </section>

    <!-- Próximos eventos -->
    <section class="px-6 pb-16">
      <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
        <i class="fa-solid fa-calendar-days text-accent"></i> Próximos Eventos
      </h3>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-cardLight rounded-2xl shadow-lg border border-card/30">
          <thead>
            <tr class="text-left text-textMuted text-sm">
              <th class="px-6 py-4">Nombre</th>
              <th class="px-6 py-4">Fecha</th>
              <th class="px-6 py-4">Lugar</th>
              <th class="px-6 py-4">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-t border-card/20 hover:bg-card/30 transition-all">
              <td class="px-6 py-4 font-semibold">Festival Jazz</td>
              <td class="px-6 py-4">22/08/2025</td>
              <td class="px-6 py-4">Auditorio Nacional</td>
              <td class="px-6 py-4 flex gap-2">
                <a href="#" class="px-3 py-1 bg-info/20 text-info rounded-lg text-sm font-bold hover:bg-info/40 transition-all">
                  <i class="fa-solid fa-pen"></i> Editar
                </a>
                <a href="#" class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-bold hover:bg-accent/40 transition-all">
                  <i class="fa-solid fa-trash"></i> Eliminar
                </a>
              </td>
            </tr>
            <tr class="border-t border-card/20 hover:bg-card/30 transition-all">
              <td class="px-6 py-4 font-semibold">Tech Summit</td>
              <td class="px-6 py-4">05/09/2025</td>
              <td class="px-6 py-4">Centro de Convenciones</td>
              <td class="px-6 py-4 flex gap-2">
                <a href="#" class="px-3 py-1 bg-info/20 text-info rounded-lg text-sm font-bold hover:bg-info/40 transition-all">
                  <i class="fa-solid fa-pen"></i> Editar
                </a>
                <a href="#" class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-bold hover:bg-accent/40 transition-all">
                  <i class="fa-solid fa-trash"></i> Eliminar
                </a>
              </td>
            </tr>
            <tr class="border-t border-card/20 hover:bg-card/30 transition-all">
              <td class="px-6 py-4 font-semibold">Expo Cultura</td>
              <td class="px-6 py-4">15/09/2025</td>
              <td class="px-6 py-4">Museo de Arte</td>
              <td class="px-6 py-4 flex gap-2">
                <a href="#" class="px-3 py-1 bg-info/20 text-info rounded-lg text-sm font-bold hover:bg-info/40 transition-all">
                  <i class="fa-solid fa-pen"></i> Editar
                </a>
                <a href="#" class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-bold hover:bg-accent/40 transition-all">
                  <i class="fa-solid fa-trash"></i> Eliminar
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Efectos de fondo -->
  <div class="fixed inset-0 opacity-10 pointer-events-none z-0">
    <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
  </div>

  <script>
    // Inicializar gráfica
    document.addEventListener('DOMContentLoaded', function() {
      const ctx = document.getElementById('chartAsistentes').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago'],
          datasets: [{
            label: 'Asistentes',
            data: [30, 45, 60, 80, 120, 150, 200, 245],
            borderColor: '#00e5ff',
            backgroundColor: 'rgba(0,229,255,0.1)',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#ff4081',
            pointRadius: 5,
          }]
        },
        options: {
          plugins: {
            legend: { display: false }
          },
          scales: {
            x: { grid: { color: '#1e2749' }, ticks: { color: '#b0bec5' } },
            y: { grid: { color: '#1e2749' }, ticks: { color: '#b0bec5' } }
          }
        }
      });
    });

    // Función para crear nuevo evento
    function crearNuevoEvento() {
      // Obtener el botón que fue clickeado (puede ser el del sidebar o header)
      const btnSidebar = document.getElementById('btn-crear-evento');
      const btnHeader = document.getElementById('btn-crear-evento-header');
      
      // Determinar cuál botón fue clickeado
      let btn = null;
      if (event && event.target) {
        btn = event.target.closest('button');
      }
      
      if (!btn) {
        btn = btnSidebar || btnHeader;
      }
      
      if (!btn) return;
      
      const originalText = btn.innerHTML;
      
      // Mostrar estado de carga
      btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Creando...';
      btn.disabled = true;
      
      // Redirigir directamente
      setTimeout(() => {
        window.location.href = '/event/create';
      }, 500);
      
      // Restaurar botón en caso de que no se redirija
      setTimeout(() => {
        if (btn) {
          btn.innerHTML = originalText;
          btn.disabled = false;
        }
      }, 5000);
    }
  </script>
</body>
</html>
