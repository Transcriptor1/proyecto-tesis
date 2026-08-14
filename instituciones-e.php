<?php
/**
 * Modulo Instituciones Educativas - Registrar.
 *
 * Formulario de registro y edicion para la tabla `instituciones_e`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * instituciones-e_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM instituciones_e WHERE id = ?");
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
  <title>Instituciones Educativas - SIRAD</title>
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
    <h1>Instituciones Educativas</h1>

    <div class="page-actions">
      <a href="instituciones-e.php" class="active">Registrar</a>
      <a href="instituciones-e_registros.php">Ver registros</a>
      <a href="instituciones-e_exportar.php">Descargar Excel</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="instituciones-e.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>Clase<input name="clase" value="<?= htmlspecialchars($editando['clase'] ?? '') ?>"></label>
      <label>Nombre<input name="nombre" value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"></label>
      <label>NIT<input name="nit" value="<?= htmlspecialchars($editando['nit'] ?? '') ?>"></label>
      <label>Calidad<input name="calidad" value="<?= htmlspecialchars($editando['calidad'] ?? '') ?>"></label>
      <label>Jornada<input name="jornada" value="<?= htmlspecialchars($editando['jornada'] ?? '') ?>"></label>
      <label>Contacto<input name="contacto" value="<?= htmlspecialchars($editando['contacto'] ?? '') ?>"></label>
      <label>Cargo<input name="cargo" value="<?= htmlspecialchars($editando['cargo'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Dirección<input name="direccion" value="<?= htmlspecialchars($editando['direccion'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <label>Ciudad<input name="ciudad" value="<?= htmlspecialchars($editando['ciudad'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE instituciones_e SET clase = ?, nombre = ?, nit = ?, calidad = ?, jornada = ?, contacto = ?, cargo = ?, telefono = ?, direccion = ?, correo = ?, ciudad = ? WHERE id = ?");
        $stmt->bind_param("sssssssssssi", $_POST['clase'], $_POST['nombre'], $_POST['nit'], $_POST['calidad'], $_POST['jornada'], $_POST['contacto'], $_POST['cargo'], $_POST['telefono'], $_POST['direccion'], $_POST['correo'], $_POST['ciudad'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO instituciones_e (clase, nombre, nit, calidad, jornada, contacto, cargo, telefono, direccion, correo, ciudad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $_POST['clase'], $_POST['nombre'], $_POST['nit'], $_POST['calidad'], $_POST['jornada'], $_POST['contacto'], $_POST['cargo'], $_POST['telefono'], $_POST['direccion'], $_POST['correo'], $_POST['ciudad']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: instituciones-e_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
