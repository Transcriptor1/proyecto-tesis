<?php
/**
 * Modulo Talleristas - Registrar.
 *
 * Formulario de registro y edicion para la tabla `talleristas`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * talleristas_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM talleristas WHERE id = ?");
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
  <title>Talleristas - SIRAD</title>
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
    <h1>Talleristas</h1>

    <div class="page-actions">
      <a href="talleristas.php" class="active">Registrar</a>
      <a href="talleristas_registros.php">Ver registros</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="talleristas.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>Nombre<input name="nombre" value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <label>Cargo<input name="cargo" value="<?= htmlspecialchars($editando['cargo'] ?? '') ?>"></label>
      <label>Perfil<input name="perfil" value="<?= htmlspecialchars($editando['perfil'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE talleristas SET nombre = ?, telefono = ?, correo = ?, cargo = ?, perfil = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $_POST['nombre'], $_POST['telefono'], $_POST['correo'], $_POST['cargo'], $_POST['perfil'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO talleristas (nombre, telefono, correo, cargo, perfil) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $_POST['nombre'], $_POST['telefono'], $_POST['correo'], $_POST['cargo'], $_POST['perfil']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: talleristas_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
