<?php
/**
 * Administracion de usuarios - Editar.
 *
 * Permite a un administrador modificar el nombre, correo y rol de una
 * cuenta, desbloquearla si tiene un bloqueo activo por intentos
 * fallidos, o restablecerle la contrasena. Evita quitarle el rol de
 * administrador al ultimo administrador del sistema. Solo accesible
 * para administradores. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";
require_once "includes/layout.php";
require_once "includes/csrf.php";
require_admin();

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$usuario) {
    header("Location: usuarios.php");
    exit;
}

$error = "";
if ($_POST) {
    csrf_verify();

    if (isset($_POST['guardar_datos'])) {
        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $rol = $_POST['rol'] === 'admin' ? 'admin' : 'usuario';

        if ($nombre === '' || $correo === '') {
            $error = "Nombre y correo son obligatorios.";
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $error = "El correo no tiene un formato válido.";
        } else {
            $check = $conn->prepare("SELECT id FROM usuarios WHERE correo = ? AND id <> ?");
            $check->bind_param("si", $correo, $id);
            $check->execute();
            $check->store_result();
            if ($check->num_rows > 0) {
                $error = "Ya existe otra cuenta con ese correo.";
            }
            $check->close();
        }

        if ($error === '' && $usuario['rol'] === 'admin' && $rol !== 'admin') {
            $totalAdmins = (int) $conn->query("SELECT COUNT(*) AS total FROM usuarios WHERE rol = 'admin'")->fetch_assoc()['total'];
            if ($totalAdmins <= 1) {
                $error = "No puedes quitarle el rol de administrador al único administrador del sistema.";
            }
        }

        if ($error === '') {
            $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, correo = ?, rol = ? WHERE id = ?");
            $stmt->bind_param("sssi", $nombre, $correo, $rol, $id);
            $stmt->execute();
            $stmt->close();

            if ($id === (int) $_SESSION['usuario_id']) {
                $_SESSION['usuario_nombre'] = $nombre;
                $_SESSION['usuario_rol'] = $rol;
            }

            header("Location: usuarios.php?msg=" . rawurlencode("Usuario actualizado") . "&tipo=success");
            exit;
        }

        $usuario['nombre'] = $nombre;
        $usuario['correo'] = $correo;
        $usuario['rol'] = $rol;
    } elseif (isset($_POST['restablecer_password'])) {
        $nueva = $_POST['password_nueva'] ?? '';
        if (strlen($nueva) < 6) {
            $error = "La nueva contraseña debe tener al menos 6 caracteres.";
        } else {
            $hash = password_hash($nueva, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE usuarios SET password = ?, intentos_fallidos = 0, bloqueado_hasta = NULL WHERE id = ?");
            $stmt->bind_param("si", $hash, $id);
            $stmt->execute();
            $stmt->close();
            header("Location: usuarios.php?msg=" . rawurlencode("Contraseña restablecida") . "&tipo=success");
            exit;
        }
    } elseif (isset($_POST['desbloquear'])) {
        $stmt = $conn->prepare("UPDATE usuarios SET intentos_fallidos = 0, bloqueado_hasta = NULL WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        header("Location: usuarios.php?msg=" . rawurlencode("Cuenta desbloqueada") . "&tipo=success");
        exit;
    }
}

$bloqueado = $usuario['bloqueado_hasta'] && strtotime($usuario['bloqueado_hasta']) > time();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Editar usuario - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/animations.js" defer></script>
</head>

<body>

  <?php render_header(); ?>

  <main>
    <h1>Editar usuario</h1>

    <p class="edit-notice">Editando a <?= htmlspecialchars($usuario['nombre']) ?> &mdash; <a href="usuarios.php">Volver a usuarios</a></p>

    <?php if ($error): ?>
      <p class="auth-error" style="margin-bottom: 16px;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php csrf_field(); ?>
      <input type="hidden" name="id" value="<?= (int) $usuario['id'] ?>">
      <label>Nombre<input name="nombre" required value="<?= htmlspecialchars($usuario['nombre']) ?>"></label>
      <label>Correo<input name="correo" type="email" required value="<?= htmlspecialchars($usuario['correo']) ?>"></label>
      <label>Rol
        <select name="rol">
          <option value="usuario" <?= $usuario['rol'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
          <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
        </select>
      </label>
      <button type="submit" name="guardar_datos" value="1">Guardar cambios</button>
    </form>

    <?php if ($bloqueado): ?>
      <div class="export-bar">
        <form method="POST">
          <?php csrf_field(); ?>
          <input type="hidden" name="id" value="<?= (int) $usuario['id'] ?>">
          <p style="margin: 0;">Esta cuenta está bloqueada temporalmente por intentos fallidos de inicio de sesión.</p>
          <button type="submit" name="desbloquear" value="1">Desbloquear cuenta</button>
        </form>
      </div>
    <?php endif; ?>

    <div class="export-bar">
      <form method="POST">
        <?php csrf_field(); ?>
        <input type="hidden" name="id" value="<?= (int) $usuario['id'] ?>">
        <label>Nueva contraseña<input type="password" name="password_nueva" minlength="6" required></label>
        <button type="submit" name="restablecer_password" value="1">Restablecer contraseña</button>
      </form>
    </div>
  </main>

</body>

</html>
