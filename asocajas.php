<?php
/**
 * Modulo Asocajas - Registrar.
 *
 * Formulario de registro y edicion para la tabla `asocajas`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * asocajas_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM asocajas WHERE id = ?");
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
  <title>Asocajas - SIRAD</title>
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
    <h1>Asocajas</h1>

    <div class="page-actions">
      <a href="asocajas.php" class="active">Registrar</a>
      <a href="asocajas_registros.php">Ver registros</a>
      <a href="asocajas_exportar.php">Descargar Excel</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="asocajas.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>Caja<input name="caja" value="<?= htmlspecialchars($editando['caja'] ?? '') ?>"></label>
      <label>Departamento<input name="departamento" value="<?= htmlspecialchars($editando['departamento'] ?? '') ?>"></label>
      <label>Cargo<input name="cargo" value="<?= htmlspecialchars($editando['cargo'] ?? '') ?>"></label>
      <label>Contacto<input name="contacto" value="<?= htmlspecialchars($editando['contacto'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Dirección<input name="direccion" value="<?= htmlspecialchars($editando['direccion'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE asocajas SET caja = ?, departamento = ?, cargo = ?, contacto = ?, telefono = ?, direccion = ?, correo = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $_POST['caja'], $_POST['departamento'], $_POST['cargo'], $_POST['contacto'], $_POST['telefono'], $_POST['direccion'], $_POST['correo'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO asocajas (caja, departamento, cargo, contacto, telefono, direccion, correo) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $_POST['caja'], $_POST['departamento'], $_POST['cargo'], $_POST['contacto'], $_POST['telefono'], $_POST['direccion'], $_POST['correo']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: asocajas_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
