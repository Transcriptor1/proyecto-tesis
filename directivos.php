<?php
/**
 * Modulo Directivos - Registrar.
 *
 * Formulario de registro y edicion para la tabla `directivos`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * directivos_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM directivos WHERE id = ?");
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
  <title>Directivos - SIRAD</title>
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
    <h1>Directivos</h1>

    <div class="page-actions">
      <a href="directivos.php" class="active">Registrar</a>
      <a href="directivos_registros.php">Ver registros</a>
      <a href="directivos_exportar.php">Descargar Excel</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="directivos.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>Título<input name="titulo" value="<?= htmlspecialchars($editando['titulo'] ?? '') ?>"></label>
      <label>Nombre<input name="nombre" value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"></label>
      <label>Apellido<input name="apellido" value="<?= htmlspecialchars($editando['apellido'] ?? '') ?>"></label>
      <label>Cédula<input name="cedula" value="<?= htmlspecialchars($editando['cedula'] ?? '') ?>"></label>
      <label>Calidad<input name="calidad" value="<?= htmlspecialchars($editando['calidad'] ?? '') ?>"></label>
      <label>Estado<input name="estado" value="<?= htmlspecialchars($editando['estado'] ?? '') ?>"></label>
      <label>Entidad<input name="entidad" value="<?= htmlspecialchars($editando['entidad'] ?? '') ?>"></label>
      <label>Cargo<input name="cargo" value="<?= htmlspecialchars($editando['cargo'] ?? '') ?>"></label>
      <label>Celular<input name="celular" value="<?= htmlspecialchars($editando['celular'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <label>Integrante<input name="integrante" value="<?= htmlspecialchars($editando['integrante'] ?? '') ?>"></label>
      <label>Vigencia<input name="vigencia" value="<?= htmlspecialchars($editando['vigencia'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE directivos SET titulo = ?, nombre = ?, apellido = ?, cedula = ?, calidad = ?, estado = ?, entidad = ?, cargo = ?, celular = ?, telefono = ?, correo = ?, integrante = ?, vigencia = ? WHERE id = ?");
        $stmt->bind_param("sssssssssssssi", $_POST['titulo'], $_POST['nombre'], $_POST['apellido'], $_POST['cedula'], $_POST['calidad'], $_POST['estado'], $_POST['entidad'], $_POST['cargo'], $_POST['celular'], $_POST['telefono'], $_POST['correo'], $_POST['integrante'], $_POST['vigencia'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO directivos (titulo, nombre, apellido, cedula, calidad, estado, entidad, cargo, celular, telefono, correo, integrante, vigencia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssss", $_POST['titulo'], $_POST['nombre'], $_POST['apellido'], $_POST['cedula'], $_POST['calidad'], $_POST['estado'], $_POST['entidad'], $_POST['cargo'], $_POST['celular'], $_POST['telefono'], $_POST['correo'], $_POST['integrante'], $_POST['vigencia']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: directivos_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
