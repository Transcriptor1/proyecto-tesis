<?php
/**
 * Registro de usuario.
 *
 * Crea una cuenta nueva en la tabla `usuarios`, validando campos
 * obligatorios, longitud minima de contrasena y correo duplicado. La
 * contrasena se guarda encriptada con password_hash() (bcrypt).
 */
session_start();
include "conexion.php";

if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$error = "";
if ($_POST) {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];

    if ($nombre === '' || $correo === '' || $password === '') {
        $error = "Todos los campos son obligatorios.";
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
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $correo, $hash);
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
</head>

<body>

    <div class="auth-page">
        <form class="form-card auth-card" method="POST">
            <h1>SIRAD</h1>
            <p class="auth-subtitle">Crear cuenta</p>

            <?php if ($error): ?>
                <p class="auth-error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <label>Nombre<input name="nombre" required></label>
            <label>Correo<input type="email" name="correo" required></label>
            <label>Contraseña<input type="password" name="password" required minlength="6"></label>
            <button>Crear cuenta</button>
            <p class="auth-link">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
        </form>
    </div>

</body>

</html>
