<?php
/**
 * Modulo Editoriales - Registrar.
 *
 * Formulario de registro y edicion para la tabla `editoriales`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * editoriales_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM editoriales WHERE id = ?");
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
  <title>Editoriales - SIRAD</title>
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
    <h1>Editoriales</h1>

    <div class="page-actions">
      <a href="editoriales.php" class="active">Registrar</a>
      <a href="editoriales_registros.php">Ver registros</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="editoriales.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>Nombre<input name="nombre" value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"></label>
      <label>NIT<input name="nit" value="<?= htmlspecialchars($editando['nit'] ?? '') ?>"></label>
      <label>Contacto<input name="contacto" value="<?= htmlspecialchars($editando['contacto'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Dirección<input name="direccion" value="<?= htmlspecialchars($editando['direccion'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <label>Descuento<input name="descuento" value="<?= htmlspecialchars($editando['descuento'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE editoriales SET nombre = ?, nit = ?, contacto = ?, telefono = ?, direccion = ?, correo = ?, descuento = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $_POST['nombre'], $_POST['nit'], $_POST['contacto'], $_POST['telefono'], $_POST['direccion'], $_POST['correo'], $_POST['descuento'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO editoriales (nombre, nit, contacto, telefono, direccion, correo, descuento) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $_POST['nombre'], $_POST['nit'], $_POST['contacto'], $_POST['telefono'], $_POST['direccion'], $_POST['correo'], $_POST['descuento']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: editoriales_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
