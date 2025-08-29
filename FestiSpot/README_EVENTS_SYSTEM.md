# 📖 README - Sistema de Publicación de Eventos FestiSpot

## 🎯 Descripción General

Este README documenta la implementación completa del sistema de publicación y gestión de eventos en FestiSpot, que permite a los usuarios crear, guardar, visualizar y eliminar eventos utilizando una base de datos persistente.

## 🔧 Implementación Realizada

### 1. Base de Datos

#### Migración de Eventos
```bash
php artisan make:migration create_events_table
```

**Campos de la tabla `events`:**
- `id` - Primary key
- `user_id` - Foreign key a users (relación)
- `name` - Nombre del evento
- `description` - Descripción del evento
- `category` - Categoría del evento
- `start_date` / `end_date` - Fechas inicio y fin
- `start_time` / `end_time` - Horarios
- `repeat_schedule` - Boolean para repetir horario
- `event_type` - Enum: 'Presencial', 'Virtual', 'Híbrido'
- `venue_name` - Nombre del lugar
- `full_address` - Dirección completa
- `city`, `state`, `country`, `postal_code` - Ubicación
- `location_details` - Detalles adicionales
- `capacity` - Capacidad del evento
- `accessible` - Boolean para accesibilidad
- `virtual_platform` - Plataforma virtual
- `event_link` - Link del evento virtual
- `access_code` - Código de acceso
- `virtual_password` - Contraseña virtual
- `virtual_instructions` - Instrucciones virtuales
- `banner_image` - Imagen principal
- `gallery_images` - JSON array de imágenes
- `videos` - JSON array de videos
- `status` - Enum: 'draft', 'published', 'cancelled', 'completed'
- `timestamps` - created_at, updated_at

#### Modelo Event
```bash
php artisan make:model Event
```

**Características del modelo:**
- Fillable con todos los campos editables
- Casts para conversión automática de tipos
- Relación belongsTo con User
- Scopes: `published()`, `byUser()`
- Accessors: `getDateRangeAttribute()`, `getTimeRangeAttribute()`

#### Usuario de Prueba
```bash
php artisan make:seeder TestUserSeeder
php artisan db:seed --class=TestUserSeeder
```

### 2. Controlador EventController

#### Métodos Implementados:

**`store(Request $request)`**
- Recoge datos de sesiones PHP
- Valida completitud de datos
- Convierte formato sesión → BD
- Crea evento con Event::create()
- Limpia sesiones
- Retorna JSON response

**`myEvents()`**
- Consulta eventos del usuario desde BD
- Ordena por fecha de creación
- Pasa datos a vista mis_eventos

**`destroy(Event $event)`**
- Verifica permisos de usuario
- Elimina archivos asociados
- Borra registro de BD
- Retorna confirmación JSON

### 3. Rutas Actualizadas

**Archivo: `routes/web.php`**
```php
// Import al inicio del archivo
use App\Http\Controllers\EventController;

// Rutas de eventos
Route::prefix('event')->name('event.')->controller(EventController::class)->group(function () {
    // ... rutas existentes ...
    Route::post('/store', 'store')->name('store');
    Route::delete('/{event}', 'destroy')->name('destroy');
});

// Mis eventos conectado al controlador
Route::get('/mis-eventos', [EventController::class, 'myEvents'])->name('mis.eventos');
```

### 4. Vista de Resumen Actualizada

**Archivo: `resources/views/event_summary.blade.php`**

**Cambios realizados:**
- Botón cambiado de "Guardar Evento" a "🚀 Publicar Evento"
- JavaScript `guardarEvento()` implementado
- Envío de datos via fetch POST a `/event/store`
- Manejo de estados de carga y errores
- Redirección automática a mis eventos

### 5. Vista Mis Eventos Dinámica

**Archivo: `resources/views/mis_eventos.blade.php`**

**Reemplazos realizados:**
- Eventos estáticos → datos dinámicos desde BD
- Loop `@forelse($events as $event)`
- Información real: nombre, fechas, ubicación, categoría
- Estados visuales según status del evento
- Botones funcionales para editar/eliminar
- Mensaje cuando no hay eventos

**JavaScript agregado:**
```javascript
function eliminarEvento(eventoId) {
    if (confirm('¿Estás seguro?')) {
        fetch(`/event/${eventoId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-Token': csrfToken }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
    }
}
```

### 6. Configuración de Seguridad

**CSRF Token:**
```php
// En layouts/app.blade.php
<meta name="csrf-token" content="{{ csrf_token() }}">
```

**Storage Setup:**
```bash
php artisan storage:link
# Directorios creados:
# storage/app/public/events/banners/
# storage/app/public/events/gallery/
# storage/app/public/events/videos/
```

## 🔄 Flujo de Funcionamiento

### Crear y Publicar Evento:
1. Usuario navega a `/event/create`
2. Completa 4 pasos del formulario
3. Cada paso guarda en sesiones PHP temporales
4. En resumen, hace clic en "🚀 Publicar Evento"
5. JavaScript envía POST a `/event/store`
6. Controlador procesa y guarda en BD
7. Limpia sesiones y redirige a mis eventos

### Ver Eventos:
1. Usuario va a `/mis-eventos`
2. Controlador consulta BD con `Event::byUser()`
3. Vista muestra eventos reales
4. Información dinámica desde modelo

### Eliminar Evento:
1. Clic en botón eliminar
2. Confirmación JavaScript
3. DELETE request a `/event/{id}`
4. Verificación de permisos
5. Eliminación de BD y archivos
6. Recarga de página

## 🛠️ Comandos Ejecutados

```bash
# Migraciones y modelos
php artisan make:migration create_events_table
php artisan make:model Event
php artisan migrate

# Seeder para usuario de prueba
php artisan make:seeder TestUserSeeder
php artisan db:seed --class=TestUserSeeder

# Configuración
php artisan storage:link
composer dump-autoload
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Verificación
php artisan route:list | Select-String "event"
```

## 📁 Archivos Modificados

```
app/Models/Event.php (NUEVO)
app/Models/User.php (relación events agregada)
app/Http/Controllers/EventController.php (métodos store, myEvents, destroy)
database/migrations/2025_08_29_194903_create_events_table.php (NUEVO)
database/seeders/TestUserSeeder.php (NUEVO)
routes/web.php (import EventController, rutas store/destroy)
resources/views/layouts/app.blade.php (meta csrf-token)
resources/views/event_summary.blade.php (botón publicar, JavaScript)
resources/views/mis_eventos.blade.php (eventos dinámicos, JavaScript eliminar)
```

## 🎯 Estado Actual

### ✅ **Funcionando:**
- Creación completa de eventos (4 pasos)
- Guardado en base de datos
- Vista de mis eventos dinámica
- Eliminación de eventos
- Manejo de sesiones
- Validaciones básicas

### 🔄 **Por Implementar:**
- Sistema de autenticación real
- Edición de eventos
- Subida real de archivos multimedia
- Paginación
- Filtros y búsqueda

## 🚀 Cómo Probar

### 1. **Iniciar servidor:**
```bash
cd FestiSpot
php artisan serve
```

### 2. **Crear evento:**
- Ve a http://127.0.0.1:8000/event/create
- Completa los 4 pasos:
  1. Información básica (nombre, descripción, categoría)
  2. Fechas y horarios
  3. Ubicación (presencial/virtual/híbrido)
  4. Media (imágenes/videos - opcional)
- Haz clic en "🚀 Publicar Evento"

### 3. **Ver eventos:**
- Ve a http://127.0.0.1:8000/mis-eventos
- Verifica que aparezca tu evento creado
- Observa información dinámica real

### 4. **Eliminar evento:**
- En mis eventos, clic en ícono basura (🗑️)
- Confirma eliminación
- Verifica que desaparezca de la lista

## 📞 Notas Importantes para el Equipo

### **Configuración Temporal:**
- **Usuario:** Se usa ID fijo (1) para pruebas - cambiar cuando tengamos auth
- **Media:** Preparado para archivos pero usando nombres temporales
- **CSRF:** Configurado y funcionando

### **Base de Datos:**
- Usuario de prueba: `test@festispot.com` / `password123`
- Tabla events completamente funcional
- Relaciones User ↔ Events establecidas

### **Próximos Pasos Recomendados:**
1. Implementar sistema de login/registro real
2. Crear formulario de edición de eventos
3. Subida real de archivos multimedia
4. Validaciones del lado del servidor más robustas
5. Paginación para muchos eventos

### **Estructura del Código:**
- Sigue patrones MVC de Laravel
- Separación clara entre lógica y presentación
- Manejo de errores implementado
- Código documentado y comentado

## 🔧 Solución de Problemas

### Error "Target class [EventController] does not exist"
```bash
composer dump-autoload
php artisan config:clear
php artisan route:clear
```

### Error de CSRF Token
- Verificar meta tag en layout
- Confirmar envío en headers JavaScript

### Error de Base de Datos
```bash
php artisan migrate:fresh
php artisan db:seed --class=TestUserSeeder
```

---

**Desarrollado para FestiSpot - Sistema de Gestión de Eventos**
*Fecha: Agosto 29, 2025*
*Desarrollador: GitHub Copilot & Equipo FestiSpot*

## 📧 Contacto

Para dudas sobre esta implementación, revisar:
1. Este README
2. Comentarios en el código
3. Logs de Laravel en `storage/logs/`

¡El sistema está listo para usar y expandir! 🎉
