<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Categoria;
use App\Models\ConfiguracionUsuario;

class ConfigurationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        $configuracion = $user->configuraciones;
        $categorias = Categoria::where('activo', true)->get();
        
        // Si el usuario no tiene configuración, crear una por defecto
        if (!$configuracion) {
            $configuracion = ConfiguracionUsuario::create([
                'usuario_id' => $user->id,
                'notificaciones_push' => true,
                'notificaciones_email' => true,
                'categorias_favoritas' => null,
                'radio_busqueda_km' => 50,
                'idioma' => 'es',
                'tema' => 'auto',
            ]);
        }

        return view('configuration', compact('user', 'configuracion', 'categorias'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date|before:today',
            'genero' => 'nullable|in:masculino,femenino,otro,prefiero_no_decir',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->genero = $request->genero;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatarFile = $request->file('avatar');
            
            // Validar tamaño y tipo
            if ($avatarFile->getSize() > 5 * 1024 * 1024) { // 5MB máximo
                return response()->json(['success' => false, 'message' => 'El avatar debe ser menor a 5MB'], 400);
            }
            
            // Leer el archivo como datos binarios
            $imageData = file_get_contents($avatarFile->getPathname());
            $mimeType = $avatarFile->getMimeType();
            
            // Verificar que sea una imagen válida
            if (!str_starts_with($mimeType, 'image/')) {
                return response()->json(['success' => false, 'message' => 'El archivo debe ser una imagen válida'], 400);
            }
            
            // Limpiar avatar anterior (tanto archivo como BLOB)
            if ($user->avatar_url && Storage::disk('public')->exists(str_replace('storage/', '', $user->avatar_url))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $user->avatar_url));
            }
            
            // Guardar como BLOB en la base de datos
            $user->avatar_data = $imageData;
            $user->avatar_mime_type = $mimeType;
            $user->avatar_url = null; // Limpiar la URL del archivo
        }

        $user->save();

        return response()->json(['success' => true, 'message' => 'Perfil actualizado correctamente']);
    }

    public function updateNotifications(Request $request)
    {
        $request->validate([
            'notificaciones_push' => 'boolean',
            'notificaciones_email' => 'boolean',
        ]);

        $user = Auth::user();
        $configuracion = $user->configuraciones;

        if (!$configuracion) {
            $configuracion = ConfiguracionUsuario::create([
                'usuario_id' => $user->id,
                'notificaciones_push' => $request->notificaciones_push ?? true,
                'notificaciones_email' => $request->notificaciones_email ?? true,
                'radio_busqueda_km' => 50,
                'idioma' => 'es',
                'tema' => 'auto',
            ]);
        } else {
            $configuracion->notificaciones_push = $request->notificaciones_push ?? false;
            $configuracion->notificaciones_email = $request->notificaciones_email ?? false;
            $configuracion->save();
        }

        return response()->json(['success' => true, 'message' => 'Configuración de notificaciones actualizada']);
    }

    public function updatePreferences(Request $request)
    {
        $request->validate([
            'categorias_favoritas' => 'nullable|array',
            'categorias_favoritas.*' => 'exists:categorias,id',
            'radio_busqueda_km' => 'nullable|integer|min:1|max:500',
            'idioma' => 'nullable|in:es,en',
            'tema' => 'nullable|in:claro,oscuro,auto',
        ]);

        $user = Auth::user();
        $configuracion = $user->configuraciones;

        if (!$configuracion) {
            $configuracion = ConfiguracionUsuario::create([
                'usuario_id' => $user->id,
                'notificaciones_push' => true,
                'notificaciones_email' => true,
                'categorias_favoritas' => $request->categorias_favoritas,
                'radio_busqueda_km' => $request->radio_busqueda_km ?? 50,
                'idioma' => $request->idioma ?? 'es',
                'tema' => $request->tema ?? 'auto',
            ]);
        } else {
            $configuracion->categorias_favoritas = $request->categorias_favoritas;
            $configuracion->radio_busqueda_km = $request->radio_busqueda_km ?? $configuracion->radio_busqueda_km;
            $configuracion->idioma = $request->idioma ?? $configuracion->idioma;
            $configuracion->tema = $request->tema ?? $configuracion->tema;
            $configuracion->save();
        }

        return response()->json(['success' => true, 'message' => 'Preferencias actualizadas correctamente']);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false, 
                'message' => 'La contraseña actual no es correcta'
            ], 400);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Contraseña actualizada correctamente']);
    }
}