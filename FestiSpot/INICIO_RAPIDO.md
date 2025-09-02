# 🚀 Instrucciones de Inicio Rápido - FestiSpot

## ⚡ Configuración Express (5 minutos)

### 📋 Requisitos Previos
- PHP 8.1+
- Composer
- MySQL/MariaDB
- Node.js (para Flutter web, opcional)

### 🛠️ Paso 1: Configurar Backend (2 minutos)

#### Windows:
```cmd
cd FestiSpot
setup.bat
```

#### Linux/Mac:
```bash
cd FestiSpot
chmod +x setup.sh
./setup.sh
```

**¿Qué hace el script?**
- ✅ Instala dependencias de Composer
- ✅ Crea archivo .env
- ✅ Genera clave de aplicación
- ✅ Configura base de datos (te preguntará los datos)
- ✅ Ejecuta migraciones
- ✅ Configura almacenamiento

### 🚀 Paso 2: Iniciar Servidor (30 segundos)
```bash
php artisan serve
```

**¡Listo!** Tu API está funcionando en: `http://localhost:8000`

### 📱 Paso 3: Configurar Flutter (2 minutos)

1. **Copia la carpeta `flutter/lib/` a tu proyecto Flutter**

2. **Instala dependencias:**
```bash
flutter pub add http dio shared_preferences flutter_secure_storage logger connectivity_plus equatable
flutter pub add --dev build_runner json_serializable
```

3. **Genera código:**
```bash
flutter packages pub run build_runner build
```

4. **Inicializa en tu app:**
```dart
import 'package:tu_app/festispot_api.dart';

void main() async {
  await FestiSpotApi.initialize(
    baseUrl: 'http://localhost:8000/api/v1',
  );
  runApp(MyApp());
}
```

## 🧪 Prueba Rápida

### 1. Test de API (desde navegador o Postman):
```
GET http://localhost:8000/api/test
```
Debería responder: `{"success": true, "message": "API FestiSpot funcionando correctamente"}`

### 2. Test desde Flutter:
```dart
// En tu app Flutter
final test = await FestiSpotApiDebug.testConnectivity();
print(test); // Debería mostrar success: true
```

### 3. Registro de usuario:
```dart
final registerRequest = RegisterRequest(
  name: 'Test User',
  email: 'test@example.com',
  password: 'password123',
  passwordConfirmation: 'password123',
  tipoUsuario: 'asistente',
);

final authResponse = await FestiSpotApi.auth.register(registerRequest);
print('Usuario creado: ${authResponse.user.email}');
```

## 📊 Panel de Control Rápido

### Endpoints de Prueba:
- **🔍 Test conectividad:** `GET /api/test`
- **👤 Registro:** `POST /api/v1/auth/register`
- **🔑 Login:** `POST /api/v1/auth/login`
- **🎉 Eventos:** `GET /api/v1/events`

### Datos de Prueba (si ejecutaste seeders):
- **Admin:** admin@festispot.com / password
- **Organizador:** organizador@festispot.com / password
- **Usuario:** usuario@festispot.com / password

## 🔧 Comandos Útiles

### Backend:
```bash
# Ver logs en tiempo real
tail -f storage/logs/laravel.log

# Limpiar caché
php artisan cache:clear
php artisan config:clear

# Recrear base de datos
php artisan migrate:fresh --seed

# Ver rutas
php artisan route:list --name=api
```

### Flutter:
```dart
// Verificar estado
final status = await FestiSpotApi.getStatus();

// Debug detallado
final debug = await FestiSpotApiDebug.getDetailedStatus();

// Test de conectividad
final test = await FestiSpotApiDebug.testConnectivity();
```

## ❌ Problemas Comunes

### "Error de conexión"
```bash
# Verifica que el servidor esté corriendo
php artisan serve
```

### "Base de datos no encontrada"
1. Crea la base de datos manualmente:
```sql
CREATE DATABASE festispot;
```
2. Ejecuta migraciones:
```bash
php artisan migrate
```

### "CORS error"
- Verifica que `config/cors.php` esté configurado correctamente
- Para desarrollo, `'allowed_origins' => ['*']` está bien

### "Token inválido en Flutter"
```dart
// Forzar nuevo login
await FestiSpotApi.auth.logout();
// ... hacer login nuevamente
```

## 📁 Archivos Importantes

```
FestiSpot/
├── .env                          # Configuración de base de datos
├── routes/api.php               # Rutas de API
├── app/Http/Controllers/Api/    # Controladores
├── flutter/lib/                 # Cliente Flutter
├── setup.sh / setup.bat        # Scripts de instalación
└── README_COMPLETO.md          # Documentación completa
```

## 🎯 Próximos Pasos

1. **✅ API funcionando** ← (Estás aquí)
2. **🔍 Revisar endpoints** - Ver `README_API.md`
3. **📱 Integrar Flutter** - Ver `flutter/README.md`
4. **🎨 Personalizar** - Modificar modelos y controladores
5. **🚀 Desplegar** - Configurar producción

## 📞 ¿Necesitas Ayuda?

### Documentación:
- **📖 Completa:** `README_COMPLETO.md`
- **🌐 API:** `README_API.md`
- **📱 Flutter:** `flutter/README.md`

### Debug:
```bash
# Ver errores de Laravel
tail -f storage/logs/laravel.log

# Estado de la aplicación
php artisan about
```

---

¡**En 5 minutos tienes toda la infraestructura lista!** 🎉

**¿Todo funcionando?** → Continúa con `README_COMPLETO.md` para funcionalidades avanzadas

**¿Hay problemas?** → Revisa esta guía paso a paso o verifica los logs
