<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FestiSpot')</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    
    <!-- Critical inline styles -->
    <style>
      html, body {
        background-color: #0a0a0f;
        color: #ffffff;
        margin: 0;
        padding: 0;
      }
      
      /* Loading Animation - Solo para navegación */
      .page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #0a0a0f 0%, #16213e 50%, #0a0a0f 100%);
        z-index: 9999;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 1;
        transition: opacity 0.3s ease;
      }
      
      .page-loader.fade-out {
        opacity: 0;
        pointer-events: none;
      }
      
      /* Logo animation */
      .loader-logo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-bottom: 15px;
        animation: pulse-glow 1s ease-in-out infinite;
        box-shadow: 0 0 20px rgba(255, 64, 129, 0.5);
      }
      
      @keyframes pulse-glow {
        0% { 
          transform: scale(1);
          box-shadow: 0 0 20px rgba(255, 64, 129, 0.5);
        }
        50% { 
          transform: scale(1.03);
          box-shadow: 0 0 30px rgba(255, 64, 129, 0.7);
        }
        100% { 
          transform: scale(1);
          box-shadow: 0 0 20px rgba(255, 64, 129, 0.5);
        }
      }
      
      /* Text animation */
      .loader-text {
        font-size: 20px;
        font-weight: bold;
        background: linear-gradient(45deg, #ff4081, #00e5ff, #7c4dff, #ff4081);
        background-size: 300% 300%;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradient-flow 1.5s ease-in-out infinite;
        margin-bottom: 5px;
      }
      
      @keyframes gradient-flow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
      }
      
      /* Loading dots */
      .loader-dots {
        display: flex;
        gap: 6px;
        margin-top: 10px;
      }
      
      .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #ff4081;
        animation: bounce-dots 0.8s ease-in-out infinite both;
      }
      
      .dot:nth-child(1) { animation-delay: -0.2s; }
      .dot:nth-child(2) { animation-delay: -0.1s; }
      .dot:nth-child(3) { animation-delay: 0s; }
      
      @keyframes bounce-dots {
        0%, 80%, 100% { 
          transform: scale(0.8);
          opacity: 0.5;
        }
        40% { 
          transform: scale(1.1);
          opacity: 1;
        }
      }
      
      /* Progress bar */
      .progress-container {
        width: 150px;
        height: 2px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 2px;
        margin-top: 15px;
        overflow: hidden;
      }
      
      .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #ff4081, #00e5ff);
        border-radius: 2px;
        width: 0%;
        animation: progress-fill 0.8s ease-in-out;
      }
      
      @keyframes progress-fill {
        0% { width: 0%; }
        100% { width: 100%; }
      }
    </style>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="{{ asset('assets/images/logo-festispot.png') }}" as="image">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin />
    
    <!-- Load styles immediately -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?display=swap&family=Inter:wght@400;500;700;900&family=Noto+Sans:wght@400;500;700;900" />
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
<body class="bg-background text-text min-h-screen relative overflow-x-hidden">
    <!-- Efectos de fondo -->
    <div class="fixed inset-0 opacity-10 pointer-events-none z-0">
        <div class="absolute top-0 left-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-tertiary rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>
  <!-- Menú de navegación -->
  <div class="relative z-10">
    @yield('content')
  </div>
  <script>
  // Sistema de carga SOLO para navegación al inicio
  document.addEventListener('DOMContentLoaded', function() {
    // Resaltar enlace activo
    const path = window.location.pathname.replace(/\/$/, '');
    document.querySelectorAll('.nav-link').forEach(link => {
      if (
        (path === '' && link.getAttribute('href') === '/') ||
        (link.getAttribute('href') !== '/' && path.startsWith(link.getAttribute('href')))
      ) {
        link.classList.add('text-accent');
      }
    });
    
    // Si hay un loader inicial, ocultarlo rápido
    const initialLoader = document.getElementById('pageLoader');
    if (initialLoader) {
      setTimeout(() => {
        initialLoader.classList.add('fade-out');
        setTimeout(() => initialLoader.remove(), 300);
      }, 500);
    }
  });
  
  // Función SOLO para navegación al inicio
  function showHomeLoader() {
    // Crear loader temporal solo para navegación
    const loader = document.createElement('div');
    loader.className = 'page-loader';
    loader.innerHTML = `
      <img src="{{ asset('assets/images/logo-festispot.png') }}" alt="FestiSpot" class="loader-logo">
      <div class="loader-text">FestiSpot</div>
      <div class="text-sm text-gray-400">Cargando inicio...</div>
      <div class="loader-dots">
          <div class="dot"></div>
          <div class="dot"></div>
          <div class="dot"></div>
      </div>
      <div class="progress-container">
          <div class="progress-bar"></div>
      </div>
    `;
    document.body.appendChild(loader);
    
    // Ocultar después de navegación
    setTimeout(() => {
      loader.classList.add('fade-out');
      setTimeout(() => loader.remove(), 300);
    }, 800);
  }
  
  // SOLO detectar clics específicos al inicio
  document.addEventListener('click', function(e) {
    const target = e.target.closest('a, button');
    if (target) {
      const href = target.getAttribute('href');
      const text = target.textContent;
      
      // Solo activar para enlaces específicos de inicio
      if (href === '/' || href === '#' || text.includes('Inicio') || target.id === 'logo-home') {
        e.preventDefault();
        showHomeLoader();
        setTimeout(() => {
          window.location.href = '/';
        }, 200);
      }
    }
  });
  </script>
</body>
</html>
