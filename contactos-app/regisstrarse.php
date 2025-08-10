<?php
include 'includes/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    if ($nombre && $email && $contrasena) {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)");

        try {
            $stmt->execute([$nombre, $email, $hash]);
            $_SESSION['usuario_id'] = $conn->lastInsertId();
            $_SESSION['nombre'] = $nombre;
            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            $error = "Error al registrar el usuario: " . $e->getMessage();
        }
    } else {
        $error = "Por favor, completa todos los campos.";
    }
}
?>
<h1>Registro de Usuario</h1>
<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="contrasena" required><br><br>

    <input type="submit" value="Registrar">
</form>
<a href="login.php">Ya tengo una cuenta</a>
