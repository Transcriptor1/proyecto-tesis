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
    $conn->query("INSERT INTO asocajas VALUES(
NULL,'$_POST[caja]','$_POST[departamento]','$_POST[cargo]',
'$_POST[contacto]','$_POST[telefono]','$_POST[direccion]','$_POST[correo]')");
  }
  ?>

</body>

</html>