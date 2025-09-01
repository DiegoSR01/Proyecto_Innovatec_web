<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

// Inicializar la aplicación Laravel
$app->boot();

use App\Models\Event;

$events = Event::all();

echo "Total de eventos en la base de datos: " . $events->count() . PHP_EOL;
echo "========================================" . PHP_EOL;

foreach ($events as $event) {
    echo "ID: " . $event->id . PHP_EOL;
    echo "Título: " . $event->titulo . PHP_EOL;
    echo "Descripción: " . $event->descripcion . PHP_EOL;
    echo "Organizador ID: " . $event->organizador_id . PHP_EOL;
    echo "Fecha creación: " . $event->created_at . PHP_EOL;
    echo "----------------------------------------" . PHP_EOL;
}
