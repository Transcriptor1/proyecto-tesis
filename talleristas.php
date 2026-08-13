<?php
/**
 * Modulo Talleristas - Registrar.
 *
 * Formulario de registro para la tabla `talleristas`. Inserta un nuevo
 * registro mediante sentencia preparada (mysqli bind_param) y redirige
 * a talleristas_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Talleristas - SIRAD</title>
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
    <h1>Talleristas</h1>

    <div class="page-actions">
      <a href="talleristas.php" class="active">Registrar</a>
      <a href="talleristas_registros.php">Ver registros</a>
    </div>

    <form class="form-card" method="POST">
      <label>Nombre<input name="nombre"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Perfil<input name="perfil"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO talleristas (nombre, telefono, correo, cargo, perfil) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssss",
        $_POST['nombre'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['cargo'],
        $_POST['perfil']
      );
      $stmt->execute();
      $stmt->close();
      header("Location: talleristas_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
