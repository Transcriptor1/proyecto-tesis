<?php
/**
 * Inicio de sesion.
 *
 * Verifica las credenciales del usuario contra la tabla `usuarios`
 * mediante sentencia preparada y password_verify() (nunca se compara
 * la contrasena en texto plano). Bloquea la cuenta 15 minutos tras 5
 * intentos fallidos consecutivos. Si son validas, crea la sesion
 * (incluyendo el rol) y redirige a index.php.
 */
session_start();
include "conexion.php";
require_once "includes/csrf.php";

if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$error = "";
if ($_POST) {
    csrf_verify();
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nombre, password, rol, intentos_fallidos, bloqueado_hasta FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $bloqueadoHasta = $user['bloqueado_hasta'] ?? null;
    if ($user && $bloqueadoHasta && strtotime($bloqueadoHasta) > time()) {
        $minutos = (int) ceil((strtotime($bloqueadoHasta) - time()) / 60);
        $error = "Cuenta bloqueada temporalmente por varios intentos fallidos. Intenta de nuevo en $minutos minuto(s).";
    } elseif ($user && password_verify($password, $user['password'])) {
        $reset = $conn->prepare("UPDATE usuarios SET intentos_fallidos = 0, bloqueado_hasta = NULL WHERE id = ?");
        $reset->bind_param("i", $user['id']);
        $reset->execute();
        $reset->close();

        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];
        $_SESSION['usuario_rol'] = $user['rol'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Correo o contraseña incorrectos.";
        if ($user) {
            $intentos = (int) $user['intentos_fallidos'] + 1;
            $bloqueo = $intentos >= 5 ? date('Y-m-d H:i:s', time() + 15 * 60) : null;
            $upd = $conn->prepare("UPDATE usuarios SET intentos_fallidos = ?, bloqueado_hasta = ? WHERE id = ?");
            $upd->bind_param("isi", $intentos, $bloqueo, $user['id']);
            $upd->execute();
            $upd->close();
            if ($bloqueo) {
                $error = "Cuenta bloqueada temporalmente por varios intentos fallidos. Intenta de nuevo en 15 minuto(s).";
            }
        }
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
            <?php if (isset($_GET['restablecido'])): ?>
                <p class="auth-success">Contraseña actualizada. Ya puedes iniciar sesión.</p>
            <?php endif; ?>

            <?php csrf_field(); ?>
            <label>Correo<input type="email" name="correo" required></label>
            <label>Contraseña<input type="password" name="password" required></label>
            <button>Ingresar</button>
            <p class="auth-link">¿No tienes cuenta? <a href="registro.php">Crear usuario</a></p>
            <p class="auth-link">¿Olvidaste tu contraseña? <a href="recuperar.php">Recuperarla</a></p>
        </form>
    </div>

</body>

</html>
