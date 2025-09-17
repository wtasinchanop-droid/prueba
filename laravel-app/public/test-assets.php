<?php
// Archivo de prueba para verificar rutas de assets
echo "<h1>Prueba de Assets en WAMP64</h1>";

echo "<h2>Información del servidor:</h2>";
echo "<p><strong>REQUEST_URI:</strong> " . ($_SERVER['REQUEST_URI'] ?? 'No definido') . "</p>";
echo "<p><strong>HTTP_HOST:</strong> " . ($_SERVER['HTTP_HOST'] ?? 'No definido') . "</p>";
echo "<p><strong>DOCUMENT_ROOT:</strong> " . ($_SERVER['DOCUMENT_ROOT'] ?? 'No definido') . "</p>";
echo "<p><strong>SCRIPT_NAME:</strong> " . ($_SERVER['SCRIPT_NAME'] ?? 'No definido') . "</p>";

echo "<h2>Verificación de archivos:</h2>";

$cssFile = __DIR__ . '/css/admin_custom.css';
echo "<p><strong>CSS File:</strong> " . $cssFile . "</p>";
echo "<p><strong>CSS Exists:</strong> " . (file_exists($cssFile) ? 'SÍ' : 'NO') . "</p>";

$livewireFile = __DIR__ . '/vendor/livewire/livewire.js';
echo "<p><strong>Livewire File:</strong> " . $livewireFile . "</p>";
echo "<p><strong>Livewire Exists:</strong> " . (file_exists($livewireFile) ? 'SÍ' : 'NO') . "</p>";

echo "<h2>URLs que deberían funcionar:</h2>";
$baseUrl = 'http://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/prueba/laravel-app/public';
echo "<p><a href='{$baseUrl}/css/admin_custom.css' target='_blank'>{$baseUrl}/css/admin_custom.css</a></p>";
echo "<p><a href='{$baseUrl}/vendor/livewire/livewire.js' target='_blank'>{$baseUrl}/vendor/livewire/livewire.js</a></p>";
?>