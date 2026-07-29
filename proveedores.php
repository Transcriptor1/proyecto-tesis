<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html>

<body>

  <h2>Proveedores</h2>

  <form method="POST">
    <input name="pais">
    <input name="nombre">
    <input name="direccion">
    <input name="telefono">
    <input name="correo">
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
  }
  ?>

</body>

</html>