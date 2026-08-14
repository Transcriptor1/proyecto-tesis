<?php
/**
 * Modulo Mercadeo - Registrar.
 *
 * Formulario de registro y edicion para la tabla `mercadeo`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * mercadeo_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM mercadeo WHERE id = ?");
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
  <title>Mercadeo - SIRAD</title>
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
    <h1>Mercadeo</h1>

    <div class="page-actions">
      <a href="mercadeo.php" class="active">Registrar</a>
      <a href="mercadeo_registros.php">Ver registros</a>
      <a href="mercadeo_exportar.php">Descargar Excel</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="mercadeo.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>Empresa<input name="empresa" value="<?= htmlspecialchars($editando['empresa'] ?? '') ?>"></label>
      <label>Nombre<input name="nombre" value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"></label>
      <label>Cargo<input name="cargo" value="<?= htmlspecialchars($editando['cargo'] ?? '') ?>"></label>
      <label>Tema<input name="tema" value="<?= htmlspecialchars($editando['tema'] ?? '') ?>"></label>
      <label>Contacto<input name="contacto" value="<?= htmlspecialchars($editando['contacto'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <label>Dirección<input name="direccion" value="<?= htmlspecialchars($editando['direccion'] ?? '') ?>"></label>
      <label>Proyecto<input name="proyecto" value="<?= htmlspecialchars($editando['proyecto'] ?? '') ?>"></label>
      <label>Patrocinio<input name="patrocinio" value="<?= htmlspecialchars($editando['patrocinio'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE mercadeo SET empresa = ?, nombre = ?, cargo = ?, tema = ?, contacto = ?, telefono = ?, correo = ?, direccion = ?, proyecto = ?, patrocinio = ? WHERE id = ?");
        $stmt->bind_param("ssssssssssi", $_POST['empresa'], $_POST['nombre'], $_POST['cargo'], $_POST['tema'], $_POST['contacto'], $_POST['telefono'], $_POST['correo'], $_POST['direccion'], $_POST['proyecto'], $_POST['patrocinio'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO mercadeo (empresa, nombre, cargo, tema, contacto, telefono, correo, direccion, proyecto, patrocinio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $_POST['empresa'], $_POST['nombre'], $_POST['cargo'], $_POST['tema'], $_POST['contacto'], $_POST['telefono'], $_POST['correo'], $_POST['direccion'], $_POST['proyecto'], $_POST['patrocinio']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: mercadeo_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
