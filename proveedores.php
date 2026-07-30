<?php
/**
 * Modulo Proveedores - Registrar.
 *
 * Formulario de registro para la tabla `proveedores`. Inserta un nuevo
 * registro mediante sentencia preparada (mysqli bind_param) y redirige
 * a proveedores_registros.php tras guardar. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Proveedores - SIRAD</title>
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
    <h1>Proveedores</h1>

    <div class="page-actions">
      <a href="proveedores.php" class="active">Registrar</a>
      <a href="proveedores_registros.php">Ver registros</a>
    </div>

    <form class="form-card" method="POST">
      <label>País<input name="pais"></label>
      <label>Nombre<input name="nombre"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO proveedores (pais, nombre, direccion, telefono, correo) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssss",
        $_POST['pais'],
        $_POST['nombre'],
        $_POST['direccion'],
        $_POST['telefono'],
        $_POST['correo']
      );
      $stmt->execute();
      $stmt->close();
      header("Location: proveedores_registros.php");
      exit;
    }
    ?>
  </main>

</body>

</html>
