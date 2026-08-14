<?php
/**
 * Modulo Practicantes - Registrar.
 *
 * Formulario de registro y edicion para la tabla `practicantes`. Inserta un
 * nuevo registro o actualiza uno existente (parametro GET "id") mediante
 * sentencias preparadas (mysqli bind_param) y redirige a
 * practicantes_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$editando = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM practicantes WHERE id = ?");
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
  <title>Practicantes - SIRAD</title>
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
    <h1>Practicantes</h1>

    <div class="page-actions">
      <a href="practicantes.php" class="active">Registrar</a>
      <a href="practicantes_registros.php">Ver registros</a>
      <a href="practicantes_exportar.php">Descargar Excel</a>
    </div>

    <?php if ($editando): ?>
      <p class="edit-notice">Editando registro #<?= (int) $editando['id'] ?> &mdash; <a href="practicantes.php">Cancelar</a></p>
    <?php endif; ?>

    <form class="form-card" method="POST">
      <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= (int) $editando['id'] ?>">
      <?php endif; ?>
      <label>Nombre<input name="nombre" value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"></label>
      <label>Teléfono<input name="telefono" value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"></label>
      <label>Correo<input name="correo" value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"></label>
      <label>Dirección<input name="direccion" value="<?= htmlspecialchars($editando['direccion'] ?? '') ?>"></label>
      <label>Disciplina<input name="disciplina" value="<?= htmlspecialchars($editando['disciplina'] ?? '') ?>"></label>
      <label>Generación<input name="generacion" value="<?= htmlspecialchars($editando['generacion'] ?? '') ?>"></label>
      <label>Fecha inicio<input name="inicio" type="date" value="<?= htmlspecialchars($editando['inicio'] ?? '') ?>"></label>
      <label>Fecha fin<input name="fin" type="date" value="<?= htmlspecialchars($editando['fin'] ?? '') ?>"></label>
      <label>Cumpleaños<input name="cumple" type="date" value="<?= htmlspecialchars($editando['cumple'] ?? '') ?>"></label>
      <label>Contacto de emergencia<input name="contacto" value="<?= htmlspecialchars($editando['contacto'] ?? '') ?>"></label>
      <label>Teléfono contacto<input name="telefono_contacto" value="<?= htmlspecialchars($editando['telefono_contacto'] ?? '') ?>"></label>
      <button><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    </form>

    <?php
    if ($_POST) {
      if (!empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE practicantes SET nombre = ?, telefono = ?, correo = ?, direccion = ?, disciplina = ?, generacion = ?, inicio = ?, fin = ?, cumple = ?, contacto = ?, telefono_contacto = ? WHERE id = ?");
        $stmt->bind_param("sssssssssssi", $_POST['nombre'], $_POST['telefono'], $_POST['correo'], $_POST['direccion'], $_POST['disciplina'], $_POST['generacion'], $_POST['inicio'], $_POST['fin'], $_POST['cumple'], $_POST['contacto'], $_POST['telefono_contacto'], $id);
      } else {
        $stmt = $conn->prepare("INSERT INTO practicantes (nombre, telefono, correo, direccion, disciplina, generacion, inicio, fin, cumple, contacto, telefono_contacto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $_POST['nombre'], $_POST['telefono'], $_POST['correo'], $_POST['direccion'], $_POST['disciplina'], $_POST['generacion'], $_POST['inicio'], $_POST['fin'], $_POST['cumple'], $_POST['contacto'], $_POST['telefono_contacto']);
      }
      $stmt->execute();
      $stmt->close();
      header("Location: practicantes_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
