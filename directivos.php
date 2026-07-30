<?php require "auth.php"; include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Directivos - SIRAD</title>
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
    <h1>Directivos</h1>

    <div class="page-actions">
      <a href="directivos.php" class="active">Registrar</a>
      <a href="directivos_registros.php">Ver registros</a>
    </div>

    <form class="form-card" method="POST">
      <label>Título<input name="titulo"></label>
      <label>Nombre<input name="nombre"></label>
      <label>Apellido<input name="apellido"></label>
      <label>Cédula<input name="cedula"></label>
      <label>Calidad<input name="calidad"></label>
      <label>Estado<input name="estado"></label>
      <label>Entidad<input name="entidad"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Celular<input name="celular"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <label>Integrante<input name="integrante"></label>
      <label>Vigencia<input name="vigencia"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO directivos (titulo, nombre, apellido, cedula, calidad, estado, entidad, cargo, celular, telefono, correo, integrante, vigencia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssssssssssss",
        $_POST['titulo'],
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['cedula'],
        $_POST['calidad'],
        $_POST['estado'],
        $_POST['entidad'],
        $_POST['cargo'],
        $_POST['celular'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['integrante'],
        $_POST['vigencia']
      );
      $stmt->execute();
      $stmt->close();
      header("Location: directivos_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
