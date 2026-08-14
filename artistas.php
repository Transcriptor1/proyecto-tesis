<?php
/**
 * Modulo Artistas - Registrar.
 *
 * Formulario de registro y edicion para la tabla `artistas`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * artistas_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM artistas WHERE id = ?");
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
  <title>Artistas - SIRAD</title>
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
    <h1>Artistas</h1>

    <div class="page-actions">
      <a href="artistas.php" class="active">Registrar</a>
      <a href="artistas_registros.php">Ver registros</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="artistas.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>Nombre<input name="nombre" value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"></label>
      <label>Perfil<input name="perfil" value="<?= htmlspecialchars($editando['perfil'] ?? '') ?>"></label>
      <label>Organización<input name="organizacion" value="<?= htmlspecialchars($editando['organizacion'] ?? '') ?>"></label>
      <label>Agenda<input name="agenda" value="<?= htmlspecialchars($editando['agenda'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <label>Filbo<input name="filbo" value="<?= htmlspecialchars($editando['filbo'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE artistas SET nombre = ?, perfil = ?, organizacion = ?, agenda = ?, telefono = ?, correo = ?, filbo = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $_POST['nombre'], $_POST['perfil'], $_POST['organizacion'], $_POST['agenda'], $_POST['telefono'], $_POST['correo'], $_POST['filbo'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO artistas (nombre, perfil, organizacion, agenda, telefono, correo, filbo) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $_POST['nombre'], $_POST['perfil'], $_POST['organizacion'], $_POST['agenda'], $_POST['telefono'], $_POST['correo'], $_POST['filbo']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: artistas_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
