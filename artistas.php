<?php
/**
 * Modulo Artistas - Registrar.
 *
 * Formulario de registro para la tabla `artistas`. Inserta un nuevo
 * registro mediante sentencia preparada (mysqli bind_param) y redirige
 * a artistas_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";
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

    <form class="form-card" method="POST">
      <label>Nombre<input name="nombre"></label>
      <label>Perfil<input name="perfil"></label>
      <label>Organización<input name="organizacion"></label>
      <label>Agenda<input name="agenda"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <label>Filbo<input name="filbo"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO artistas (nombre, perfil, organizacion, agenda, telefono, correo, filbo) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssssss",
        $_POST['nombre'],
        $_POST['perfil'],
        $_POST['organizacion'],
        $_POST['agenda'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['filbo']
      );
      $stmt->execute();
      $stmt->close();
      header("Location: artistas_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
