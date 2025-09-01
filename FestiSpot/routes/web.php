<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::get('/', function () {
    return view('login');
});
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/register', function () {
    return view('register');
});
// Simulación de login y registro (redirigen al dashboard)
Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

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
Route::get('/configuration', function () {
    return view('configuration');
})->name('configuration');