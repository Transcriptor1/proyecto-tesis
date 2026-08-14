<?php
/**
 * Administracion de usuarios - Listado.
 *
 * Muestra todas las cuentas registradas en el sistema (nombre, correo,
 * rol y estado de bloqueo), con enlaces para editar o eliminar cada
 * una. No permite eliminar la propia cuenta ni al ultimo administrador
 * del sistema. Solo accesible para administradores. Requiere sesion
 * activa (auth.php).
 */
require "auth.php";
include "conexion.php";
require_once "includes/layout.php";
require_once "includes/csrf.php";
require_admin();

if (isset($_POST['eliminar_id'])) {
    csrf_verify();
    $idEliminar = (int) $_POST['eliminar_id'];
    $errorEliminar = "";

    if ($idEliminar === (int) $_SESSION['usuario_id']) {
        $errorEliminar = "No puedes eliminar tu propia cuenta.";
    } else {
        $stmt = $conn->prepare("SELECT rol FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $idEliminar);
        $stmt->execute();
        $objetivo = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($objetivo && $objetivo['rol'] === 'admin') {
            $totalAdmins = (int) $conn->query("SELECT COUNT(*) AS total FROM usuarios WHERE rol = 'admin'")->fetch_assoc()['total'];
            if ($totalAdmins <= 1) {
                $errorEliminar = "No puedes eliminar al único administrador del sistema.";
            }
        }

        if ($errorEliminar === "" && $objetivo) {
            $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->bind_param("i", $idEliminar);
            $stmt->execute();
            $stmt->close();
            header("Location: usuarios.php?msg=" . rawurlencode("Usuario eliminado") . "&tipo=success");
            exit;
        }
    }

    if ($errorEliminar !== "") {
        header("Location: usuarios.php?msg=" . rawurlencode($errorEliminar) . "&tipo=error");
        exit;
    }
}

$r = $conn->query("SELECT id, nombre, correo, rol, intentos_fallidos, bloqueado_hasta, creado_en FROM usuarios ORDER BY nombre");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Usuarios - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/animations.js" defer></script>
  <script src="js/toast.js" defer></script>
  <script src="js/table-tools.js" defer></script>
</head>

<body>

  <?php render_header(); ?>

  <main>
    <h1>Usuarios registrados</h1>

    <?php if ($r->num_rows === 0): ?>
      <p class="empty-state">No hay usuarios registrados.</p>
    <?php else: ?>
      <div class="search-bar">
        <input type="text" placeholder="Buscar en la tabla...">
      </div>

      <div class="table-card">
        <table>
          <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Creado</th>
            <th>Acciones</th>
          </tr>
          <?php while ($u = $r->fetch_assoc()):
            $bloqueado = $u['bloqueado_hasta'] && strtotime($u['bloqueado_hasta']) > time();
          ?>
            <tr>
              <td><?= htmlspecialchars($u['nombre']) ?></td>
              <td><?= htmlspecialchars($u['correo']) ?></td>
              <td><span class="pill <?= $u['rol'] === 'admin' ? 'pill-admin' : '' ?>"><?= $u['rol'] === 'admin' ? 'Administrador' : 'Usuario' ?></span></td>
              <td><span class="pill <?= $bloqueado ? 'pill-blocked' : '' ?>"><?= $bloqueado ? 'Bloqueada' : 'Activa' ?></span></td>
              <td><?= htmlspecialchars(date('Y-m-d', strtotime($u['creado_en']))) ?></td>
              <td>
                <a href="usuario_editar.php?id=<?= (int) $u['id'] ?>" class="btn-edit">Editar</a>
                <?php if ((int) $u['id'] !== (int) $_SESSION['usuario_id']): ?>
                  <form method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar esta cuenta? Esta acción no se puede deshacer.');">
                    <?php csrf_field(); ?>
                    <input type="hidden" name="eliminar_id" value="<?= (int) $u['id'] ?>">
                    <button type="submit" class="btn-delete">Borrar</button>
                  </form>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>
      <div class="pagination"></div>
    <?php endif; ?>
  </main>

</body>

</html>
