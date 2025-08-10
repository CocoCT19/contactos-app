<?php
$servidor   = "localhost";
$usuario    = "root";
$contrasena = "1234";
$base_datos = "agenda_contactos";
$charset    = "utf8mb4";

$dsn = "mysql:host=$servidor;dbname=$base_datos;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $conn = new PDO($dsn, $usuario, $contrasena, $options);
} catch (PDOException $e) {
    
    echo "Error de conexión a la base de datos.";
    
    exit;
}
