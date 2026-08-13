<?php
/**
 * Inicio de sesion.
 *
 * Verifica las credenciales del usuario contra la tabla `usuarios`
 * mediante sentencia preparada y password_verify() (nunca se compara
 * la contrasena en texto plano). Si son validas, crea la sesion y
 * redirige a index.php.
 */
session_start();
include "conexion.php";

if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$error = "";
if ($_POST) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - SIRAD</title>
    <link rel="stylesheet" href="css/styles.css">
  <script src="js/animations.js" defer></script>
</head>

<body>

    <div class="auth-page">
        <form class="form-card auth-card" method="POST">
            <h1>SIRAD</h1>
            <p class="auth-subtitle">Sistema de Registro y Administración de Directorios</p>

            <?php if ($error): ?>
                <p class="auth-error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <?php if (isset($_GET['registrado'])): ?>
                <p class="auth-success">Cuenta creada. Ya puedes iniciar sesión.</p>
            <?php endif; ?>

            <label>Correo<input type="email" name="correo" required></label>
            <label>Contraseña<input type="password" name="password" required></label>
            <button>Ingresar</button>
            <p class="auth-link">¿No tienes cuenta? <a href="registro.php">Crear usuario</a></p>
        </form>
    </div>

</body>

</html>
