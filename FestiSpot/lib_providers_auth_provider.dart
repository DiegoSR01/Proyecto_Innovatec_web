// lib/providers/auth_provider.dart
import 'package:flutter/foundation.dart';
import '../models/user.dart';
import '../services/api_service.dart';

class AuthProvider with ChangeNotifier {
  User? _user;
  bool _isLoading = false;
  String? _error;

  User? get user => _user;
  bool get isLoading => _isLoading;
  String? get error => _error;
  bool get isAuthenticated => _user != null;

  // Login
  Future<bool> login(String email, String password) async {
    _setLoading(true);
    _error = null;

    try {
      final result = await ApiService.login(email, password);
      
      if (result['success']) {
        _user = User.fromJson(result['data']['user']);
        notifyListeners();
        return true;
      } else {
        _error = result['message'];
        return false;
      }
    } catch (e) {
      _error = 'Error de conexión: $e';
      return false;
    } finally {
      _setLoading(false);
    }
  }

  // Registro
  Future<bool> register({
    required String name,
    required String email,
    required String password,
    required String passwordConfirmation,
    required String tipoUsuario,
    String? telefono,
  }) async {
    _setLoading(true);
    _error = null;

    try {
      final result = await ApiService.register(
        name: name,
        email: email,
        password: password,
        passwordConfirmation: passwordConfirmation,
        tipoUsuario: tipoUsuario,
        telefono: telefono,
      );
      
      if (result['success']) {
        _user = User.fromJson(result['data']['user']);
        notifyListeners();
        return true;
      } else {
        _error = result['message'];
        return false;
      }
    } catch (e) {
      _error = 'Error de conexión: $e';
      return false;
    } finally {
      _setLoading(false);
    }
  }

  // Logout
  Future<void> logout() async {
    _setLoading(true);
    try {
      await ApiService.logout();
    } finally {
      _user = null;
      _setLoading(false);
      notifyListeners();
    }
  }

  // Verificar si hay un usuario autenticado al iniciar la app
  Future<void> checkAuthStatus() async {
    final token = await ApiService.getToken();
    if (token != null) {
      try {
        final result = await ApiService.getCurrentUser();
        if (result['success']) {
          _user = User.fromJson(result['data']);
          notifyListeners();
        }
      } catch (e) {
        // Token inválido, limpiar
        await ApiService.deleteToken();
      }
    }
  }

  // Actualizar perfil
  Future<bool> updateProfile({
    String? name,
    String? telefono,
    String? fechaNacimiento,
    String? tipoUsuario,
  }) async {
    _setLoading(true);
    _error = null;

    try {
      final result = await ApiService.updateProfile(
        name: name,
        telefono: telefono,
        fechaNacimiento: fechaNacimiento,
        tipoUsuario: tipoUsuario,
      );
      
      if (result['success']) {
        _user = User.fromJson(result['data']);
        notifyListeners();
        return true;
      } else {
        _error = result['message'];
        return false;
      }
    } catch (e) {
      _error = 'Error de conexión: $e';
      return false;
    } finally {
      _setLoading(false);
    }
  }

  void _setLoading(bool loading) {
    _isLoading = loading;
    notifyListeners();
  }

  void clearError() {
    _error = null;
    notifyListeners();
  }
}
