<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html>

<body>

  <h2>Editoriales</h2>

  <form method="POST">
    <input name="nombre">
    <input name="nit">
    <input name="contacto">
    <input name="telefono">
    <input name="direccion">
    <input name="correo">
    <input name="descuento">
    <button>Guardar</button>
  </form>

  <?php
  if ($_POST) {
    $stmt = $conn->prepare("INSERT INTO editoriales (nombre, nit, contacto, telefono, direccion, correo, descuento) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
      "sssssss",
      $_POST['nombre'],
      $_POST['nit'],
      $_POST['contacto'],
      $_POST['telefono'],
      $_POST['direccion'],
      $_POST['correo'],
      $_POST['descuento']
    );
    $stmt->execute();
    $stmt->close();
  }
  ?>

</body>

</html>