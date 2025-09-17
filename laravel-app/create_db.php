<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->exec("CREATE DATABASE IF NOT EXISTS laravel_prueba");
    echo "Base de datos 'laravel_prueba' creada exitosamente.\n";
} catch (PDOException $e) {
    echo "Error al crear la base de datos: " . $e->getMessage() . "\n";
}
?>