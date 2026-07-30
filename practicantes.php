<?php require "auth.php"; include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Practicantes - SIRAD</title>
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
    <h1>Practicantes</h1>

    <div class="page-actions">
      <a href="practicantes.php" class="active">Registrar</a>
      <a href="practicantes_registros.php">Ver registros</a>
    </div>

    <form class="form-card" method="POST">
      <label>Nombre<input name="nombre"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Disciplina<input name="disciplina"></label>
      <label>Generación<input name="generacion"></label>
      <label>Fecha inicio<input name="inicio" type="date"></label>
      <label>Fecha fin<input name="fin" type="date"></label>
      <label>Cumpleaños<input name="cumple" type="date"></label>
      <label>Contacto de emergencia<input name="contacto"></label>
      <label>Teléfono contacto<input name="telefono_contacto"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $inicio = $_POST['inicio'] !== '' ? $_POST['inicio'] : null;
      $fin = $_POST['fin'] !== '' ? $_POST['fin'] : null;
      $cumple = $_POST['cumple'] !== '' ? $_POST['cumple'] : null;
      $stmt = $conn->prepare("INSERT INTO practicantes (nombre, telefono, correo, direccion, disciplina, generacion, inicio, fin, cumple, contacto, telefono_contacto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssssssssss",
        $_POST['nombre'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['direccion'],
        $_POST['disciplina'],
        $_POST['generacion'],
        $inicio,
        $fin,
        $cumple,
        $_POST['contacto'],
        $_POST['telefono_contacto']
      );
      $stmt->execute();
      $stmt->close();
      header("Location: practicantes_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
