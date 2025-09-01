# 📱 GUÍA PARA EL DESARROLLADOR MÓVIL - FESTISPOT

## 🎯 INFORMACIÓN ESENCIAL

**API Base URL:** `http://10.250.2.81:8000/api/v1`
**Autenticación:** Bearer Token (Laravel Sanctum)
**Documentación:** README_API.md en el proyecto
**Postman Collection:** FestiSpot_API.postman_collection.json

---

## 🚀 CONFIGURACIÓN INICIAL

### 1. Dependencias Flutter
```yaml
dependencies:
  flutter:
    sdk: flutter
  http: ^1.1.0
  provider: ^6.1.1
  flutter_secure_storage: ^9.0.0
  shared_preferences: ^2.2.2
  cached_network_image: ^3.3.0
  intl: ^0.19.0
```

### 2. Permisos Android (android/app/src/main/AndroidManifest.xml)
```xml
<uses-permission android:name="android.permission.INTERNET" />
<uses-permission android:name="android.permission.ACCESS_NETWORK_STATE" />
```

### 3. Configuración iOS (ios/Runner/Info.plist)
```xml
<key>NSAppTransportSecurity</key>
<dict>
    <key>NSAllowsArbitraryLoads</key>
    <true/>
</dict>
```

---

## 📋 ESTRUCTURA DEL PROYECTO

```
lib/
├── main.dart
├── models/
│   ├── user.dart
│   ├── event.dart
│   ├── category.dart
│   ├── location.dart
│   └── api_response.dart
├── services/
│   └── api_service.dart
├── providers/
│   ├── auth_provider.dart
│   └── events_provider.dart
├── screens/
│   ├── splash_screen.dart
│   ├── login_screen.dart
│   ├── register_screen.dart
│   ├── home_screen.dart
│   ├── events_screen.dart
│   ├── event_detail_screen.dart
│   ├── create_event_screen.dart
│   └── profile_screen.dart
└── widgets/
    ├── event_card.dart
    ├── loading_widget.dart
    └── error_widget.dart
```

---

## 🔐 FLUJO DE AUTENTICACIÓN

### 1. Login/Registro
```dart
// Login
final success = await authProvider.login(email, password);
if (success) {
  Navigator.pushReplacementNamed(context, '/home');
}

// Registro
final success = await authProvider.register(
  name: name,
  email: email,
  password: password,
  passwordConfirmation: passwordConfirmation,
  tipoUsuario: 'asistente', // 'asistente' | 'organizador'
);
```

### 2. Gestión de Token
- Se guarda automáticamente en `flutter_secure_storage`
- Se incluye automáticamente en headers de peticiones autenticadas
- Se limpia al hacer logout

---

## 📅 FUNCIONALIDADES PRINCIPALES

### 1. Gestión de Eventos
```dart
// Obtener eventos
final events = await ApiService.getEvents(
  page: 1,
  perPage: 10,
  categoriaId: 1,
);

// Buscar eventos
final events = await ApiService.searchEvents('concierto');

// Crear evento (solo organizadores)
final result = await ApiService.createEvent(
  titulo: 'Mi Evento',
  descripcion: 'Descripción del evento',
  fechaInicio: '2025-09-15 20:00:00',
  fechaFin: '2025-09-15 23:00:00',
  ubicacionId: 1,
  categoriaId: 1,
);
```

### 2. Asistencias
```dart
// Asistir a evento
final result = await ApiService.attendEvent(eventId);

// Cancelar asistencia
final result = await ApiService.unattendEvent(eventId);

// Verificar estado de asistencia
final status = await ApiService.getAttendanceStatus(eventId);
```

### 3. Favoritos
```dart
// Agregar a favoritos
await ApiService.addToFavorites(eventId);

// Remover de favoritos
await ApiService.removeFromFavorites(eventId);

// Obtener eventos favoritos
final favorites = await ApiService.getFavoriteEvents();
```

---

## 🎨 DISEÑO Y UX

### Colores Sugeridos
```dart
class AppColors {
  static const primary = Color(0xFF6B46C1); // Purple
  static const secondary = Color(0xFF10B981); // Green
  static const accent = Color(0xFFF59E0B); // Yellow
  static const error = Color(0xFFEF4444); // Red
  static const background = Color(0xFFF9FAFB); // Light Gray
}
```

### Componentes Clave
1. **EventCard** - Tarjeta para mostrar eventos
2. **LoadingWidget** - Indicador de carga
3. **ErrorWidget** - Manejo de errores
4. **SearchBar** - Barra de búsqueda
5. **CategoryFilter** - Filtro por categorías

---

## 📱 PANTALLAS PRINCIPALES

### 1. Splash Screen
- Verificar autenticación
- Mostrar logo de FestiSpot
- Redireccionar a login o home

### 2. Login/Registro
- Formularios de autenticación
- Validación de campos
- Manejo de errores

### 3. Home Screen
- Lista de eventos destacados
- Búsqueda rápida
- Navegación a otras secciones

### 4. Events Screen
- Lista completa de eventos
- Filtros por categoría/ubicación
- Funciones de búsqueda
- Pull-to-refresh

### 5. Event Detail Screen
- Información completa del evento
- Botón de asistir/favorito
- Mapa de ubicación
- Galería de imágenes

### 6. Profile Screen
- Información del usuario
- Mis eventos (organizados/asistiendo)
- Eventos favoritos
- Configuración

---

## 🔧 MANEJO DE ERRORES

### Estados de Response
```dart
if (result['success']) {
  // Operación exitosa
  final data = result['data'];
} else {
  // Error de la API
  final message = result['message'];
  final errors = result['errors']; // Errores de validación
}
```

### Códigos de Error Comunes
- `200` - OK
- `201` - Creado
- `400` - Solicitud incorrecta
- `401` - No autorizado (token inválido)
- `403` - Prohibido
- `404` - No encontrado
- `422` - Error de validación
- `500` - Error del servidor

---

## 🧪 TESTING

### Endpoints de Prueba
1. **Test API:** `http://10.250.2.81:8000/api/test`
2. **Eventos:** `http://10.250.2.81:8000/api/v1/events`
3. **Categorías:** `http://10.250.2.81:8000/api/v1/categories`

### Herramientas
- **Navegador:** `http://10.250.2.81:8000/api-test.html`
- **Postman:** Importar `FestiSpot_API.postman_collection.json`

---

## 📊 FEATURES ADICIONALES

### 1. Notificaciones Push (Futuro)
- Integrar Firebase Messaging
- Endpoint: `/api/v1/notifications`

### 2. Geolocalización
- Mostrar eventos cercanos
- Mapas integrados

### 3. Compartir Eventos
- Share plugin de Flutter
- Deep links

### 4. Modo Offline
- Caché local con sqflite
- Sincronización automática

---

## 🚨 CONSIDERACIONES IMPORTANTES

### Seguridad
- ✅ Usar HTTPS en producción
- ✅ Validar siempre tokens
- ✅ No guardar datos sensibles en plain text
- ✅ Implementar refresh tokens

### Performance
- ✅ Usar paginación en listas
- ✅ Caché de imágenes
- ✅ Lazy loading
- ✅ Optimizar consultas

### UX
- ✅ Loading states en todas las operaciones
- ✅ Pull-to-refresh en listas
- ✅ Manejo de estados offline
- ✅ Feedback visual para acciones

---

## 🎯 PRÓXIMOS PASOS

1. **Configurar el proyecto Flutter** con las dependencias
2. **Implementar la autenticación** usando AuthProvider
3. **Crear las pantallas principales** (Home, Events, Profile)
4. **Integrar la API** usando ApiService
5. **Implementar funcionalidades core** (eventos, asistencias, favoritos)
6. **Añadir features adicionales** (búsqueda, filtros, mapas)
7. **Testing exhaustivo** en dispositivos reales
8. **Optimización y pulido** antes del lanzamiento

---

## 📞 SOPORTE

- **Documentación API:** `README_API.md`
- **Ejemplos de código:** Archivos `.dart` generados
- **Postman Collection:** Para testing manual
- **Servidor de desarrollo:** `http://10.250.2.81:8000`

¡Tu API está lista y completamente funcional! 🎉
