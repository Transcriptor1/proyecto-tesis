<?php require "auth.php"; include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Instituciones Educativas - SIRAD</title>
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
    <h1>Instituciones Educativas</h1>

    <div class="page-actions">
      <a href="instituciones-e.php" class="active">Registrar</a>
      <a href="instituciones-e_registros.php">Ver registros</a>
    </div>

    <form class="form-card" method="POST">
      <label>Clase institución<input name="clase"></label>
      <label>Nombre institución<input name="nombre"></label>
      <label>NIT<input name="nit"></label>
      <label>Calidad<input name="calidad"></label>
      <label>Jornada<input name="jornada"></label>
      <label>Contacto<input name="contacto"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Correo<input name="correo"></label>
      <label>Ciudad<input name="ciudad"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO instituciones_e (clase, nombre, nit, calidad, jornada, contacto, cargo, telefono, direccion, correo, ciudad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssssssssss",
        $_POST['clase'],
        $_POST['nombre'],
        $_POST['nit'],
        $_POST['calidad'],
        $_POST['jornada'],
        $_POST['contacto'],
        $_POST['cargo'],
        $_POST['telefono'],
        $_POST['direccion'],
        $_POST['correo'],
        $_POST['ciudad']
      );
      $stmt->execute();
      $stmt->close();
      header("Location: instituciones-e_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
