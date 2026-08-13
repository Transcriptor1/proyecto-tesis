<?php
/**
 * Modulo Team - Registrar.
 *
 * Formulario de registro para la tabla `team_pombo`. Inserta un nuevo
 * registro mediante sentencia preparada (mysqli bind_param) y redirige
 * a team_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Team - SIRAD</title>
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
    <h1>Team</h1>

    <div class="page-actions">
      <a href="team.php" class="active">Registrar</a>
      <a href="team_registros.php">Ver registros</a>
    </div>

    <form class="form-card" method="POST">
      <label>Nombre<input name="nombre"></label>
      <label>Apellido<input name="apellido"></label>
      <label>Celular<input name="celular"></label>
      <label>Correo<input name="correo"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Cumpleaños<input name="cumple" type="date"></label>
      <label>Contacto de emergencia<input name="contacto"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Fecha inicio<input name="inicio" type="date"></label>
      <label>Fecha fin<input name="fin" type="date"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $cumple = $_POST['cumple'] !== '' ? $_POST['cumple'] : null;
      $inicio = $_POST['inicio'] !== '' ? $_POST['inicio'] : null;
      $fin = $_POST['fin'] !== '' ? $_POST['fin'] : null;
      $stmt = $conn->prepare("INSERT INTO team_pombo (nombre, apellido, celular, correo, cargo, cumple, contacto, telefono, inicio, fin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "ssssssssss",
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['celular'],
        $_POST['correo'],
        $_POST['cargo'],
        $cumple,
        $_POST['contacto'],
        $_POST['telefono'],
        $inicio,
        $fin
      );
      $stmt->execute();
      $stmt->close();
      header("Location: team_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
