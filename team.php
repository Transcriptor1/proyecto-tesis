<?php
/**
 * Modulo Team - Registrar.
 *
 * Formulario de registro y edicion para la tabla `team_pombo`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * team_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM team_pombo WHERE id = ?");
  $id = (int) $_GET['id'];
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $editando = $stmt->get_result()->fetch_assoc();
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Team - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/animations.js" defer></script>
</head>

<body>

  <header>
    <div class="logo">SIRAD</div>
    <div class="header-actions">
      <span>Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
      <a href="index.php">&larr; Volver al directorio</a>
      <a href="logout.php">Cerrar sesión</a>
    </div>
  </header>

  <main>
    <h1>Team</h1>

    <div class="page-actions">
      <a href="team.php" class="active">Registrar</a>
      <a href="team_registros.php">Ver registros</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="team.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>Nombre<input name="nombre" value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"></label>
      <label>Apellido<input name="apellido" value="<?= htmlspecialchars($editando['apellido'] ?? '') ?>"></label>
      <label>Celular<input name="celular" value="<?= htmlspecialchars($editando['celular'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <label>Cargo<input name="cargo" value="<?= htmlspecialchars($editando['cargo'] ?? '') ?>"></label>
      <label>Cumpleaños<input name="cumple" type="date" value="<?= htmlspecialchars($editando['cumple'] ?? '') ?>"></label>
      <label>Contacto de emergencia<input name="contacto" value="<?= htmlspecialchars($editando['contacto'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Fecha inicio<input name="inicio" type="date" value="<?= htmlspecialchars($editando['inicio'] ?? '') ?>"></label>
      <label>Fecha fin<input name="fin" type="date" value="<?= htmlspecialchars($editando['fin'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE team_pombo SET nombre = ?, apellido = ?, celular = ?, correo = ?, cargo = ?, cumple = ?, contacto = ?, telefono = ?, inicio = ?, fin = ? WHERE id = ?");
        $stmt->bind_param("ssssssssssi", $_POST['nombre'], $_POST['apellido'], $_POST['celular'], $_POST['correo'], $_POST['cargo'], $_POST['cumple'], $_POST['contacto'], $_POST['telefono'], $_POST['inicio'], $_POST['fin'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO team_pombo (nombre, apellido, celular, correo, cargo, cumple, contacto, telefono, inicio, fin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $_POST['nombre'], $_POST['apellido'], $_POST['celular'], $_POST['correo'], $_POST['cargo'], $_POST['cumple'], $_POST['contacto'], $_POST['telefono'], $_POST['inicio'], $_POST['fin']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: team_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
