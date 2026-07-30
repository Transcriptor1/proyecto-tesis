<?php
/**
 * Modulo Asocajas - Registrar.
 *
 * Formulario de registro para la tabla `asocajas`. Inserta un nuevo
 * registro mediante sentencia preparada (mysqli bind_param) y redirige
 * a asocajas_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Asocajas - SIRAD</title>
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
    <h1>Asocajas</h1>

    <div class="page-actions">
      <a href="asocajas.php" class="active">Registrar</a>
      <a href="asocajas_registros.php">Ver registros</a>
    </div>

    <form class="form-card" method="POST">
      <label>Caja<input name="caja"></label>
      <label>Departamento<input name="departamento"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Contacto<input name="contacto"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Correo<input name="correo"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO asocajas (caja, departamento, cargo, contacto, telefono, direccion, correo) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssssss",
        $_POST['caja'],
        $_POST['departamento'],
        $_POST['cargo'],
        $_POST['contacto'],
        $_POST['telefono'],
        $_POST['direccion'],
        $_POST['correo']
      );
      $stmt->execute();
      $stmt->close();
      header("Location: asocajas_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
