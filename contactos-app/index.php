<?php
session_start();
require_once 'includes/database.php';
require_once 'includes/funciones.php'; 


if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$nombre_usuario = $_SESSION['nombre'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'crear') {
    $nombre   = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $email    = trim($_POST['email'] ?? '');

    if ($nombre && $telefono && $email) {
        crearContacto($nombre, $telefono, $email, $usuario_id);
        $mensaje = "Contacto agregado correctamente.";
    } else {
        $error = "Por favor, completa todos los campos.";
    }
}


if (isset($_GET['eliminar'])) {
    $id = (int) $_GET['eliminar'];
    eliminarContacto($id, $usuario_id);
    header("Location: index.php");
    exit;
}


$contactos = obtenerContactos($usuario_id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda de Contactos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

<h1>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></h1>
<a href="logout.php">Cerrar sesión</a>

<h2>Agregar nuevo contacto</h2>
<?php if (!empty($mensaje)) echo "<p style='color:green'>$mensaje</p>"; ?>
<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="POST">
    <input type="hidden" name="accion" value="crear">
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br><br>

    <label>Teléfono:</label>
    <input type="text" name="telefono" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <input type="submit" value="Guardar contacto">
</form>

<h2>Mis contactos</h2>
<?php if ($contactos): ?>
<table>
    <tr>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($contactos as $contacto): ?>
    <tr>
        <td><?php echo htmlspecialchars($contacto['nombre']); ?></td>
        <td><?php echo htmlspecialchars($contacto['telefono']); ?></td>
        <td><?php echo htmlspecialchars($contacto['email']); ?></td>
        <td>
            <a href="editar.php?id=<?php echo $contacto['id']; ?>">Editar</a> |
            <a href="index.php?eliminar=<?php echo $contacto['id']; ?>" onclick="return confirm('¿Seguro que quieres eliminar este contacto?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>No tienes contactos guardados.</p>
<?php endif; ?>

</body>
</html>
