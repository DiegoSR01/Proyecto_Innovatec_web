# FestiSpot - API y Cliente Flutter

**FestiSpot** es una plataforma completa para la gestión de eventos que incluye una API REST desarrollada en Laravel y un cliente para aplicaciones Flutter/Dart.

## 🎯 Características Principales

### 🌐 API Backend (Laravel)
- ✅ **Autenticación completa**: Registro, login, logout, cambio de contraseña
- ✅ **Gestión de eventos**: CRUD completo con filtros avanzados
- ✅ **Sistema de usuarios**: Perfiles, roles (asistente, organizador, admin)
- ✅ **Asistencias**: Confirmar/cancelar asistencia a eventos
- ✅ **Favoritos**: Marcar eventos como favoritos
- ✅ **Reviews**: Sistema de calificaciones y comentarios
- ✅ **Notificaciones**: Sistema de notificaciones para usuarios
- ✅ **Categorías y ubicaciones**: Organización de eventos
- ✅ **API RESTful**: Endpoints bien documentados con responses consistentes

### 📱 Cliente Flutter/Dart
- ✅ **SDK completo**: Biblioteca lista para usar en Flutter
- ✅ **Manejo de errores**: Sistema robusto de manejo de excepciones
- ✅ **Almacenamiento seguro**: Tokens y datos cifrados
- ✅ **Conectividad**: Verificación automática de internet
- ✅ **Offline-ready**: Preparado para funcionamiento sin conexión
- ✅ **Documentación completa**: Ejemplos y guías de uso

## 🚀 Instalación Rápida

### Opción 1: Script Automático (Recomendado)

#### Windows:
```cmd
# Desde el directorio FestiSpot
setup.bat
```

#### Linux/Mac:
```bash
# Desde el directorio FestiSpot
chmod +x setup.sh
./setup.sh
```

### Opción 2: Instalación Manual

#### 1. Configurar Backend (Laravel)

```bash
# Instalar dependencias
composer install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Configurar base de datos en .env
# DB_DATABASE=festispot
# DB_USERNAME=tu_usuario
# DB_PASSWORD=tu_contraseña

# Ejecutar migraciones
php artisan migrate

# (Opcional) Datos de prueba
php artisan db:seed

# Iniciar servidor
php artisan serve
```

#### 2. Configurar Cliente Flutter

```bash
# Ir a la carpeta Flutter
cd flutter/

# Instalar dependencias (en tu proyecto Flutter)
flutter pub add http dio shared_preferences flutter_secure_storage logger connectivity_plus equatable
flutter pub add --dev build_runner json_serializable

# Copiar archivos lib/ a tu proyecto Flutter

# Generar código
flutter packages pub run build_runner build
```

## 📁 Estructura del Proyecto

```
FestiSpot/
├── 🌐 Backend Laravel/
│   ├── app/
│   │   ├── Http/Controllers/Api/     # Controladores de API
│   │   └── Models/                   # Modelos de datos
│   ├── database/migrations/          # Migraciones de BD
│   ├── routes/api.php               # Rutas de API
│   └── README_API.md                # Documentación de API
│
├── 📱 Cliente Flutter/
│   ├── lib/
│   │   ├── festispot_api.dart       # Punto de entrada
│   │   ├── models/                  # Modelos de datos
│   │   ├── services/                # Servicios de API
│   │   └── utils/                   # Utilidades
│   ├── example/main.dart            # Ejemplos de uso
│   └── README.md                    # Documentación Flutter
│
├── setup.sh / setup.bat             # Scripts de instalación
└── README.md                        # Este archivo
```

## 🔧 Configuración de Desarrollo

### Variables de Entorno (.env)

```env
# Base de datos
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=festispot
DB_USERNAME=root
DB_PASSWORD=

# URLs
APP_URL=http://localhost:8000
FRONTEND_URL=http://localhost:3000

# API
SANCTUM_STATEFUL_DOMAINS=localhost:3000
```

### Configuración de CORS

Para permitir peticiones desde Flutter, asegúrate de configurar CORS en `config/cors.php`:

```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_methods' => ['*'],
'allowed_origins' => ['*'], // En producción, especifica dominios
'allowed_headers' => ['*'],
'supports_credentials' => true,
```

## 📚 Uso Básico

### 1. Inicializar en Flutter

```dart
import 'package:tu_app/festispot_api.dart';

void main() async {
  // Inicializar API
  await FestiSpotApi.initialize(
    baseUrl: 'http://localhost:8000/api/v1',
    enableLogging: true,
  );
  
  runApp(MyApp());
}
```

### 2. Autenticación

```dart
// Registro
final registerRequest = RegisterRequest(
  name: 'Juan Pérez',
  email: 'juan@example.com',
  password: 'password123',
  passwordConfirmation: 'password123',
  tipoUsuario: 'asistente',
);

try {
  final authResponse = await FestiSpotApi.auth.register(registerRequest);
  print('Usuario registrado: ${authResponse.user.email}');
} catch (e) {
  print('Error: $e');
}

// Login
final loginRequest = LoginRequest(
  email: 'juan@example.com',
  password: 'password123',
);

final authResponse = await FestiSpotApi.auth.login(loginRequest);
```

### 3. Gestión de Eventos

```dart
// Obtener eventos
final events = await FestiSpotApi.events.getEvents();

// Buscar eventos
final searchResults = await FestiSpotApi.events.searchEvents(query: 'música');

// Crear evento (organizadores)
final eventRequest = EventRequest(
  titulo: 'Mi Evento',
  descripcion: 'Descripción del evento',
  fechaInicio: DateTime.now().add(Duration(days: 30)),
  capacidadTotal: 100,
);

final newEvent = await FestiSpotApi.events.createEvent(eventRequest);

// Confirmar asistencia
await FestiSpotApi.events.attendEvent(eventId);

// Marcar como favorito
await FestiSpotApi.events.addToFavorites(eventId);
```

## 🌐 Endpoints de API

### Autenticación
```
POST /api/v1/auth/register     # Registro
POST /api/v1/auth/login        # Login
POST /api/v1/auth/logout       # Logout
GET  /api/v1/auth/me           # Usuario actual
```

### Eventos
```
GET    /api/v1/events          # Listar eventos
POST   /api/v1/events          # Crear evento
GET    /api/v1/events/{id}     # Ver evento
PUT    /api/v1/events/{id}     # Actualizar evento
DELETE /api/v1/events/{id}     # Eliminar evento
GET    /api/v1/events/search   # Buscar eventos
```

### Usuario
```
GET /api/v1/user/profile              # Perfil
PUT /api/v1/user/profile              # Actualizar perfil
GET /api/v1/user/events               # Eventos del usuario
GET /api/v1/user/organized-events     # Eventos organizados
GET /api/v1/user/attended-events      # Eventos asistidos
GET /api/v1/user/favorite-events      # Eventos favoritos
```

## 🔒 Autenticación y Seguridad

### Laravel Sanctum
- Tokens de API seguros
- Autenticación basada en tokens
- CSRF protection
- Rate limiting

### Flutter
- Almacenamiento seguro con `flutter_secure_storage`
- Validación automática de tokens
- Manejo de errores de autenticación
- Timeout en peticiones

## 🧪 Testing

### Backend
```bash
# Ejecutar tests
php artisan test

# Tests específicos
php artisan test --filter AuthTest
```

### Frontend
```bash
# En tu proyecto Flutter
flutter test
```

## 📊 Base de Datos

### Tablas Principales
- **users**: Usuarios del sistema
- **events**: Eventos
- **categorias**: Categorías de eventos
- **ubicaciones**: Ubicaciones de eventos
- **asistencias**: Asistencias a eventos
- **favoritos**: Eventos favoritos
- **reviews**: Reseñas de eventos
- **notificaciones**: Notificaciones

### Migraciones
```bash
# Ejecutar migraciones
php artisan migrate

# Rollback
php artisan migrate:rollback

# Fresh (recrear)
php artisan migrate:fresh --seed
```

## 🚀 Despliegue

### Backend (Laravel)

#### Producción
1. Configurar servidor web (Apache/Nginx)
2. Configurar base de datos MySQL/PostgreSQL
3. Configurar variables de entorno
4. Ejecutar migraciones
5. Configurar queue workers
6. Configurar SSL (HTTPS)

#### Docker
```bash
# Construir imagen
docker build -t festispot-api .

# Ejecutar contenedor
docker run -p 8000:8000 festispot-api
```

### Frontend (Flutter)

#### App móvil
```bash
# Android
flutter build apk --release

# iOS
flutter build ios --release
```

#### Web
```bash
flutter build web --release
```

## 🔧 Configuración Avanzada

### Múltiples Entornos

#### Laravel
```bash
# Desarrollo
cp .env.example .env.development

# Producción
cp .env.example .env.production
```

#### Flutter
```dart
// Configuración por entorno
await FestiSpotApi.initialize(
  baseUrl: const String.fromEnvironment(
    'API_BASE_URL',
    defaultValue: 'http://localhost:8000/api/v1',
  ),
);
```

### Logging y Debugging

#### Laravel
```php
// config/logging.php
'channels' => [
    'api' => [
        'driver' => 'daily',
        'path' => storage_path('logs/api.log'),
    ],
],
```

#### Flutter
```dart
// Habilitar logs detallados
await FestiSpotApi.initialize(
  baseUrl: 'http://localhost:8000/api/v1',
  enableLogging: true,
);

// Debugging
final status = await FestiSpotApiDebug.getDetailedStatus();
```

## 📝 Ejemplos Completos

### App de Ejemplo Flutter
```dart
class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'FestiSpot',
      home: FutureBuilder(
        future: _initializeApp(),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.done) {
            return FestiSpotApi.auth.isAuthenticated
                ? HomeScreen()
                : LoginScreen();
          }
          return SplashScreen();
        },
      ),
    );
  }

  Future<void> _initializeApp() async {
    await FestiSpotApi.initialize(
      baseUrl: 'http://localhost:8000/api/v1',
    );
  }
}
```

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver `LICENSE` para más detalles.

## 📞 Soporte

### Problemas Comunes

#### "Error de conexión"
- Verifica que el servidor Laravel esté ejecutándose
- Confirma la URL base en la configuración de Flutter
- Revisa la configuración de CORS

#### "Token inválido"
- El usuario necesita hacer login nuevamente
- Verifica la configuración de Sanctum

#### "Error de base de datos"
- Confirma las credenciales en `.env`
- Ejecuta las migraciones: `php artisan migrate`

### Debugging
```bash
# Ver logs de Laravel
tail -f storage/logs/laravel.log

# Test de conectividad desde Flutter
final test = await FestiSpotApiDebug.testConnectivity();
```

## 🎉 ¡Listo!

Ahora tienes una API completa de FestiSpot con:

✅ **Backend Laravel** funcionando con autenticación, CRUD de eventos, y más
✅ **Cliente Flutter** listo para usar en aplicaciones móviles
✅ **Documentación completa** con ejemplos
✅ **Scripts de configuración** automática
✅ **Estructura escalable** para proyectos grandes

¡Empieza a construir tu aplicación de eventos! 🚀
