class EventModification {
    constructor() {
        this.originalData = {};
        this.hasChanges = false;
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.setupFormValidation();
        this.trackChanges();
    }
    
    setupEventListeners() {
        const form = document.getElementById('modificationForm');
        if (form) {
            form.addEventListener('submit', (e) => this.handleSubmit(e));
        }
        
        // Track all form inputs for changes
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            // Store original values
            this.originalData[input.name] = input.value;
            
            // Add change listeners
            input.addEventListener('input', () => this.trackChanges());
            input.addEventListener('change', () => this.trackChanges());
        });
    }
    
    setupFormValidation() {
        // Set minimum dates for date inputs
        const today = new Date().toISOString().split('T')[0];
        const dateStart = document.getElementById('dateStart');
        const dateEnd = document.getElementById('dateEnd');
        
        if (dateStart) dateStart.min = today;
        if (dateEnd) dateEnd.min = today;
        
        // Validate date range
        if (dateStart && dateEnd) {
            dateStart.addEventListener('change', () => this.validateDateRange());
            dateEnd.addEventListener('change', () => this.validateDateRange());
        }
        
        // Validate time range
        const timeStart = document.getElementById('timeStart');
        const timeEnd = document.getElementById('timeEnd');
        
        if (timeStart && timeEnd) {
            timeStart.addEventListener('change', () => this.validateTimeRange());
            timeEnd.addEventListener('change', () => this.validateTimeRange());
        }
    }
    
    validateDateRange() {
        const dateStart = document.getElementById('dateStart');
        const dateEnd = document.getElementById('dateEnd');
        
        if (dateStart.value && dateEnd.value) {
            if (new Date(dateStart.value) > new Date(dateEnd.value)) {
                dateEnd.setCustomValidity('La fecha de fin debe ser posterior a la fecha de inicio');
            } else {
                dateEnd.setCustomValidity('');
            }
        }
    }
    
    validateTimeRange() {
        const dateStart = document.getElementById('dateStart');
        const dateEnd = document.getElementById('dateEnd');
        const timeStart = document.getElementById('timeStart');
        const timeEnd = document.getElementById('timeEnd');
        
        // Only validate time if it's the same day
        if (dateStart.value === dateEnd.value && timeStart.value && timeEnd.value) {
            if (timeStart.value >= timeEnd.value) {
                timeEnd.setCustomValidity('La hora de fin debe ser posterior a la hora de inicio');
            } else {
                timeEnd.setCustomValidity('');
            }
        } else {
            timeEnd.setCustomValidity('');
        }
    }
    
    trackChanges() {
        const form = document.getElementById('modificationForm');
        const inputs = form.querySelectorAll('input, select, textarea');
        let hasChanges = false;
        
        inputs.forEach(input => {
            if (input.name && this.originalData[input.name] !== undefined) {
                if (input.value !== this.originalData[input.name]) {
                    hasChanges = true;
                }
            }
        });
        
        this.hasChanges = hasChanges;
        this.updateUI();
    }
    
    updateUI() {
        // Could add visual indicators for changed fields
        // Or update submit button state
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            if (this.hasChanges) {
                submitBtn.classList.remove('opacity-50');
                submitBtn.disabled = false;
            }
        }
    }
    
    async handleSubmit(e) {
        e.preventDefault();
        
        // Validate required change reason
        const changeType = document.getElementById('changeType').value;
        const changeReason = document.getElementById('changeReason').value;
        
        if (!changeType || !changeReason.trim()) {
            alert('Debes especificar el motivo del cambio antes de guardar.');
            return;
        }
        
        if (!this.hasChanges) {
            alert('No se han detectado cambios en el evento.');
            return;
        }
        
        if (!confirm('¿Estás seguro de que quieres guardar estos cambios? Se notificará a todos los involucrados.')) {
            return;
        }
        
        try {
            await this.saveChanges();
        } catch (error) {
            console.error('Error saving changes:', error);
            alert('Error al guardar los cambios. Por favor, intenta de nuevo.');
        }
    }
    
    async saveChanges() {
        const formData = new FormData(document.getElementById('modificationForm'));
        
        // Show loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '⏳ Guardando...';
        submitBtn.disabled = true;
        
        try {
            // Simulate API call
            await new Promise(resolve => setTimeout(resolve, 2000));
            
            // Show success message
            alert('✅ Cambios guardados exitosamente. Se han enviado las notificaciones correspondientes.');
            
            // Redirect to events list
            window.location.href = '/events/modify';
            
        } catch (error) {
            throw error;
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }
}

// Global functions
function previewChanges() {
    const form = document.getElementById('modificationForm');
    const formData = new FormData(form);
    
    let preview = '📋 VISTA PREVIA DE CAMBIOS:\n\n';
    
    // Basic info
    preview += `📝 Nombre: ${formData.get('event_name')}\n`;
    preview += `📂 Categoría: ${formData.get('event_category')}\n`;
    preview += `📊 Estado: ${formData.get('event_status')}\n`;
    preview += `📝 Descripción: ${formData.get('event_description')?.substring(0, 100)}...\n\n`;
    
    // Date and time
    preview += `📅 Fecha inicio: ${formData.get('date_start')}\n`;
    preview += `📅 Fecha fin: ${formData.get('date_end')}\n`;
    preview += `⏰ Hora inicio: ${formData.get('time_start')}\n`;
    preview += `⏰ Hora fin: ${formData.get('time_end')}\n\n`;
    
    // Change reason
    preview += `📝 Tipo de cambio: ${formData.get('change_type')}\n`;
    preview += `📝 Motivo: ${formData.get('change_reason')}\n\n`;
    
    // Notifications
    preview += `🔔 Notificaciones:\n`;
    preview += `👥 Asistentes: ${formData.get('notify_attendees') ? 'Sí' : 'No'}\n`;
    preview += `🎬 Productores: ${formData.get('notify_producers') ? 'Sí' : 'No'}\n`;
    
    alert(preview);
}

// Initialize when DOM is loaded
let eventModification;
document.addEventListener('DOMContentLoaded', function() {
    eventModification = new EventModification();
});
