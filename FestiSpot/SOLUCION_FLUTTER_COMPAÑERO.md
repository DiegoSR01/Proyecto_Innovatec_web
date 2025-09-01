# 🚨 SOLUCIÓN PARA EL COMPAÑERO FLUTTER

## Problema:
La app Flutter no puede conectarse a la API porque está usando una URL incorrecta.

## Solución:

### 1. Configurar la URL correcta en Flutter

```dart
// En tu archivo de configuración (lib/services/api_service.dart)
class ApiService {
  // ❌ INCORRECTO (lo que tiene ahora)
  // static const String baseUrl = 'http://localhost:60253';
  
  // ✅ CORRECTO (debe usar tu IP)
  static const String baseUrl = 'http://10.250.2.81:8000/api/v1';
  
  // O para desarrollo local
  static const String baseUrl = 'http://10.0.2.2:8000/api/v1'; // Para emulador Android
  static const String baseUrl = 'http://localhost:8000/api/v1'; // Para simulador iOS
}
```

### 2. Verificar conexión de red

```dart
// Test de conexión básica
Future<void> testConnection() async {
  try {
    final response = await http.get(
      Uri.parse('http://10.250.2.81:8000/api/test'),
      headers: {'Accept': 'application/json'},
    );
    
    if (response.statusCode == 200) {
      print('✅ Conexión exitosa');
      print(response.body);
    } else {
      print('❌ Error: ${response.statusCode}');
    }
  } catch (e) {
    print('❌ Error de conexión: $e');
  }
}
```

### 3. Configuración para diferentes entornos

```dart
class Config {
  static const bool isProduction = false;
  
  static String get apiUrl {
    if (isProduction) {
      return 'https://tu-dominio.com/api/v1';
    } else {
      // Para desarrollo - usar la IP del servidor Laravel
      return 'http://10.250.2.81:8000/api/v1';
    }
  }
}
```

### 4. Permisos de red (Android)

Verificar que tenga en `android/app/src/main/AndroidManifest.xml`:

```xml
<uses-permission android:name="android.permission.INTERNET" />
<uses-permission android:name="android.permission.ACCESS_NETWORK_STATE" />
```

### 5. Configuración para HTTP (no HTTPS)

En `android/app/src/main/AndroidManifest.xml`:

```xml
<application
    android:usesCleartextTraffic="true"
    ...>
```

## URLs que debe probar:

1. **Test básico:** http://10.250.2.81:8000/api/test
2. **Eventos:** http://10.250.2.81:8000/api/v1/events
3. **Categorías:** http://10.250.2.81:8000/api/v1/categories

## Comando de prueba rápida:

```bash
# En terminal/cmd
curl -X GET "http://10.250.2.81:8000/api/test" -H "Accept: application/json"
```

## ⚠️ IMPORTANTE:

- Asegúrate de que tu servidor Laravel esté corriendo
- Ambos deben estar en la misma red (WiFi/LAN)
- La IP 10.250.2.81 debe ser accesible desde su máquina
