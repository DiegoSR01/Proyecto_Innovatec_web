<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Ruta de prueba
Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'API FestiSpot funcionando correctamente',
        'version' => 'v1',
        'timestamp' => now()
    ]);
});

// Rutas públicas (sin autenticación)
Route::prefix('v1')->group(function () {
    
    // Autenticación
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
    
    // Eventos públicos
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{id}', [EventController::class, 'show']);
    Route::get('/events/category/{categoryId}', [EventController::class, 'byCategory']);
    Route::get('/events/location/{locationId}', [EventController::class, 'byLocation']);
    Route::get('/events/search', [EventController::class, 'search']);
    
    // Categorías
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    
    // Ubicaciones
    Route::get('/locations', [LocationController::class, 'index']);
    Route::get('/locations/{id}', [LocationController::class, 'show']);
    
    // Reviews de eventos (públicas)
    Route::get('/events/{eventId}/reviews', [ReviewController::class, 'eventReviews']);
});

// Rutas protegidas (requieren autenticación)
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    
    // Autenticación
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/change-password', [AuthController::class, 'changePassword']);
    
    // Usuario
    Route::get('/user/profile', [UserController::class, 'profile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::get('/user/events', [UserController::class, 'myEvents']);
    Route::get('/user/organized-events', [UserController::class, 'organizedEvents']);
    Route::get('/user/attended-events', [UserController::class, 'attendedEvents']);
    Route::get('/user/favorite-events', [UserController::class, 'favoriteEvents']);
    
    // Eventos - CRUD para organizadores
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);
    
    // Asistencias
    Route::post('/events/{eventId}/attend', [AttendanceController::class, 'attend']);
    Route::delete('/events/{eventId}/unattend', [AttendanceController::class, 'unattend']);
    Route::get('/events/{eventId}/attendees', [AttendanceController::class, 'eventAttendees']);
    Route::get('/events/{eventId}/attendance-status', [AttendanceController::class, 'attendanceStatus']);
    
    // Favoritos
    Route::post('/events/{eventId}/favorite', [EventController::class, 'addToFavorites']);
    Route::delete('/events/{eventId}/unfavorite', [EventController::class, 'removeFromFavorites']);
    
    // Reviews
    Route::post('/events/{eventId}/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
    Route::get('/user/reviews', [ReviewController::class, 'userReviews']);
    
    // Notificaciones
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::put('/notifications/read-all', [NotificationController::class, 'markAllAsRead']);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
    
});
