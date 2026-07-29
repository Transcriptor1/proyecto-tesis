<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html>

<body>

  <h2>Asocajas</h2>

  <form method="POST">
    <input name="caja">
    <input name="departamento">
    <input name="cargo">
    <input name="contacto">
    <input name="telefono">
    <input name="direccion">
    <input name="correo">
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
  }
  ?>

</body>

</html>