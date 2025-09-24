<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImagenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas de autenticación
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard');
    Route::get('/event-modify-new', function () {
        return view('event_modify_new');
    });

    Route::get('/mis-eventos', [EventController::class, 'myEvents'])->name('mis.eventos');

    Route::get('/solicitudes-productores', function () {
        return view('solicitudes_productores');
    })->name('solicitudes.productores');

    // Rutas para eventos (controlador)
    Route::prefix('event')->name('event.')->controller(EventController::class)->group(function () {
        // Crear evento (formulario)
        Route::get('/create', 'create')->name('create');

        // Guardar nombre/descripcion/categoria
        Route::post('/store-name', 'storeName')->name('storeName');

        // Fechas
        Route::get('/date', 'date')->name('date');
        Route::post('/store-date', 'storeDate')->name('storeDate');

        // Ubicación
        Route::get('/location', 'showLocation')->name('location');
        Route::post('/store-location', 'storeLocation')->name('storeLocation');

        // Media
        Route::get('/media', 'showMediaForm')->name('media');
        Route::post('/store-media', 'storeMedia')->name('storeMedia');
        Route::post('/remove-media', 'removeMedia')->name('removeMedia');
        Route::post('/remove-media-item', 'removeMediaItem')->name('removeMediaItem');

        // Resumen y preview
        Route::get('/summary', 'showSummary')->name('summary');
        Route::get('/preview', 'showPreview')->name('preview');
        
        // Guardar evento final
        Route::post('/store', 'store')->name('store');
        
        // Ver y eliminar eventos
        Route::get('/{event}', 'show')->name('show');
        Route::delete('/{event}', 'destroy')->name('destroy');

        // Rutas auxiliares para limpiar sesiones
        Route::post('/clear/basic', 'clearBasic')->name('clearBasic');
        Route::post('/clear/date', 'clearDate')->name('clearDate');
        Route::post('/clear/location', 'clearLocation')->name('clearLocation');
        Route::post('/clear/media', 'clearMedia')->name('clearMedia');
        Route::post('/clear/all', 'clearAll')->name('clearAll');
    });

    // Ruta para limpiar toda la sesión del evento
    Route::post('/event/clear-all', [EventController::class, 'clearAll'])->name('event.clearAll');

    // Rutas para modificación de eventos
    Route::get('/events/modify', function () {
        return view('event_modification_list');
    })->name('events.modification.list');

    Route::get('/events/modify/{id}', function ($id) {
        return view('event_modify', ['eventId' => $id]);
    })->name('events.modification.edit');

    Route::post('/events/modify/{id}', function ($id) {
        return redirect()->route('events.modification.list')->with('success', 'Evento modificado correctamente');
    })->name('events.modification.update');

    // Rutas para suscripciones
    Route::get('/subscription/plans', function () {
        return view('subscription_plans');
    })->name('subscription.plans');

    Route::get('/subscription/checkout', function () {
        return view('subscription_checkout');
    })->name('subscription.checkout');

    Route::post('/subscription/checkout', function () {
        return redirect()->route('subscription.success')->with('success', 'Suscripción activada correctamente');
    })->name('subscription.process');

    Route::get('/subscription/success', function () {
        return view('subscription_success');
    })->name('subscription.success');

    // Ruta para la página de configuración
    Route::get('/configuration', [App\Http\Controllers\ConfigurationController::class, 'index'])->name('configuration');
    Route::post('/configuration/profile', [App\Http\Controllers\ConfigurationController::class, 'updateProfile'])->name('configuration.profile');
    Route::post('/configuration/notifications', [App\Http\Controllers\ConfigurationController::class, 'updateNotifications'])->name('configuration.notifications');
    Route::post('/configuration/preferences', [App\Http\Controllers\ConfigurationController::class, 'updatePreferences'])->name('configuration.preferences');
    Route::post('/configuration/password', [App\Http\Controllers\ConfigurationController::class, 'changePassword'])->name('configuration.password');
    
    // Rutas para imágenes BLOB
    Route::get('/imagen/{id}', [ImagenController::class, 'mostrar'])->name('imagen.mostrar');
    Route::post('/imagen/subir', [ImagenController::class, 'subir'])->name('imagen.subir');
    Route::delete('/imagen/{id}', [ImagenController::class, 'eliminar'])->name('imagen.eliminar');
    
    // Ruta para mostrar avatares BLOB
    Route::get('/avatar/{id}', [ImagenController::class, 'mostrarAvatar'])->name('avatar.show');
    
    // Ruta de debug para imágenes
    Route::get('/debug-images', function() {
        $imagenes = App\Models\ImagenEvento::with('evento')->take(10)->get();
        return view('debug-images', compact('imagenes'));
    })->name('debug.images');
    
    // Ruta de debug para eventos
    Route::get('/debug-eventos', function() {
        $events = App\Models\Event::with(['imagenes'])->orderBy('created_at', 'desc')->take(10)->get();
        return view('debug-eventos', compact('events'));
    })->name('debug.eventos');
    
    // Rutas de debug temporales
    Route::get('/debug-eventos', [EventController::class, 'debugEventos'])->name('debug.eventos');
    Route::get('/debug-logs', function () {
        return view('debug-logs');
    })->name('debug.logs');
    
    // Ruta para migrar imágenes legacy a BLOB
    Route::get('/migrar-imagenes', function() {
        $controller = new App\Http\Controllers\EventController();
        $events = App\Models\Event::whereNotNull('banner_image')->get();
        $migratedCount = 0;
        
        foreach ($events as $event) {
            $result = $controller->migrarImagenLegacyABlob($event);
            if ($result) {
                $migratedCount++;
            }
        }
        
        return response()->json([
            'message' => "Migración completada. {$migratedCount} imágenes migradas.",
            'total_events' => $events->count(),
            'migrated' => $migratedCount
        ]);
    })->name('migrar.imagenes');
});