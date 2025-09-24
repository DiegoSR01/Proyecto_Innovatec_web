@extends('layouts.app')

@section('content')
<div class="bg-background text-text min-h-screen flex">
  <!-- Sidebar -->
  <aside class="hidden md:flex flex-col w-64 min-h-screen shadow-xl z-20" style="background: linear-gradient(135deg, rgba(26, 26, 46, 0.95) 0%, rgba(22, 33, 62, 0.9) 50%, rgba(15, 15, 35, 0.95) 100%); border-right: 1px solid rgba(255, 64, 129, 0.2); backdrop-filter: blur(20px);">
    <!-- Logo -->
    <div class="flex items-center justify-center px-8 py-8">
      <img src="{{ asset('assets/images/logo-festispot.png') }}" alt="FestiSpot Logo" class="w-40 h-40 rounded-full cursor-pointer" id="logo-home">
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
      <a href="/configuration" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-base hover:bg-warning/10 transition-all text-warning">
        <i class="fa-solid fa-gear"></i> Configuración
      </a>
    </nav>
    
    <!-- Create Event Button -->
    <div class="mt-auto px-6 pb-8">
      <button onclick="crearNuevoEvento()" id="btn-crear-evento" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-secondary to-info text-white rounded-xl font-bold text-lg shadow-lg hover:from-info hover:to-secondary transition-colors duration-200 hover:shadow-secondary/50">
        <i class="fa-solid fa-plus"></i> Nuevo Evento
      </button>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 flex flex-col min-h-screen relative z-10 bg-background/90">
    <!-- Header -->
    <header class="flex items-center justify-between border-b border-accent/20 px-6 py-6 pr-24 bg-card/80 backdrop-blur-xl sticky top-0 z-10" style="border-bottom: 1px solid rgba(255, 64, 129, 0.2); background: linear-gradient(135deg, rgba(26, 26, 46, 0.9) 0%, rgba(22, 33, 62, 0.8) 50%, rgba(15, 15, 35, 0.9) 100%); backdrop-filter: blur(20px);">
      <div class="flex items-center gap-4 text-text">
        <span class="font-black text-xl md:text-2xl bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent">FestiSpot</span>
      </div>
      <div class="flex gap-4 mr-8">
        <button onclick="crearNuevoEvento()" id="btn-crear-evento-header" class="flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-secondary to-info text-white rounded-xl font-bold text-base shadow-lg hover:from-info hover:to-secondary transition-all">
          <i class="fa-solid fa-plus"></i> Crear Evento
        </button>
        <button class="flex items-center gap-2 px-5 py-2 bg-cardLight text-accent border border-accent/40 rounded-xl font-bold text-base shadow hover:bg-accent/10 transition-all">
          <i class="fa-solid fa-file-arrow-down"></i> Descargar Reporte
        </button>
      </div>
    </header>

    <!-- Métricas -->
    <section class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 px-6 pr-24 py-8">
      <div class="bg-card rounded-2xl p-6 flex flex-col items-center shadow-lg border border-cardLight/30">
        <span class="text-3xl text-accent mb-2"><i class="fa-solid fa-calendar-check"></i></span>
        <div class="text-3xl font-bold">{{ $totalEventosActivos ?? 0 }}</div>
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
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 px-6 pr-24 pb-8">
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
    <section class="px-6 pr-24 pb-16">
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
            @forelse($eventosActivos as $evento)
            <tr class="border-t border-card/20 hover:bg-card/30 transition-all">
              <td class="px-6 py-4 font-semibold">{{ $evento->titulo ?? $evento->name }}</td>
              <td class="px-6 py-4">{{ $evento->fecha_inicio ? $evento->fecha_inicio->format('d/m/Y') : 'Por definir' }}</td>
              <td class="px-6 py-4">{{ $evento->ubicacion->direccion ?? $evento->location ?? 'Por definir' }}</td>
              <td class="px-6 py-4 flex gap-2">
                <a href="#" onclick="editarEvento('evento-{{ $evento->id }}')" class="px-3 py-1 bg-info/20 text-info rounded-lg text-sm font-bold hover:bg-info/40 transition-all">
                  <i class="fa-solid fa-pen"></i> Editar
                </a>
                <a href="#" class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-bold hover:bg-accent/40 transition-all">
                  <i class="fa-solid fa-trash"></i> Eliminar
                </a>
              </td>
            </tr>
            @empty
            <tr class="border-t border-card/20">
              <td colspan="4" class="px-6 py-8 text-center text-textMuted">
                <i class="fa-solid fa-calendar-xmark text-4xl mb-4"></i><br>
                No hay eventos activos en este momento.<br>
                <a href="{{ route('event.create') }}" class="text-accent hover:underline">¡Crea tu primer evento aquí!</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Modal para opciones de evento -->
  <div id="modalOpcionesEvento" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center hidden">
    <div class="bg-gradient-to-br from-card/95 to-cardLight/90 backdrop-blur-xl rounded-3xl p-8 border border-cardLight/30 max-w-sm w-full mx-4 shadow-2xl">
      <!-- Header del evento -->
      <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-accent mb-2" id="modalEventTitle">Festival de Música Electrónica</h2>
        <h3 class="text-xl text-secondary mb-4" id="modalEventYear">2024</h3>
        
        <div class="space-y-2 text-sm text-textMuted">
          <div class="flex items-center justify-center gap-2">
            <i class="fa-solid fa-calendar text-accent"></i>
            <span id="modalEventDate">jueves, 21 de agosto de 2025</span>
          </div>
          <div class="flex items-center justify-center gap-2">
            <i class="fa-solid fa-map-marker-alt text-tertiary"></i>
            <span id="modalEventLocation">Explanada Central, Ciudad de México</span>
          </div>
          <div class="flex items-center justify-center gap-2">
            <i class="fa-solid fa-users text-secondary"></i>
            <span id="modalEventAttendees">245 asistentes confirmados</span>
          </div>
        </div>
      </div>
      
      <!-- Título acciones -->
      <div class="text-center mb-6">
        <h4 class="text-lg font-bold text-text">Acciones rápidas</h4>
        <p class="text-sm text-textMuted">Gestiona tu evento fácilmente</p>
      </div>
      
      <!-- Botones de acción -->
      <div class="grid grid-cols-3 gap-4 mb-6">
        <button onclick="modificarEvento()" class="flex flex-col items-center p-4 bg-gradient-to-br from-accent/20 to-accent/10 hover:from-accent/30 hover:to-accent/20 rounded-2xl border border-accent/30 transition-all duration-300 transform hover:scale-105">
          <div class="w-12 h-12 bg-accent rounded-2xl flex items-center justify-center mb-2 shadow-lg">
            <i class="fa-solid fa-edit text-white text-lg"></i>
          </div>
          <span class="text-accent font-bold text-sm">Modificar</span>
          <span class="text-accent/70 text-xs">evento</span>
        </button>
        
        <button onclick="crearAnuncios()" class="flex flex-col items-center p-4 bg-gradient-to-br from-secondary/20 to-secondary/10 hover:from-secondary/30 hover:to-secondary/20 rounded-2xl border border-secondary/30 transition-all duration-300 transform hover:scale-105">
          <div class="w-12 h-12 bg-secondary rounded-2xl flex items-center justify-center mb-2 shadow-lg">
            <i class="fa-solid fa-bullhorn text-white text-lg"></i>
          </div>
          <span class="text-secondary font-bold text-sm">Crear</span>
          <span class="text-secondary/70 text-xs">anuncios</span>
        </button>
        
        <button onclick="verReseñas()" class="flex flex-col items-center p-4 bg-gradient-to-br from-tertiary/20 to-tertiary/10 hover:from-tertiary/30 hover:to-tertiary/20 rounded-2xl border border-tertiary/30 transition-all duration-300 transform hover:scale-105">
          <div class="w-12 h-12 bg-tertiary rounded-2xl flex items-center justify-center mb-2 shadow-lg">
            <i class="fa-solid fa-star text-white text-lg"></i>
          </div>
          <span class="text-tertiary font-bold text-sm">Ver</span>
          <span class="text-tertiary/70 text-xs">reseñas</span>
        </button>
      </div>
      
      <!-- Botón cerrar -->
      <button onclick="cerrarModal()" class="w-full py-3 bg-gradient-to-r from-card/60 to-cardLight/40 text-accent border-2 border-accent/30 rounded-2xl font-bold hover:bg-accent/10 transition-all duration-300">
        Cerrar gestión
      </button>
    </div>
  </div>

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

    // Variable global para el evento actual
    let eventoActualSeleccionado = null;

    // Función para editar evento - ahora muestra el modal
    function editarEvento(eventoId) {
      // Datos de ejemplo para cada evento
      const eventosData = {
        'festival-jazz': {
          id: 1,
          nombre: "Festival Jazz",
          year: "2025",
          categoria: "Música",
          tipo: "Presencial",
          descripcion: "Festival de jazz con artistas internacionales en el Auditorio Nacional.",
          fecha_inicio: "2025-08-22",
          fecha_fin: "2025-08-22",
          hora_inicio: "19:00",
          hora_fin: "23:30",
          lugar: "Auditorio Nacional",
          direccion: "Paseo de la Reforma 50, Bosque de Chapultepec I Secc",
          ciudad: "Ciudad de México",
          estado_evento: "published",
          asistentes: 245,
          dias_restantes: 15,
          puede_modificar_fecha: true,
          puede_modificar_ubicacion: false
        },
        'tech-summit': {
          id: 2,
          nombre: "Tech Summit",
          year: "2025",
          categoria: "Tecnología",
          tipo: "Híbrido",
          descripcion: "Cumbre tecnológica con las últimas innovaciones y tendencias.",
          fecha_inicio: "2025-09-05",
          fecha_fin: "2025-09-06",
          hora_inicio: "09:00",
          hora_fin: "18:00",
          lugar: "Centro de Convenciones",
          direccion: "Av. Conscripto 311, Lomas de Sotelo",
          ciudad: "Ciudad de México",
          estado_evento: "published",
          asistentes: 180,
          dias_restantes: 25,
          puede_modificar_fecha: true,
          puede_modificar_ubicacion: true
        },
        'expo-cultura': {
          id: 3,
          nombre: "Expo Cultura",
          year: "2025",
          categoria: "Arte",
          tipo: "Presencial",
          descripcion: "Exposición cultural con obras de artistas locales e internacionales.",
          fecha_inicio: "2025-09-15",
          fecha_fin: "2025-09-17",
          hora_inicio: "10:00",
          hora_fin: "20:00",
          lugar: "Museo de Arte",
          direccion: "Av. Paseo de la Reforma 51, Bosque de Chapultepec",
          ciudad: "Ciudad de México",
          estado_evento: "published",
          asistentes: 95,
          dias_restantes: 35,
          puede_modificar_fecha: false,
          puede_modificar_ubicacion: false
        }
      };

      const evento = eventosData[eventoId];
      if (evento) {
        // Guardar evento actual
        eventoActualSeleccionado = evento;
        
        // Actualizar contenido del modal
        document.getElementById('modalEventTitle').textContent = evento.nombre;
        document.getElementById('modalEventYear').textContent = evento.year;
        
        // Formatear fecha
        const fecha = new Date(evento.fecha_inicio);
        const fechaFormateada = fecha.toLocaleDateString('es-ES', {
          weekday: 'long',
          day: 'numeric',
          month: 'long',
          year: 'numeric'
        });
        document.getElementById('modalEventDate').textContent = fechaFormateada;
        document.getElementById('modalEventLocation').textContent = `${evento.lugar}, ${evento.ciudad}`;
        document.getElementById('modalEventAttendees').textContent = `${evento.asistentes} asistentes confirmados`;
        
        // Mostrar modal
        document.getElementById('modalOpcionesEvento').classList.remove('hidden');
      } else {
        alert('Evento no encontrado');
      }
    }

    // Funciones del modal
    function modificarEvento() {
      if (eventoActualSeleccionado) {
        // Guardar datos del evento en localStorage para la página de modificación
        localStorage.setItem('eventoActual', JSON.stringify(eventoActualSeleccionado));
        
        // Cerrar modal y redirigir
        cerrarModal();
        
        // Mostrar mensaje de carga
        const loadingMessage = document.createElement('div');
        loadingMessage.innerHTML = `
          <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center">
            <div class="bg-card/90 backdrop-blur-xl rounded-2xl p-8 border border-cardLight/30 text-center">
              <div class="text-4xl mb-4">⏳</div>
              <div class="text-xl font-bold text-accent mb-2">Cargando evento...</div>
              <div class="text-textMuted">Preparando interfaz de modificación</div>
            </div>
          </div>
        `;
        document.body.appendChild(loadingMessage);
        
        // Redirigir después de un breve delay
        setTimeout(() => {
          window.location.href = '/event/modify';
        }, 800);
      }
    }

    function crearAnuncios() {
      cerrarModal();
      alert('🔔 Funcionalidad de crear anuncios próximamente disponible');
    }

    function verReseñas() {
      cerrarModal();
      alert('⭐ Funcionalidad de ver reseñas próximamente disponible');
    }

    function cerrarModal() {
      document.getElementById('modalOpcionesEvento').classList.add('hidden');
      eventoActualSeleccionado = null;
    }

    // Cerrar modal al hacer clic fuera
    document.addEventListener('click', function(e) {
      const modal = document.getElementById('modalOpcionesEvento');
      if (e.target === modal) {
        cerrarModal();
      }
    });
  </script>
</body>
</html>
