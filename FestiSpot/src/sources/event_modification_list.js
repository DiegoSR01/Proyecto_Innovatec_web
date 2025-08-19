class EventModificationList {
    constructor() {
        this.events = [];
        this.filteredEvents = [];
        this.isLoading = false;
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.loadEvents();
        this.setMinDate();
    }
    
    setupEventListeners() {
        // Search input
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', this.debounce(() => {
                this.applyFilters();
            }, 300));
        }
        
        // Filters
        const categoryFilter = document.getElementById('categoryFilter');
        const typeFilter = document.getElementById('typeFilter');
        const dateFrom = document.getElementById('dateFrom');
        const dateTo = document.getElementById('dateTo');
        
        [categoryFilter, typeFilter, dateFrom, dateTo].forEach(filter => {
            if (filter) {
                filter.addEventListener('change', () => this.applyFilters());
            }
        });
    }
    
    setMinDate() {
        const today = new Date().toISOString().split('T')[0];
        const dateFrom = document.getElementById('dateFrom');
        const dateTo = document.getElementById('dateTo');
        
        if (dateFrom) dateFrom.min = today;
        if (dateTo) dateTo.min = today;
    }
    
    async loadEvents() {
        this.showLoading(true);
        
        try {
            // Simulación de datos - reemplazar con llamada real a la API
            await this.simulateAPICall();
            
            this.events = this.getSimulatedEvents();
            this.applyFilters();
            
        } catch (error) {
            console.error('Error loading events:', error);
            this.showError('Error al cargar los eventos. Por favor, intenta de nuevo.');
        } finally {
            this.showLoading(false);
        }
    }
    
    simulateAPICall() {
        return new Promise(resolve => setTimeout(resolve, 1500));
    }
    
    getSimulatedEvents() {
        const today = new Date();
        const futureDate1 = new Date(today.getTime() + 7 * 24 * 60 * 60 * 1000); // +1 week
        const futureDate2 = new Date(today.getTime() + 14 * 24 * 60 * 60 * 1000); // +2 weeks
        const futureDate3 = new Date(today.getTime() + 30 * 24 * 60 * 60 * 1000); // +1 month
        const futureDate4 = new Date(today.getTime() + 45 * 24 * 60 * 60 * 1000); // +45 days
        const futureDate5 = new Date(today.getTime() + 21 * 24 * 60 * 60 * 1000); // +3 weeks
        
        return [
            {
                id: 1,
                name: 'Festival de Música Electrónica 2024',
                category: 'Música',
                type: 'Presencial',
                location: 'Ciudad de México, México',
                date_start: futureDate1.toISOString().split('T')[0],
                date_end: futureDate1.toISOString().split('T')[0],
                time_start: '20:00',
                time_end: '02:00',
                attendees: 245,
                status: 'published',
                can_modify_date: true,
                can_modify_location: false,
                can_modify_basic: true,
                days_until_event: 7
            },
            {
                id: 2,
                name: 'Conferencia de Tecnología Web',
                category: 'Tecnología',
                type: 'Híbrido',
                location: 'Guadalajara, México / Virtual',
                date_start: futureDate2.toISOString().split('T')[0],
                date_end: futureDate2.toISOString().split('T')[0],
                time_start: '09:00',
                time_end: '18:00',
                attendees: 89,
                status: 'published',
                can_modify_date: true,
                can_modify_location: true,
                can_modify_basic: true,
                days_until_event: 14
            },
            {
                id: 3,
                name: 'Obra de Teatro: El Sueño de una Noche',
                category: 'Teatro',
                type: 'Presencial',
                location: 'Teatro Nacional, Monterrey',
                date_start: futureDate3.toISOString().split('T')[0],
                date_end: futureDate3.toISOString().split('T')[0],
                time_start: '19:30',
                time_end: '22:00',
                attendees: 156,
                status: 'published',
                can_modify_date: false,
                can_modify_location: false,
                can_modify_basic: true,
                days_until_event: 30
            },
            {
                id: 4,
                name: 'Workshop de Arte Digital',
                category: 'Arte',
                type: 'Virtual',
                location: 'Zoom / Plataforma Virtual',
                date_start: futureDate4.toISOString().split('T')[0],
                date_end: futureDate4.toISOString().split('T')[0],
                time_start: '14:00',
                time_end: '17:00',
                attendees: 45,
                status: 'published',
                can_modify_date: true,
                can_modify_location: true,
                can_modify_basic: true,
                days_until_event: 45
            },
            {
                id: 5,
                name: 'Torneo de Videojuegos FestiSpot Cup',
                category: 'Deportes',
                type: 'Híbrido',
                location: 'Centro de Convenciones / Twitch',
                date_start: futureDate5.toISOString().split('T')[0],
                date_end: futureDate5.toISOString().split('T')[0],
                time_start: '10:00',
                time_end: '22:00',
                attendees: 320,
                status: 'published',
                can_modify_date: true,
                can_modify_location: false,
                can_modify_basic: true,
                days_until_event: 21
            }
        ];
    }
    
    applyFilters() {
        const searchTerm = document.getElementById('searchInput')?.value.toLowerCase() || '';
        const categoryFilter = document.getElementById('categoryFilter')?.value || '';
        const typeFilter = document.getElementById('typeFilter')?.value || '';
        const dateFrom = document.getElementById('dateFrom')?.value || '';
        const dateTo = document.getElementById('dateTo')?.value || '';
        
        this.filteredEvents = this.events.filter(event => {
            const matchesSearch = !searchTerm || 
                event.name.toLowerCase().includes(searchTerm) ||
                event.category.toLowerCase().includes(searchTerm) ||
                event.location.toLowerCase().includes(searchTerm);
            
            const matchesCategory = !categoryFilter || event.category === categoryFilter;
            const matchesType = !typeFilter || event.type === typeFilter;
            
            const eventDate = new Date(event.date_start);
            const fromDate = dateFrom ? new Date(dateFrom) : null;
            const toDate = dateTo ? new Date(dateTo) : null;
            
            const matchesDateFrom = !fromDate || eventDate >= fromDate;
            const matchesDateTo = !toDate || eventDate <= toDate;
            
            return matchesSearch && matchesCategory && matchesType && matchesDateFrom && matchesDateTo;
        });
        
        this.renderEvents();
    }
    
    renderEvents() {
        const container = document.getElementById('eventsContainer');
        const noEventsState = document.getElementById('noEventsState');
        
        if (this.filteredEvents.length === 0) {
            container.classList.add('hidden');
            noEventsState.classList.remove('hidden');
            return;
        }
        
        noEventsState.classList.add('hidden');
        container.classList.remove('hidden');
        
        container.innerHTML = this.filteredEvents.map(event => this.renderEventCard(event)).join('');
    }
    
    renderEventCard(event) {
        const formattedDate = new Date(event.date_start).toLocaleDateString('es-ES', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        const urgencyClass = event.days_until_event <= 7 ? 'border-warning/50 bg-warning/5' : 
                            event.days_until_event <= 14 ? 'border-info/50 bg-info/5' : 
                            'border-success/50 bg-success/5';
        
        const modificationRestrictions = [];
        if (!event.can_modify_date) modificationRestrictions.push('📅 Fecha');
        if (!event.can_modify_location) modificationRestrictions.push('📍 Ubicación');
        
        const restrictionsText = modificationRestrictions.length > 0 
            ? `⚠️ No modificables: ${modificationRestrictions.join(', ')}` 
            : '✅ Todos los campos modificables';
        
        return `
            <div class="bg-gradient-to-br from-cardLight/40 to-card/60 backdrop-blur-lg border ${urgencyClass} rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div class="flex-1 space-y-3">
                        <div class="flex flex-wrap items-center gap-3">
                            <h3 class="text-xl font-bold text-text">${event.name}</h3>
                            <span class="px-3 py-1 bg-accent/20 text-accent rounded-lg text-sm font-medium">
                                ${this.getCategoryIcon(event.category)} ${event.category}
                            </span>
                            <span class="px-3 py-1 bg-secondary/20 text-secondary rounded-lg text-sm font-medium">
                                ${this.getTypeIcon(event.type)} ${event.type}
                            </span>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-4 text-textMuted">
                            <div class="flex items-center gap-2">
                                <span class="text-info">📅</span>
                                <span>${formattedDate}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-tertiary">⏰</span>
                                <span>${event.time_start} - ${event.time_end}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-warning">📍</span>
                                <span>${event.location}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-success">👥</span>
                                <span>${event.attendees} asistentes confirmados</span>
                            </div>
                        </div>
                        
                        <div class="text-sm ${modificationRestrictions.length > 0 ? 'text-warning' : 'text-success'}">
                            ${restrictionsText}
                        </div>
                        
                        <div class="text-sm">
                            <span class="text-textMuted">Días hasta el evento:</span>
                            <span class="font-bold ${event.days_until_event <= 7 ? 'text-warning' : event.days_until_event <= 14 ? 'text-info' : 'text-success'}">
                                ${event.days_until_event} días
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button onclick="viewEventDetails(${event.id})" 
                                class="px-4 py-2 bg-info/20 text-info border border-info/30 rounded-lg hover:bg-info hover:text-white transition-all duration-300 font-medium">
                            👁️ Ver Detalles
                        </button>
                        <button onclick="modifyEvent(${event.id})" 
                                class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-secondary transition-all duration-300 font-medium shadow-lg">
                            ✏️ Modificar
                        </button>
                    </div>
                </div>
            </div>
        `;
    }
    
    getCategoryIcon(category) {
        const icons = {
            'Música': '🎵', 'Teatro': '🎭', 'Danza': '💃', 'Arte': '🎨',
            'Tecnología': '💻', 'Educación': '📚', 'Deportes': '⚽',
            'Gastronomía': '🍽️', 'Negocios': '💼', 'Otro': '📦'
        };
        return icons[category] || '📦';
    }
    
    getTypeIcon(type) {
        const icons = { 'Presencial': '🏢', 'Virtual': '💻', 'Híbrido': '🌐' };
        return icons[type] || '🌐';
    }
    
    showLoading(show) {
        const loadingState = document.getElementById('loadingState');
        const eventsContainer = document.getElementById('eventsContainer');
        const noEventsState = document.getElementById('noEventsState');
        
        if (show) {
            loadingState.classList.remove('hidden');
            eventsContainer.classList.add('hidden');
            noEventsState.classList.add('hidden');
        } else {
            loadingState.classList.add('hidden');
        }
    }
    
    showError(message) {
        alert(message);
    }
    
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

// Global functions
function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('categoryFilter').value = '';
    document.getElementById('typeFilter').value = '';
    document.getElementById('dateFrom').value = '';
    document.getElementById('dateTo').value = '';
    
    eventModificationList.applyFilters();
}

function viewEventDetails(eventId) {
    alert(`Ver detalles del evento ${eventId} - Esta funcionalidad se implementará próximamente`);
}

function modifyEvent(eventId) {
    // Store the event ID in localStorage for the modify page
    localStorage.setItem('modifyEventId', eventId);
    window.location.href = `/events/modify/${eventId}`;
}

// Initialize when DOM is loaded
let eventModificationList;
document.addEventListener('DOMContentLoaded', function() {
    eventModificationList = new EventModificationList();
});
