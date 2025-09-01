// lib/models/user.dart
class User {
  final int id;
  final String name;
  final String email;
  final String? telefono;
  final String? fechaNacimiento;
  final String tipoUsuario;
  final DateTime? createdAt;

  User({
    required this.id,
    required this.name,
    required this.email,
    this.telefono,
    this.fechaNacimiento,
    required this.tipoUsuario,
    this.createdAt,
  });

  factory User.fromJson(Map<String, dynamic> json) {
    return User(
      id: json['id'],
      name: json['name'],
      email: json['email'],
      telefono: json['telefono'],
      fechaNacimiento: json['fecha_nacimiento'],
      tipoUsuario: json['tipo_usuario'] ?? 'asistente',
      createdAt: json['created_at'] != null ? DateTime.parse(json['created_at']) : null,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'name': name,
      'email': email,
      'telefono': telefono,
      'fecha_nacimiento': fechaNacimiento,
      'tipo_usuario': tipoUsuario,
      'created_at': createdAt?.toIso8601String(),
    };
  }
}

// lib/models/event.dart
class Event {
  final int id;
  final int organizadorId;
  final String titulo;
  final String descripcion;
  final DateTime fechaInicio;
  final DateTime fechaFin;
  final int? ubicacionId;
  final int? categoriaId;
  final int? capacidadMaxima;
  final double? precio;
  final String? imagenUrl;
  final String estado;
  final Category? categoria;
  final Location? ubicacion;
  final User? organizador;

  Event({
    required this.id,
    required this.organizadorId,
    required this.titulo,
    required this.descripcion,
    required this.fechaInicio,
    required this.fechaFin,
    this.ubicacionId,
    this.categoriaId,
    this.capacidadMaxima,
    this.precio,
    this.imagenUrl,
    required this.estado,
    this.categoria,
    this.ubicacion,
    this.organizador,
  });

  factory Event.fromJson(Map<String, dynamic> json) {
    return Event(
      id: json['id'],
      organizadorId: json['organizador_id'],
      titulo: json['titulo'],
      descripcion: json['descripcion'],
      fechaInicio: DateTime.parse(json['fecha_inicio']),
      fechaFin: DateTime.parse(json['fecha_fin']),
      ubicacionId: json['ubicacion_id'],
      categoriaId: json['categoria_id'],
      capacidadMaxima: json['capacidad_maxima'],
      precio: json['precio']?.toDouble(),
      imagenUrl: json['imagen_url'],
      estado: json['estado'],
      categoria: json['categoria'] != null ? Category.fromJson(json['categoria']) : null,
      ubicacion: json['ubicacion'] != null ? Location.fromJson(json['ubicacion']) : null,
      organizador: json['organizador'] != null ? User.fromJson(json['organizador']) : null,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'organizador_id': organizadorId,
      'titulo': titulo,
      'descripcion': descripcion,
      'fecha_inicio': fechaInicio.toIso8601String(),
      'fecha_fin': fechaFin.toIso8601String(),
      'ubicacion_id': ubicacionId,
      'categoria_id': categoriaId,
      'capacidad_maxima': capacidadMaxima,
      'precio': precio,
      'imagen_url': imagenUrl,
      'estado': estado,
    };
  }
}

// lib/models/category.dart
class Category {
  final int id;
  final String nombre;
  final String? descripcion;
  final String? icono;

  Category({
    required this.id,
    required this.nombre,
    this.descripcion,
    this.icono,
  });

  factory Category.fromJson(Map<String, dynamic> json) {
    return Category(
      id: json['id'],
      nombre: json['nombre'],
      descripcion: json['descripcion'],
      icono: json['icono'],
    );
  }
}

// lib/models/location.dart
class Location {
  final int id;
  final String nombre;
  final String? direccion;
  final String? ciudad;
  final String? pais;
  final double? latitud;
  final double? longitud;

  Location({
    required this.id,
    required this.nombre,
    this.direccion,
    this.ciudad,
    this.pais,
    this.latitud,
    this.longitud,
  });

  factory Location.fromJson(Map<String, dynamic> json) {
    return Location(
      id: json['id'],
      nombre: json['nombre'],
      direccion: json['direccion'],
      ciudad: json['ciudad'],
      pais: json['pais'],
      latitud: json['latitud']?.toDouble(),
      longitud: json['longitud']?.toDouble(),
    );
  }
}

// lib/models/api_response.dart
class ApiResponse<T> {
  final bool success;
  final String message;
  final T? data;
  final int statusCode;
  final Map<String, dynamic>? errors;

  ApiResponse({
    required this.success,
    required this.message,
    this.data,
    required this.statusCode,
    this.errors,
  });

  bool get isSuccess => success && statusCode >= 200 && statusCode < 300;
  bool get hasErrors => errors != null && errors!.isNotEmpty;
}
