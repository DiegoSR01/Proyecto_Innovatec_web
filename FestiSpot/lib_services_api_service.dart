// lib/services/api_service.dart
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class ApiService {
  static const String baseUrl = 'http://10.250.2.81:8000/api/v1';
  static const FlutterSecureStorage _storage = FlutterSecureStorage();
  
  // Headers base
  static Future<Map<String, String>> get _headers async {
    final token = await getToken();
    return {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      if (token != null) 'Authorization': 'Bearer $token',
    };
  }

  // Gestión de token
  static Future<void> saveToken(String token) async {
    await _storage.write(key: 'auth_token', value: token);
  }

  static Future<String?> getToken() async {
    return await _storage.read(key: 'auth_token');
  }

  static Future<void> deleteToken() async {
    await _storage.delete(key: 'auth_token');
  }

  // Método base para peticiones
  static Future<Map<String, dynamic>> _makeRequest(
    String endpoint,
    String method, {
    Map<String, dynamic>? body,
    Map<String, String>? queryParams,
  }) async {
    try {
      final headers = await _headers;
      final uri = Uri.parse('$baseUrl$endpoint').replace(queryParameters: queryParams);
      
      http.Response response;
      
      switch (method.toUpperCase()) {
        case 'GET':
          response = await http.get(uri, headers: headers);
          break;
        case 'POST':
          response = await http.post(uri, headers: headers, body: body != null ? json.encode(body) : null);
          break;
        case 'PUT':
          response = await http.put(uri, headers: headers, body: body != null ? json.encode(body) : null);
          break;
        case 'DELETE':
          response = await http.delete(uri, headers: headers);
          break;
        default:
          throw Exception('Método HTTP no soportado: $method');
      }

      final decodedResponse = json.decode(response.body);
      
      return {
        'statusCode': response.statusCode,
        'success': decodedResponse['success'] ?? false,
        'data': decodedResponse['data'],
        'message': decodedResponse['message'] ?? '',
        'errors': decodedResponse['errors'],
      };
    } catch (e) {
      return {
        'statusCode': 0,
        'success': false,
        'message': 'Error de conexión: $e',
        'data': null,
        'errors': null,
      };
    }
  }

  // ===== MÉTODOS DE AUTENTICACIÓN =====
  
  static Future<Map<String, dynamic>> register({
    required String name,
    required String email,
    required String password,
    required String passwordConfirmation,
    required String tipoUsuario,
    String? telefono,
  }) async {
    final result = await _makeRequest('/auth/register', 'POST', body: {
      'name': name,
      'email': email,
      'password': password,
      'password_confirmation': passwordConfirmation,
      'tipo_usuario': tipoUsuario,
      if (telefono != null) 'telefono': telefono,
    });

    // Si el registro es exitoso, guardar token automáticamente
    if (result['success'] && result['data']?['access_token'] != null) {
      await saveToken(result['data']['access_token']);
    }

    return result;
  }

  static Future<Map<String, dynamic>> login(String email, String password) async {
    final result = await _makeRequest('/auth/login', 'POST', body: {
      'email': email,
      'password': password,
    });

    // Si el login es exitoso, guardar token automáticamente
    if (result['success'] && result['data']?['access_token'] != null) {
      await saveToken(result['data']['access_token']);
    }

    return result;
  }

  static Future<Map<String, dynamic>> logout() async {
    final result = await _makeRequest('/auth/logout', 'POST');
    if (result['success']) {
      await deleteToken();
    }
    return result;
  }

  static Future<Map<String, dynamic>> getCurrentUser() async {
    return await _makeRequest('/auth/me', 'GET');
  }

  // ===== MÉTODOS DE EVENTOS =====
  
  static Future<Map<String, dynamic>> getEvents({
    int? page,
    int? perPage,
    int? categoriaId,
    int? ubicacionId,
    String? estado,
  }) async {
    final queryParams = <String, String>{};
    if (page != null) queryParams['page'] = page.toString();
    if (perPage != null) queryParams['per_page'] = perPage.toString();
    if (categoriaId != null) queryParams['categoria_id'] = categoriaId.toString();
    if (ubicacionId != null) queryParams['ubicacion_id'] = ubicacionId.toString();
    if (estado != null) queryParams['estado'] = estado;

    return await _makeRequest('/events', 'GET', queryParams: queryParams);
  }

  static Future<Map<String, dynamic>> getEvent(int eventId) async {
    return await _makeRequest('/events/$eventId', 'GET');
  }

  static Future<Map<String, dynamic>> searchEvents(String query) async {
    return await _makeRequest('/events/search', 'GET', queryParams: {'q': query});
  }

  static Future<Map<String, dynamic>> createEvent({
    required String titulo,
    required String descripcion,
    required String fechaInicio,
    required String fechaFin,
    required int ubicacionId,
    required int categoriaId,
    int? capacidadMaxima,
    double? precio,
    String? imagenUrl,
    String estado = 'activo',
  }) async {
    return await _makeRequest('/events', 'POST', body: {
      'titulo': titulo,
      'descripcion': descripcion,
      'fecha_inicio': fechaInicio,
      'fecha_fin': fechaFin,
      'ubicacion_id': ubicacionId,
      'categoria_id': categoriaId,
      if (capacidadMaxima != null) 'capacidad_maxima': capacidadMaxima,
      if (precio != null) 'precio': precio,
      if (imagenUrl != null) 'imagen_url': imagenUrl,
      'estado': estado,
    });
  }

  // ===== MÉTODOS DE ASISTENCIAS =====
  
  static Future<Map<String, dynamic>> attendEvent(int eventId) async {
    return await _makeRequest('/events/$eventId/attend', 'POST');
  }

  static Future<Map<String, dynamic>> unattendEvent(int eventId) async {
    return await _makeRequest('/events/$eventId/unattend', 'DELETE');
  }

  static Future<Map<String, dynamic>> getAttendanceStatus(int eventId) async {
    return await _makeRequest('/events/$eventId/attendance-status', 'GET');
  }

  // ===== MÉTODOS DE FAVORITOS =====
  
  static Future<Map<String, dynamic>> addToFavorites(int eventId) async {
    return await _makeRequest('/events/$eventId/favorite', 'POST');
  }

  static Future<Map<String, dynamic>> removeFromFavorites(int eventId) async {
    return await _makeRequest('/events/$eventId/unfavorite', 'DELETE');
  }

  // ===== MÉTODOS DE CATEGORÍAS Y UBICACIONES =====
  
  static Future<Map<String, dynamic>> getCategories() async {
    return await _makeRequest('/categories', 'GET');
  }

  static Future<Map<String, dynamic>> getLocations() async {
    return await _makeRequest('/locations', 'GET');
  }

  // ===== MÉTODOS DE USUARIO =====
  
  static Future<Map<String, dynamic>> getUserEvents() async {
    return await _makeRequest('/user/events', 'GET');
  }

  static Future<Map<String, dynamic>> getFavoriteEvents() async {
    return await _makeRequest('/user/favorite-events', 'GET');
  }

  static Future<Map<String, dynamic>> updateProfile({
    String? name,
    String? telefono,
    String? fechaNacimiento,
    String? tipoUsuario,
  }) async {
    final body = <String, dynamic>{};
    if (name != null) body['name'] = name;
    if (telefono != null) body['telefono'] = telefono;
    if (fechaNacimiento != null) body['fecha_nacimiento'] = fechaNacimiento;
    if (tipoUsuario != null) body['tipo_usuario'] = tipoUsuario;

    return await _makeRequest('/user/profile', 'PUT', body: body);
  }
}
