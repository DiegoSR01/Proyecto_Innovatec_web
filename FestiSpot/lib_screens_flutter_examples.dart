// lib/screens/login_screen.dart
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../providers/auth_provider.dart';

class LoginScreen extends StatefulWidget {
  @override
  _LoginScreenState createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final _formKey = GlobalKey<FormState>();
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Iniciar Sesión')),
      body: Consumer<AuthProvider>(
        builder: (context, authProvider, child) {
          return Padding(
            padding: EdgeInsets.all(16.0),
            child: Form(
              key: _formKey,
              child: Column(
                children: [
                  TextFormField(
                    controller: _emailController,
                    decoration: InputDecoration(labelText: 'Email'),
                    validator: (value) {
                      if (value?.isEmpty ?? true) return 'Email requerido';
                      return null;
                    },
                  ),
                  SizedBox(height: 16),
                  TextFormField(
                    controller: _passwordController,
                    decoration: InputDecoration(labelText: 'Contraseña'),
                    obscureText: true,
                    validator: (value) {
                      if (value?.isEmpty ?? true) return 'Contraseña requerida';
                      return null;
                    },
                  ),
                  SizedBox(height: 24),
                  if (authProvider.error != null)
                    Container(
                      padding: EdgeInsets.all(8),
                      decoration: BoxDecoration(
                        color: Colors.red.shade100,
                        borderRadius: BorderRadius.circular(4),
                      ),
                      child: Text(
                        authProvider.error!,
                        style: TextStyle(color: Colors.red),
                      ),
                    ),
                  SizedBox(height: 16),
                  SizedBox(
                    width: double.infinity,
                    child: ElevatedButton(
                      onPressed: authProvider.isLoading ? null : _login,
                      child: authProvider.isLoading
                          ? CircularProgressIndicator()
                          : Text('Iniciar Sesión'),
                    ),
                  ),
                ],
              ),
            ),
          );
        },
      ),
    );
  }

  void _login() async {
    if (_formKey.currentState?.validate() ?? false) {
      final authProvider = Provider.of<AuthProvider>(context, listen: false);
      final success = await authProvider.login(
        _emailController.text,
        _passwordController.text,
      );
      
      if (success) {
        Navigator.pushReplacementNamed(context, '/home');
      }
    }
  }
}

// lib/screens/events_screen.dart
import 'package:flutter/material.dart';
import '../services/api_service.dart';
import '../models/event.dart';

class EventsScreen extends StatefulWidget {
  @override
  _EventsScreenState createState() => _EventsScreenState();
}

class _EventsScreenState extends State<EventsScreen> {
  List<Event> events = [];
  bool isLoading = true;
  String? error;

  @override
  void initState() {
    super.initState();
    _loadEvents();
  }

  Future<void> _loadEvents() async {
    setState(() {
      isLoading = true;
      error = null;
    });

    try {
      final result = await ApiService.getEvents();
      if (result['success']) {
        final eventsList = result['data']['data'] as List;
        setState(() {
          events = eventsList.map((e) => Event.fromJson(e)).toList();
        });
      } else {
        setState(() {
          error = result['message'];
        });
      }
    } catch (e) {
      setState(() {
        error = 'Error al cargar eventos: $e';
      });
    } finally {
      setState(() {
        isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Eventos'),
        actions: [
          IconButton(
            icon: Icon(Icons.search),
            onPressed: () => _showSearchDialog(),
          ),
        ],
      ),
      body: _buildBody(),
      floatingActionButton: FloatingActionButton(
        onPressed: () => Navigator.pushNamed(context, '/create-event'),
        child: Icon(Icons.add),
      ),
    );
  }

  Widget _buildBody() {
    if (isLoading) {
      return Center(child: CircularProgressIndicator());
    }
    
    if (error != null) {
      return Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(error!, style: TextStyle(color: Colors.red)),
            SizedBox(height: 16),
            ElevatedButton(
              onPressed: _loadEvents,
              child: Text('Reintentar'),
            ),
          ],
        ),
      );
    }
    
    if (events.isEmpty) {
      return Center(
        child: Text('No hay eventos disponibles'),
      );
    }
    
    return RefreshIndicator(
      onRefresh: _loadEvents,
      child: ListView.builder(
        itemCount: events.length,
        itemBuilder: (context, index) {
          final event = events[index];
          return EventCard(
            event: event,
            onTap: () => _navigateToEventDetail(event),
            onAttend: () => _attendEvent(event.id),
          );
        },
      ),
    );
  }

  void _navigateToEventDetail(Event event) {
    Navigator.pushNamed(context, '/event-detail', arguments: event);
  }

  Future<void> _attendEvent(int eventId) async {
    try {
      final result = await ApiService.attendEvent(eventId);
      if (result['success']) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Te has registrado al evento')),
        );
        _loadEvents(); // Recargar eventos
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text(result['message'])),
        );
      }
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Error al registrarse: $e')),
      );
    }
  }

  void _showSearchDialog() {
    showDialog(
      context: context,
      builder: (context) => SearchEventsDialog(
        onSearch: (query) async {
          final result = await ApiService.searchEvents(query);
          if (result['success']) {
            final eventsList = result['data']['data'] as List;
            setState(() {
              events = eventsList.map((e) => Event.fromJson(e)).toList();
            });
          }
        },
      ),
    );
  }
}

// lib/widgets/event_card.dart
class EventCard extends StatelessWidget {
  final Event event;
  final VoidCallback onTap;
  final VoidCallback onAttend;

  const EventCard({
    Key? key,
    required this.event,
    required this.onTap,
    required this.onAttend,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: EdgeInsets.all(8),
      child: InkWell(
        onTap: onTap,
        child: Padding(
          padding: EdgeInsets.all(16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              if (event.imagenUrl != null)
                Container(
                  height: 200,
                  width: double.infinity,
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(8),
                    image: DecorationImage(
                      image: NetworkImage(event.imagenUrl!),
                      fit: BoxFit.cover,
                    ),
                  ),
                ),
              SizedBox(height: 12),
              Text(
                event.titulo,
                style: Theme.of(context).textTheme.titleLarge,
                maxLines: 2,
                overflow: TextOverflow.ellipsis,
              ),
              SizedBox(height: 8),
              Text(
                event.descripcion,
                style: Theme.of(context).textTheme.bodyMedium,
                maxLines: 3,
                overflow: TextOverflow.ellipsis,
              ),
              SizedBox(height: 12),
              Row(
                children: [
                  Icon(Icons.calendar_today, size: 16),
                  SizedBox(width: 4),
                  Text(_formatDate(event.fechaInicio)),
                  Spacer(),
                  if (event.precio != null)
                    Text('\$${event.precio!.toStringAsFixed(0)}'),
                ],
              ),
              SizedBox(height: 8),
              if (event.ubicacion != null)
                Row(
                  children: [
                    Icon(Icons.location_on, size: 16),
                    SizedBox(width: 4),
                    Expanded(child: Text(event.ubicacion!.nombre)),
                  ],
                ),
              SizedBox(height: 12),
              Row(
                children: [
                  if (event.categoria != null)
                    Chip(
                      label: Text(event.categoria!.nombre),
                      backgroundColor: Colors.blue.shade100,
                    ),
                  Spacer(),
                  ElevatedButton.icon(
                    onPressed: onAttend,
                    icon: Icon(Icons.event_available),
                    label: Text('Asistir'),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }

  String _formatDate(DateTime date) {
    return '${date.day}/${date.month}/${date.year} ${date.hour}:${date.minute.toString().padLeft(2, '0')}';
  }
}
