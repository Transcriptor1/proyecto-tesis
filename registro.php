<?php
/**
 * Registro de usuario.
 *
 * Crea una cuenta nueva en la tabla `usuarios`, validando campos
 * obligatorios, longitud minima de contrasena y correo duplicado. La
 * contrasena y la respuesta de seguridad se guardan encriptadas con
 * password_hash() (bcrypt). El primer usuario que se registra en el
 * sistema queda automaticamente como administrador; los siguientes se
 * crean con rol de usuario normal.
 */
session_start();
include "conexion.php";
require_once "includes/csrf.php";

if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$preguntas = [
    '¿Cuál es el nombre de tu primera mascota?',
    '¿En qué ciudad naciste?',
    '¿Cuál es tu comida favorita?',
    '¿Cuál es el nombre de tu mejor amigo de la infancia?',
];

$error = "";
if ($_POST) {
    csrf_verify();
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];
    $pregunta = trim($_POST['pregunta'] ?? '');
    $respuesta = trim($_POST['respuesta'] ?? '');

    if ($nombre === '' || $correo === '' || $password === '' || $pregunta === '' || $respuesta === '') {
        $error = "Todos los campos son obligatorios.";
    } elseif (!in_array($pregunta, $preguntas, true)) {
        $error = "Selecciona una pregunta de seguridad válida.";
    } elseif (strlen($password) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $check = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $check->bind_param("s", $correo);
        $check->execute();
        $check->store_result();
        if ($check->num_rows > 0) {
            $error = "Ya existe una cuenta con ese correo.";
        }
        $check->close();
    }

    if ($error === '') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $respuestaHash = password_hash(mb_strtolower($respuesta), PASSWORD_DEFAULT);

        $totalUsuarios = $conn->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];
        $rol = ((int) $totalUsuarios === 0) ? 'admin' : 'usuario';

        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password, rol, pregunta_seguridad, respuesta_seguridad_hash) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nombre, $correo, $hash, $rol, $pregunta, $respuestaHash);
        $stmt->execute();
        $stmt->close();
        header("Location: login.php?registrado=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear usuario - SIRAD</title>
    <link rel="stylesheet" href="css/styles.css">
  <script src="js/animations.js" defer></script>
</head>

<body>

    <div class="auth-page">
        <form class="form-card auth-card" method="POST">
            <h1>SIRAD</h1>
            <p class="auth-subtitle">Crear cuenta</p>

            <?php if ($error): ?>
                <p class="auth-error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <?php csrf_field(); ?>
            <label>Nombre<input name="nombre" required value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>"></label>
            <label>Correo<input type="email" name="correo" required value="<?= htmlspecialchars($_POST['correo'] ?? '') ?>"></label>
            <label>Contraseña<input type="password" name="password" required minlength="6"></label>
            <label>Pregunta de seguridad
                <select name="pregunta" required>
                    <option value="">Selecciona una pregunta...</option>
                    <?php foreach ($preguntas as $p): ?>
                        <option value="<?= htmlspecialchars($p) ?>" <?= (($_POST['pregunta'] ?? '') === $p) ? 'selected' : '' ?>><?= htmlspecialchars($p) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Respuesta<input name="respuesta" required></label>
            <p class="auth-subtitle">La pregunta de seguridad sirve para recuperar tu contraseña si la olvidas.</p>
            <button>Crear cuenta</button>
            <p class="auth-link">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
        </form>
    </div>

</body>

</html>
