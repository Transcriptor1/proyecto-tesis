<?php require "auth.php"; include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Mercadeo - SIRAD</title>
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
    <h1>Mercadeo</h1>

    <div class="page-actions">
      <a href="mercadeo.php" class="active">Registrar</a>
      <a href="mercadeo_registros.php">Ver registros</a>
    </div>

    <form class="form-card" method="POST">
      <label>Empresa<input name="empresa"></label>
      <label>Nombre<input name="nombre"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Tema<input name="tema"></label>
      <label>Contacto<input name="contacto"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Proyecto<input name="proyecto"></label>
      <label>Patrocinio<input name="patrocinio"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO mercadeo (empresa, nombre, cargo, tema, contacto, telefono, correo, direccion, proyecto, patrocinio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "ssssssssss",
        $_POST['empresa'],
        $_POST['nombre'],
        $_POST['cargo'],
        $_POST['tema'],
        $_POST['contacto'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['direccion'],
        $_POST['proyecto'],
        $_POST['patrocinio']
      );
      $stmt->execute();
      $stmt->close();
      header("Location: mercadeo_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
