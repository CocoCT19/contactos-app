<?php
require_once 'includes/funciones.php';
require_once 'includes/database.php'; 
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    die('ID de contacto no especificado.');
}

$id = ($_GET['id']);
$usuario_id = $_SESSION['usuario_id'];

$stmt = $conn->prepare("SELECT * FROM contactos WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $usuario_id]);
$contacto = $stmt->fetch();

if (!$contacto) {
    die('Contacto no encontrado o no autorizado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);

    if (empty($nombre) || empty($telefono) || empty($email)) {
        die('Por favor, complete todos los campos.');
    }

    $stmt = $conn->prepare("UPDATE contactos SET nombre = ?, telefono = ?, email = ? WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$nombre, $telefono, $email, $id, $usuario_id]);

    header('Location: index.php');
    exit();
}
?>

<h2>Editar contacto</h2>
<form method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($contacto['nombre']); ?>" required>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($contacto['telefono']); ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($contacto['email']); ?>" required>

    <button type="submit">Actualizar</button>
</form>

<a href="index.php">Cancelar</a>
