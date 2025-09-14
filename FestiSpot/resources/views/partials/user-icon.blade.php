<!-- User Icon Component - Minimalista y Moderno -->
<div class="user-icon-wrapper">
    <!-- Botón de Usuario -->
    <div class="user-icon-container" onclick="toggleUserDropdown()">
        <div class="user-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="user-icon-indicator"></div>
    </div>
    
    <!-- Menú Desplegable -->
    <div class="user-dropdown" id="userDropdown">
        <div class="dropdown-header">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name ?? 'Usuario' }}</span>
                <span class="user-role">Organizador</span>
            </div>
        </div>
        
        <div class="dropdown-divider"></div>
        
        <!-- Opciones del menú -->
        <div class="dropdown-menu">
            <!-- Configuración de la cuenta -->
            <a href="{{ route('configuration') }}" class="dropdown-item">
                <div class="dropdown-icon">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="dropdown-content">
                    <span class="item-title">Configuración de la cuenta</span>
                    <span class="item-subtitle">Gestionar preferencias</span>
                </div>
                <i class="fas fa-chevron-right item-arrow"></i>
            </a>
            
            <!-- Cerrar sesión -->
            <form method="POST" action="{{ route('logout') }}" class="dropdown-form">
                @csrf
                <button type="submit" class="dropdown-item logout-item">
                    <div class="dropdown-icon logout-icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <div class="dropdown-content">
                        <span class="item-title">Cerrar sesión</span>
                        <span class="item-subtitle">Salir de la cuenta</span>
                    </div>
                    <i class="fas fa-chevron-right item-arrow"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
/* User Icon Styles - Diseño Minimalista Integrado */
.user-icon-wrapper {
    position: relative;
    z-index: 1000;
}

.user-icon-container {
    position: relative;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.user-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(22, 33, 62, 0.95) 0%, rgba(30, 39, 73, 0.95) 100%);
    border: 2px solid rgba(255, 64, 129, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 20px;
    transition: all 0.3s ease;
    backdrop-filter: blur(20px);
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.4),
        0 4px 16px rgba(255, 64, 129, 0.3),
        0 0 0 1px rgba(255, 64, 129, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.15);
}

.user-icon-container:hover .user-icon {
    border-color: rgba(255, 64, 129, 0.8);
    background: linear-gradient(135deg, rgba(255, 64, 129, 0.25) 0%, rgba(0, 229, 255, 0.15) 100%);
    transform: scale(1.08);
    box-shadow: 
        0 12px 40px rgba(0, 0, 0, 0.5),
        0 8px 32px rgba(255, 64, 129, 0.4),
        0 0 0 1px rgba(255, 64, 129, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
}

.user-icon-indicator {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: linear-gradient(135deg, #00e5ff 0%, #ff4081 100%);
    border: 2px solid rgba(10, 10, 15, 0.8);
    animation: pulse-indicator 2s infinite;
}

@keyframes pulse-indicator {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.2); opacity: 0.8; }
}

/* Dropdown Styles */
.user-dropdown {
    position: absolute;
    top: 56px;
    right: 0;
    width: 300px;
    background: rgba(22, 33, 62, 0.98);
    border: 1px solid rgba(255, 64, 129, 0.3);
    border-radius: 18px;
    backdrop-filter: blur(25px);
    box-shadow: 
        0 25px 60px rgba(0, 0, 0, 0.4),
        0 15px 35px rgba(255, 64, 129, 0.2),
        0 0 0 1px rgba(255, 64, 129, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.12);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-15px) scale(0.92);
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    z-index: 99999;
}

.user-dropdown.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.dropdown-header {
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255, 64, 129, 0.2) 0%, rgba(0, 229, 255, 0.2) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 18px;
    border: 1px solid rgba(255, 64, 129, 0.3);
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-size: 16px;
    font-weight: 600;
    color: #ffffff;
    line-height: 1.2;
}

.user-role {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.6);
    font-weight: 400;
}

.dropdown-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, rgba(255, 64, 129, 0.3) 50%, transparent 100%);
    margin: 0 20px;
}

.dropdown-menu {
    padding: 16px;
}

.dropdown-form {
    margin: 0;
    padding: 0;
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-radius: 12px;
    text-decoration: none;
    color: #ffffff;
    transition: all 0.2s ease;
    border: none;
    background: none;
    width: 100%;
    cursor: pointer;
    font-family: inherit;
    position: relative;
    overflow: hidden;
}

.dropdown-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 64, 129, 0.1) 0%, rgba(0, 229, 255, 0.1) 100%);
    opacity: 0;
    transition: opacity 0.2s ease;
}

.dropdown-item:hover::before {
    opacity: 1;
}

.dropdown-item:hover {
    transform: translateX(4px);
}

.logout-item:hover::before {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
}

.dropdown-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
    transition: all 0.2s ease;
}

.logout-icon {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

.dropdown-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 1;
}

.item-title {
    font-size: 14px;
    font-weight: 500;
    line-height: 1.2;
    margin-bottom: 2px;
}

.item-subtitle {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.6);
    font-weight: 400;
}

.item-arrow {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.4);
    transition: all 0.2s ease;
    position: relative;
    z-index: 1;
}

.dropdown-item:hover .item-arrow {
    color: rgba(255, 255, 255, 0.8);
    transform: translateX(2px);
}

/* Responsive */
@media (max-width: 640px) {
    .user-dropdown {
        width: 260px;
        right: -10px;
    }
    
    .dropdown-header {
        padding: 16px;
    }
    
    .dropdown-menu {
        padding: 12px;
    }
}

/* Animation para entrada suave */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(-10px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.user-dropdown.show {
    animation: fadeInUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>

<script>
// JavaScript para funcionalidad del menú de usuario
let isDropdownOpen = false;

function toggleUserDropdown() {
    const dropdown = document.getElementById('userDropdown');
    
    if (isDropdownOpen) {
        closeUserDropdown();
    } else {
        openUserDropdown();
    }
}

function openUserDropdown() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.add('show');
    isDropdownOpen = true;
    
    // Agregar event listener para cerrar al hacer click fuera
    setTimeout(() => {
        document.addEventListener('click', closeOnClickOutside);
    }, 100);
}

function closeUserDropdown() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.remove('show');
    isDropdownOpen = false;
    
    // Remover event listener
    document.removeEventListener('click', closeOnClickOutside);
}

function closeOnClickOutside(event) {
    const userIconWrapper = event.target.closest('.user-icon-wrapper');
    
    if (!userIconWrapper && isDropdownOpen) {
        closeUserDropdown();
    }
}

// Cerrar dropdown con Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && isDropdownOpen) {
        closeUserDropdown();
    }
});

// Prevenir que el click en el dropdown lo cierre
document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.getElementById('userDropdown');
    if (dropdown) {
        dropdown.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }
});
</script>