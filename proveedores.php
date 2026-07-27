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
    $conn->query("INSERT INTO proveedores VALUES(
NULL,'$_POST[pais]','$_POST[nombre]',
'$_POST[direccion]','$_POST[telefono]','$_POST[correo]')");
  }
  ?>

</body>

</html>