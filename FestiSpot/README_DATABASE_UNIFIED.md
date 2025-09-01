# Base de Datos Unificada de FestiSpot

## Resumen de la Unificación

Hemos unificado exitosamente la base de datos de FestiSpot con el nuevo esquema completo. La migración mantiene la compatibilidad hacia atrás mientras agrega todas las nuevas funcionalidades.

## Nuevas Tablas Agregadas

### 1. **roles** - Sistema de Roles
- `asistente`: Usuarios que asisten a eventos
- `organizador`: Usuarios que crean y gestionan eventos  
- `admin`: Administradores del sistema

### 2. **categorias** - Categorías de Eventos
- Música, Arte, Gastronomía, Deportes, Tecnología, Cultura
- Con iconos y colores para la interfaz

### 3. **ubicaciones** - Venues/Ubicaciones
- Información completa de ubicaciones
- Coordenadas GPS, capacidad, facilidades
- Soporte para eventos presenciales

### 4. **planes_suscripcion** - Planes para Organizadores
- Básico (gratuito): 5 eventos, 3 imágenes
- Pro ($299/mes): 50 eventos, 10 imágenes, analytics
- Premium ($599/mes): Ilimitado, todas las funciones

### 5. **suscripciones_organizador** - Suscripciones Activas
- Gestión de suscripciones de organizadores
- Estados: activa, vencida, cancelada, suspendida

### 6. **asistencias** - Reservas/Asistencias
- Registro de usuarios que asisten a eventos
- Códigos QR únicos para check-in
- Soporte para acompañantes

### 7. **notificaciones** - Sistema de Notificaciones
- Push, email, in-app
- Tipos: nuevo_evento, recordatorio, cancelacion, etc.

### 8. **favoritos** - Eventos Favoritos
- Usuarios pueden marcar eventos como favoritos

### 9. **reviews** - Calificaciones y Comentarios
- Sistema de reseñas de 1-5 estrellas
- Moderación de comentarios

### 10. **configuraciones_usuario** - Preferencias
- Configuraciones de notificaciones
- Categorías favoritas, idioma, tema

### 11. **imagenes_evento** - Gestión de Imágenes
- Principal, galería, thumbnails
- Metadata de archivos

### 12. **analytics_evento** - Métricas
- Vistas, clicks, compartidos
- Para organizadores con plan Pro/Premium

## Tablas Actualizadas

### **users** → Campos Agregados
- `nombre`, `apellido` (reemplaza `name`)
- `telefono`, `fecha_nacimiento`, `genero`
- `rol_id` (FK a roles)
- `estado`, `avatar_url`
- `email_verificado`, `token_verificacion`

### **events** → Campos Agregados
- `titulo`, `descripcion` (nuevos nombres)
- `descripcion_corta`
- `categoria_id` (FK a categorias)
- `ubicacion_id` (FK a ubicaciones)
- `organizador_id` (reemplaza `user_id`)
- `fecha_inicio`, `fecha_fin` (datetime)
- `hora_apertura_puertas`, `edad_minima`
- `politicas_cancelacion`, `instrucciones_especiales`
- `tags` (JSON), `estado` (enum en español)

## Modelos Actualizados

Todos los modelos han sido actualizados con:
- Relaciones completas entre tablas
- Scopes útiles para consultas
- Métodos helper
- Compatibilidad hacia atrás

## Funciones Principales

### Para Organizadores
- Sistema de suscripciones con límites
- Analytics detallados (Pro/Premium)
- Gestión completa de eventos
- Subida de múltiples imágenes

### Para Asistentes
- Registro a eventos con QR
- Sistema de favoritos
- Notificaciones personalizadas
- Reseñas y calificaciones

### Para Administradores
- Gestión completa del sistema
- Moderación de contenido
- Analytics globales

## Compatibilidad

El sistema mantiene compatibilidad hacia atrás:
- Los campos legacy siguen funcionando
- Aliases en modelos para métodos antiguos
- Getters para nombres de campos anteriores

## Datos de Prueba

La base de datos incluye:
- 3 roles predefinidos
- 6 categorías de eventos
- 3 planes de suscripción
- 12 usuarios de prueba (incluyendo admin)

## Próximos Pasos

1. Actualizar controladores para usar nuevos campos
2. Implementar middleware de roles y permisos
3. Crear interfaces para gestión de suscripciones
4. Desarrollar sistema de analytics
5. Implementar notificaciones push

## Comando para Desarrollo

```bash
# Recrear BD desde cero (desarrollo)
php artisan migrate:fresh --seed

# Solo migrar nuevos cambios
php artisan migrate

# Ver estado de migraciones
php artisan migrate:status
```

La base de datos ahora está completamente unificada y lista para soportar todas las funcionalidades avanzadas de FestiSpot. 🎉
