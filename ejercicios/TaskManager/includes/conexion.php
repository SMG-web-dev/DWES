<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'taskmanager';
$username = 'root';
$password = '';

try {
    // Establecer conexión con la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Mostrar un mensaje de error y detener la ejecución
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
