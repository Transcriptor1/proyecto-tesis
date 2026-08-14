<?php
/**
 * Modulo Proveedores - Registrar.
 *
 * Formulario de registro y edicion para la tabla `proveedores`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * proveedores_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM proveedores WHERE id = ?");
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
  <title>Proveedores - SIRAD</title>
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
    <h1>Proveedores</h1>

    <div class="page-actions">
      <a href="proveedores.php" class="active">Registrar</a>
      <a href="proveedores_registros.php">Ver registros</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="proveedores.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>País<input name="pais" value="<?= htmlspecialchars($editando['pais'] ?? '') ?>"></label>
      <label>Nombre<input name="nombre" value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"></label>
      <label>Dirección<input name="direccion" value="<?= htmlspecialchars($editando['direccion'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE proveedores SET pais = ?, nombre = ?, direccion = ?, telefono = ?, correo = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $_POST['pais'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['correo'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO proveedores (pais, nombre, direccion, telefono, correo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $_POST['pais'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['correo']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: proveedores_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
