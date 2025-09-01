# FestiSpot API Documentation

## Base URL
```
http://10.250.2.81:8000/api/v1
```

## Autenticación
La API usa Laravel Sanctum para autenticación. Después del login, incluye el token en el header:
```
Authorization: Bearer {your-token}
```

---

## 🔐 Autenticación

### Registro
**POST** `/auth/register`
```json
{
  "name": "Juan Pérez",
  "email": "juan@email.com",
  "password": "password123",
  "password_confirmation": "password123",
  "telefono": "+573001234567",
  "fecha_nacimiento": "1990-01-01",
  "tipo_usuario": "asistente"
}
```

**Respuesta:**
```json
{
  "success": true,
  "message": "Usuario registrado exitosamente",
  "data": {
    "user": {...},
    "access_token": "token_aqui",
    "token_type": "Bearer"
  }
}
```

### Login
**POST** `/auth/login`
```json
{
  "email": "juan@email.com",
  "password": "password123"
}
```

### Logout (Autenticado)
**POST** `/auth/logout`

### Obtener usuario actual (Autenticado)
**GET** `/auth/me`

### Cambiar contraseña (Autenticado)
**POST** `/auth/change-password`
```json
{
  "current_password": "password123",
  "password": "new_password123",
  "password_confirmation": "new_password123"
}
```

---

## 🎉 Eventos

### Listar eventos
**GET** `/events`

**Parámetros opcionales:**
- `fecha_inicio`: Filtrar por fecha de inicio
- `fecha_fin`: Filtrar por fecha de fin
- `categoria_id`: Filtrar por categoría
- `ubicacion_id`: Filtrar por ubicación
- `estado`: Filtrar por estado (activo, cancelado, finalizado)
- `per_page`: Cantidad por página (default: 10)

### Obtener evento específico
**GET** `/events/{id}`

### Buscar eventos
**GET** `/events/search?q=concierto`

### Eventos por categoría
**GET** `/events/category/{categoryId}`

### Eventos por ubicación
**GET** `/events/location/{locationId}`

### Crear evento (Autenticado)
**POST** `/events`
```json
{
  "titulo": "Concierto de Rock",
  "descripcion": "Gran concierto de rock en vivo",
  "fecha_inicio": "2025-09-15 20:00:00",
  "fecha_fin": "2025-09-15 23:00:00",
  "ubicacion_id": 1,
  "categoria_id": 2,
  "capacidad_maxima": 500,
  "precio": 25000,
  "imagen_url": "https://example.com/imagen.jpg",
  "estado": "activo"
}
```

### Actualizar evento (Autenticado - Solo organizador)
**PUT** `/events/{id}`

### Eliminar evento (Autenticado - Solo organizador)
**DELETE** `/events/{id}`

---

## 👤 Usuario

### Obtener perfil (Autenticado)
**GET** `/user/profile`

### Actualizar perfil (Autenticado)
**PUT** `/user/profile`
```json
{
  "name": "Juan Carlos Pérez",
  "telefono": "+573001234567",
  "fecha_nacimiento": "1990-01-01",
  "tipo_usuario": "organizador"
}
```

### Mis eventos (Autenticado)
**GET** `/user/events`
Retorna eventos organizados y eventos a los que asiste

### Eventos organizados (Autenticado)
**GET** `/user/organized-events`

### Eventos a los que asisto (Autenticado)
**GET** `/user/attended-events`

### Eventos favoritos (Autenticado)
**GET** `/user/favorite-events`

---

## 🎫 Asistencias

### Registrarse a evento (Autenticado)
**POST** `/events/{eventId}/attend`

### Cancelar asistencia (Autenticado)
**DELETE** `/events/{eventId}/unattend`

### Ver asistentes de evento
**GET** `/events/{eventId}/attendees`

### Estado de asistencia (Autenticado)
**GET** `/events/{eventId}/attendance-status`

---

## ⭐ Favoritos

### Agregar a favoritos (Autenticado)
**POST** `/events/{eventId}/favorite`

### Remover de favoritos (Autenticado)
**DELETE** `/events/{eventId}/unfavorite`

---

## 📝 Reseñas

### Ver reseñas de evento
**GET** `/events/{eventId}/reviews`

### Crear reseña (Autenticado)
**POST** `/events/{eventId}/reviews`
```json
{
  "calificacion": 5,
  "comentario": "Excelente evento, muy bien organizado"
}
```

### Actualizar reseña (Autenticado)
**PUT** `/reviews/{id}`

### Eliminar reseña (Autenticado)
**DELETE** `/reviews/{id}`

### Mis reseñas (Autenticado)
**GET** `/user/reviews`

---

## 📂 Categorías

### Listar categorías
**GET** `/categories`

### Obtener categoría específica
**GET** `/categories/{id}`

---

## 📍 Ubicaciones

### Listar ubicaciones
**GET** `/locations`

### Obtener ubicación específica
**GET** `/locations/{id}`

---

## 🔔 Notificaciones

### Obtener notificaciones (Autenticado)
**GET** `/notifications`

### Marcar como leída (Autenticado)
**PUT** `/notifications/{id}/read`

### Marcar todas como leídas (Autenticado)
**PUT** `/notifications/read-all`

### Eliminar notificación (Autenticado)
**DELETE** `/notifications/{id}`

---

## Códigos de Error

- `200`: OK
- `201`: Creado
- `400`: Solicitud incorrecta
- `401`: No autorizado
- `403`: Prohibido
- `404`: No encontrado
- `422`: Error de validación
- `500`: Error del servidor

## Formato de Respuesta

### Éxito
```json
{
  "success": true,
  "message": "Mensaje descriptivo",
  "data": { ... }
}
```

### Error
```json
{
  "success": false,
  "message": "Mensaje de error",
  "errors": { ... }
}
```

---

## Ejemplos de uso para Flutter/Dart

### Configuración básica
```dart
class ApiService {
  static const String baseUrl = 'http://10.250.2.81:8000/api/v1';
  String? _token;

  void setToken(String token) {
    _token = token;
  }

  Map<String, String> get headers => {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    if (_token != null) 'Authorization': 'Bearer $_token',
  };
}
```

### Login
```dart
Future<Map<String, dynamic>> login(String email, String password) async {
  final response = await http.post(
    Uri.parse('$baseUrl/auth/login'),
    headers: {'Content-Type': 'application/json'},
    body: json.encode({
      'email': email,
      'password': password,
    }),
  );
  return json.decode(response.body);
}
```

### Obtener eventos
```dart
Future<List<Event>> getEvents() async {
  final response = await http.get(
    Uri.parse('$baseUrl/events'),
    headers: headers,
  );
  final data = json.decode(response.body);
  return (data['data']['data'] as List)
      .map((event) => Event.fromJson(event))
      .toList();
}
```
