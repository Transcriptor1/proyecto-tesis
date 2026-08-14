<?php
/**
 * Modulo Medios - Registrar.
 *
 * Formulario de registro y edicion para la tabla `medios`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * medios_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM medios WHERE id = ?");
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
  <title>Medios - SIRAD</title>
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
    <h1>Medios</h1>

    <div class="page-actions">
      <a href="medios.php" class="active">Registrar</a>
      <a href="medios_registros.php">Ver registros</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="medios.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>Categoría<input name="categoria" value="<?= htmlspecialchars($editando['categoria'] ?? '') ?>"></label>
      <label>Medio<input name="medio" value="<?= htmlspecialchars($editando['medio'] ?? '') ?>"></label>
      <label>Fuente<input name="fuente" value="<?= htmlspecialchars($editando['fuente'] ?? '') ?>"></label>
      <label>Nombre<input name="nombre" value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Teléfono 2<input name="telefono2" value="<?= htmlspecialchars($editando['telefono2'] ?? '') ?>"></label>
      <label>Dirección<input name="direccion" value="<?= htmlspecialchars($editando['direccion'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE medios SET categoria = ?, medio = ?, fuente = ?, nombre = ?, correo = ?, telefono = ?, telefono2 = ?, direccion = ? WHERE id = ?");
        $stmt->bind_param("ssssssssi", $_POST['categoria'], $_POST['medio'], $_POST['fuente'], $_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['telefono2'], $_POST['direccion'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO medios (categoria, medio, fuente, nombre, correo, telefono, telefono2, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $_POST['categoria'], $_POST['medio'], $_POST['fuente'], $_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['telefono2'], $_POST['direccion']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: medios_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
