<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FestiSpot')</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
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
</head>
<body class="bg-background text-text min-h-screen relative overflow-x-hidden">
    <!-- Efectos de fondo -->
    <div class="fixed inset-0 opacity-10 pointer-events-none z-0">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>
    
    <!-- Menú de navegación - Solo mostrar si no está definida la sección no_global_header -->
    @if(!View::hasSection('no_global_header'))
    <nav class="relative z-20 w-full flex items-center justify-between px-8 py-4 bg-gradient-to-r from-card to-purple/20 border-b border-cardLight/30 shadow-lg">
        <div class="flex items-center gap-3">
            <span class="text-2xl font-black bg-gradient-to-r from-accent via-secondary to-tertiary bg-clip-text text-transparent tracking-tight">FestiSpot</span>
        </div>
        <div class="flex gap-6 text-lg font-semibold">
            <a href="/" class="nav-link transition-colors duration-200 hover:text-accent">Inicio</a>
            <a href="/mis-eventos" class="nav-link transition-colors duration-200 hover:text-accent">Mis Eventos</a>
            <a href="/solicitudes-productores" class="nav-link transition-colors duration-200 hover:text-accent">Solicitudes</a>
        </div>
    </nav>
    @endif
    
    <div class="relative z-10">
        @yield('content')
    </div>
    
    <script>
        // Resaltar enlace activo
        document.addEventListener('DOMContentLoaded', function() {
            const path = window.location.pathname.replace(/\/$/, '');
            document.querySelectorAll('.nav-link').forEach(link => {
                if (
                    (path === '' && link.getAttribute('href') === '/') ||
                    (link.getAttribute('href') !== '/' && path.startsWith(link.getAttribute('href')))
                ) {
                    link.classList.add('text-accent');
                }
            });
        });
    </script>
</body>
</html>
