<?php
/**
 * Modulo Editoriales - Registrar.
 *
 * Formulario de registro para la tabla `editoriales`. Inserta un nuevo
 * registro mediante sentencia preparada (mysqli bind_param) y redirige
 * a editoriales_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";
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

    <form class="form-card" method="POST">
      <label>Nombre<input name="nombre"></label>
      <label>NIT<input name="nit"></label>
      <label>Contacto<input name="contacto"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Correo<input name="correo"></label>
      <label>Descuento<input name="descuento"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO editoriales (nombre, nit, contacto, telefono, direccion, correo, descuento) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssssss",
        $_POST['nombre'],
        $_POST['nit'],
        $_POST['contacto'],
        $_POST['telefono'],
        $_POST['direccion'],
        $_POST['correo'],
        $_POST['descuento']
      );
      $stmt->execute();
      $stmt->close();
      header("Location: editoriales_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
