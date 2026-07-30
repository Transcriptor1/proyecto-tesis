<?php require "auth.php"; include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Medios - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
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

    <form class="form-card" method="POST">
      <label>Categoría<input name="categoria"></label>
      <label>Medio<input name="medio"></label>
      <label>Fuente<input name="fuente"></label>
      <label>Nombre<input name="nombre"></label>
      <label>Correo<input name="correo"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Teléfono 2<input name="telefono2"></label>
      <label>Dirección<input name="direccion"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO medios (categoria, medio, fuente, nombre, correo, telefono, telefono2, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "ssssssss",
        $_POST['categoria'],
        $_POST['medio'],
        $_POST['fuente'],
        $_POST['nombre'],
        $_POST['correo'],
        $_POST['telefono'],
        $_POST['telefono2'],
        $_POST['direccion']
      );
      $stmt->execute();
      $stmt->close();
      header("Location: medios_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
