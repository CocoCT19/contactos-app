<?php
require_once 'database.php';

function crearContacto($nombre, $telefono, $email, $usuario_id) {
    global $conn;
    $sql = "INSERT INTO contactos (nombre, telefono, email, usuario_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([trim($nombre), trim($telefono), trim($email), $usuario_id]);
}

function obtenerContactos($usuario_id) {
    global $conn;
    $sql = "SELECT * FROM contactos WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$usuario_id]);
    return $stmt->fetchAll();
}

function eliminarContacto($id, $usuario_id) {
    global $conn;
    $sql = "DELETE FROM contactos WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id, $usuario_id]);
}       

function actualizarContacto($id, $nombre, $telefono, $email, $usuario_id) {
    global $conn;

    $sql = "UPDATE contactos 
            SET nombre = ?, telefono = ?, email = ? 
            WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([($nombre), ($telefono), ($email), $id, $usuario_id]);
}

function obtenerContactoPorId($id, $usuario_id) {
    global $db;
    $stmt = $db->prepare("SELECT id, nombre, telefono, email FROM contactos WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$id, $usuario_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
