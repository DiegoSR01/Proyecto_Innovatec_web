// ====================================================================
// EJEMPLO DE USO DE LA API FESTISPOT EN FLUTTER/DART
// ====================================================================

import 'dart:convert';
import 'package:http/http.dart' as http;

class FestiSpotApi {
  static const String baseUrl = 'http://10.250.2.81:8000/api/v1';
  String? _token;

  // Establecer token de autenticación
  void setToken(String token) {
    _token = token;
  }

  // Headers base para las peticiones
  Map<String, String> get _headers => {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    if (_token != null) 'Authorization': 'Bearer $_token',
  };

  // ===== AUTENTICACIÓN =====

  /// Registrar usuario
  Future<ApiResponse> register({
    required String name,
    required String email,
    required String password,
    required String passwordConfirmation,
    required String tipoUsuario,
    String? telefono,
    String? fechaNacimiento,
  }) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/auth/register'),
        headers: _headers,
        body: json.encode({
          'name': name,
          'email': email,
          'password': password,
          'password_confirmation': passwordConfirmation,
          'tipo_usuario': tipoUsuario,
          if (telefono != null) 'telefono': telefono,
          if (fechaNacimiento != null) 'fecha_nacimiento': fechaNacimiento,
        }),
      );

      final data = json.decode(response.body);

      if (response.statusCode == 201 && data['success']) {
        // Guardar token automáticamente
        if (data['data']['access_token'] != null) {
          setToken(data['data']['access_token']);
        }
      }

      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  /// Iniciar sesión
  Future<ApiResponse> login(String email, String password) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/auth/login'),
        headers: _headers,
        body: json.encode({
          'email': email,
          'password': password,
        }),
      );

      final data = json.decode(response.body);

      if (response.statusCode == 200 && data['success']) {
        // Guardar token automáticamente
        if (data['data']['access_token'] != null) {
          setToken(data['data']['access_token']);
        }
      }

      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  /// Cerrar sesión
  Future<ApiResponse> logout() async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/auth/logout'),
        headers: _headers,
      );

      final data = json.decode(response.body);

      if (response.statusCode == 200 && data['success']) {
        // Limpiar token
        _token = null;
      }

      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  /// Obtener usuario actual
  Future<ApiResponse> getCurrentUser() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/auth/me'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  // ===== EVENTOS =====

  /// Obtener lista de eventos
  Future<ApiResponse> getEvents({
    String? fechaInicio,
    String? fechaFin,
    int? categoriaId,
    int? ubicacionId,
    String? estado,
    int? page,
    int? perPage,
  }) async {
    try {
      final queryParams = <String, String>{};
      
      if (fechaInicio != null) queryParams['fecha_inicio'] = fechaInicio;
      if (fechaFin != null) queryParams['fecha_fin'] = fechaFin;
      if (categoriaId != null) queryParams['categoria_id'] = categoriaId.toString();
      if (ubicacionId != null) queryParams['ubicacion_id'] = ubicacionId.toString();
      if (estado != null) queryParams['estado'] = estado;
      if (page != null) queryParams['page'] = page.toString();
      if (perPage != null) queryParams['per_page'] = perPage.toString();

      final uri = Uri.parse('$baseUrl/events').replace(queryParameters: queryParams);
      final response = await http.get(uri, headers: _headers);

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  /// Obtener evento específico
  Future<ApiResponse> getEvent(int eventId) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/events/$eventId'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  /// Crear evento
  Future<ApiResponse> createEvent({
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
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/events'),
        headers: _headers,
        body: json.encode({
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
        }),
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  /// Buscar eventos
  Future<ApiResponse> searchEvents(String query) async {
    try {
      final uri = Uri.parse('$baseUrl/events/search').replace(
        queryParameters: {'q': query},
      );
      final response = await http.get(uri, headers: _headers);

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  // ===== ASISTENCIAS =====

  /// Registrarse a un evento
  Future<ApiResponse> attendEvent(int eventId) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/events/$eventId/attend'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  /// Cancelar asistencia a un evento
  Future<ApiResponse> unattendEvent(int eventId) async {
    try {
      final response = await http.delete(
        Uri.parse('$baseUrl/events/$eventId/unattend'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  /// Verificar estado de asistencia
  Future<ApiResponse> getAttendanceStatus(int eventId) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/events/$eventId/attendance-status'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  // ===== FAVORITOS =====

  /// Agregar evento a favoritos
  Future<ApiResponse> addToFavorites(int eventId) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/events/$eventId/favorite'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  /// Remover evento de favoritos
  Future<ApiResponse> removeFromFavorites(int eventId) async {
    try {
      final response = await http.delete(
        Uri.parse('$baseUrl/events/$eventId/unfavorite'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  // ===== CATEGORÍAS =====

  /// Obtener categorías
  Future<ApiResponse> getCategories() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/categories'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  // ===== UBICACIONES =====

  /// Obtener ubicaciones
  Future<ApiResponse> getLocations() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/locations'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  // ===== USUARIO =====

  /// Obtener eventos del usuario
  Future<ApiResponse> getUserEvents() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/user/events'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }

  /// Obtener eventos favoritos
  Future<ApiResponse> getFavoriteEvents() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/user/favorite-events'),
        headers: _headers,
      );

      final data = json.decode(response.body);
      return ApiResponse.fromJson(data, response.statusCode);
    } catch (e) {
      return ApiResponse.error('Error de conexión: $e');
    }
  }
}

// ===== CLASE DE RESPUESTA =====

class ApiResponse {
  final bool success;
  final String message;
  final dynamic data;
  final int statusCode;
  final Map<String, dynamic>? errors;

  ApiResponse({
    required this.success,
    required this.message,
    this.data,
    required this.statusCode,
    this.errors,
  });

  factory ApiResponse.fromJson(Map<String, dynamic> json, int statusCode) {
    return ApiResponse(
      success: json['success'] ?? false,
      message: json['message'] ?? '',
      data: json['data'],
      statusCode: statusCode,
      errors: json['errors'],
    );
  }

  factory ApiResponse.error(String message) {
    return ApiResponse(
      success: false,
      message: message,
      statusCode: 0,
    );
  }

  bool get isSuccess => success && statusCode >= 200 && statusCode < 300;
}

// ===== EJEMPLO DE USO =====

void main() async {
  final api = FestiSpotApi();

  // 1. Registro
  final registerResponse = await api.register(
    name: 'Juan Pérez',
    email: 'juan@example.com',
    password: 'password123',
    passwordConfirmation: 'password123',
    tipoUsuario: 'asistente',
  );

  if (registerResponse.isSuccess) {
    print('Usuario registrado exitosamente');
    print('Token: ${registerResponse.data['access_token']}');
  }

  // 2. Login
  final loginResponse = await api.login('juan@example.com', 'password123');
  
  if (loginResponse.isSuccess) {
    print('Login exitoso');
  }

  // 3. Obtener eventos
  final eventsResponse = await api.getEvents(perPage: 10);
  
  if (eventsResponse.isSuccess) {
    print('Eventos obtenidos: ${eventsResponse.data['data'].length}');
  }

  // 4. Asistir a un evento
  final attendResponse = await api.attendEvent(1);
  
  if (attendResponse.isSuccess) {
    print('Asistencia registrada');
  }

  // 5. Obtener mis eventos
  final myEventsResponse = await api.getUserEvents();
  
  if (myEventsResponse.isSuccess) {
    print('Mis eventos obtenidos');
  }
}
