<?php

require_once __DIR__ . '/vendor/autoload.php';

echo "=== PRUEBA DE API FESTISPOT ===\n\n";

$baseUrl = "http://10.250.2.81:8000/api/v1";

// Función para hacer peticiones HTTP
function makeRequest($url, $method = 'GET', $data = null, $token = null) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    $headers = [
        'Content-Type: application/json',
        'Accept: application/json'
    ];
    
    if ($token) {
        $headers[] = "Authorization: Bearer $token";
    }
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    } elseif ($method === 'PUT') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    } elseif ($method === 'DELETE') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_error($ch)) {
        echo "Error cURL: " . curl_error($ch) . "\n";
        curl_close($ch);
        return false;
    }
    
    curl_close($ch);
    
    $decodedResponse = json_decode($response, true);
    
    return [
        'status_code' => $httpCode,
        'response' => $decodedResponse
    ];
}

// 1. Probar obtener eventos (sin autenticación)
echo "1. Probando GET /events (público)\n";
$result = makeRequest("$baseUrl/events");
if ($result) {
    echo "Status: " . $result['status_code'] . "\n";
    if ($result['response']['success']) {
        echo "✅ Éxito: Se obtuvieron " . count($result['response']['data']['data']) . " eventos\n";
    } else {
        echo "❌ Error: " . $result['response']['message'] . "\n";
    }
} else {
    echo "❌ Error en la petición\n";
}
echo "\n";

// 2. Probar obtener categorías
echo "2. Probando GET /categories (público)\n";
$result = makeRequest("$baseUrl/categories");
if ($result) {
    echo "Status: " . $result['status_code'] . "\n";
    if ($result['response']['success']) {
        echo "✅ Éxito: Se obtuvieron " . count($result['response']['data']) . " categorías\n";
    } else {
        echo "❌ Error: " . $result['response']['message'] . "\n";
    }
} else {
    echo "❌ Error en la petición\n";
}
echo "\n";

// 3. Probar obtener ubicaciones
echo "3. Probando GET /locations (público)\n";
$result = makeRequest("$baseUrl/locations");
if ($result) {
    echo "Status: " . $result['status_code'] . "\n";
    if ($result['response']['success']) {
        echo "✅ Éxito: Se obtuvieron " . count($result['response']['data']) . " ubicaciones\n";
    } else {
        echo "❌ Error: " . $result['response']['message'] . "\n";
    }
} else {
    echo "❌ Error en la petición\n";
}
echo "\n";

// 4. Probar registro de usuario
echo "4. Probando POST /auth/register\n";
$userData = [
    'name' => 'Usuario API Test',
    'email' => 'test_api_' . time() . '@example.com',
    'password' => 'password123',
    'password_confirmation' => 'password123',
    'tipo_usuario' => 'asistente'
];

$result = makeRequest("$baseUrl/auth/register", 'POST', $userData);
if ($result) {
    echo "Status: " . $result['status_code'] . "\n";
    if ($result['response']['success']) {
        echo "✅ Éxito: Usuario registrado\n";
        $token = $result['response']['data']['access_token'];
        echo "Token obtenido: " . substr($token, 0, 20) . "...\n";
        
        // 5. Probar endpoint autenticado
        echo "\n5. Probando GET /auth/me (autenticado)\n";
        $result = makeRequest("$baseUrl/auth/me", 'GET', null, $token);
        if ($result) {
            echo "Status: " . $result['status_code'] . "\n";
            if ($result['response']['success']) {
                echo "✅ Éxito: Usuario autenticado - " . $result['response']['data']['name'] . "\n";
            } else {
                echo "❌ Error: " . $result['response']['message'] . "\n";
            }
        }
        
        // 6. Probar logout
        echo "\n6. Probando POST /auth/logout\n";
        $result = makeRequest("$baseUrl/auth/logout", 'POST', null, $token);
        if ($result) {
            echo "Status: " . $result['status_code'] . "\n";
            if ($result['response']['success']) {
                echo "✅ Éxito: Logout exitoso\n";
            } else {
                echo "❌ Error: " . $result['response']['message'] . "\n";
            }
        }
    } else {
        echo "❌ Error en registro: " . $result['response']['message'] . "\n";
    }
} else {
    echo "❌ Error en la petición\n";
}

echo "\n=== FIN DE PRUEBAS ===\n";
