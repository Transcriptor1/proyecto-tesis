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
    $conn->query("INSERT INTO medios VALUES(
NULL,'$_POST[categoria]','$_POST[medio]','$_POST[fuente]',
'$_POST[nombre]','$_POST[correo]','$_POST[telefono]',
'$_POST[telefono2]','$_POST[direccion]')");
  }
  ?>

</body>

</html>