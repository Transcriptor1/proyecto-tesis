<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html>

<body>

  <h2>Medios</h2>

  <form method="POST">
    <input name="categoria">
    <input name="medio">
    <input name="fuente">
    <input name="nombre">
    <input name="correo">
    <input name="telefono">
    <input name="telefono2">
    <input name="direccion">
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
  }
  ?>

</body>

</html>