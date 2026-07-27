<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html>

<body>

  <h2>Directivos</h2>

  <form method="POST">
    <input name="titulo">
    <input name="nombre">
    <input name="apellido">
    <input name="cedula">
    <input name="calidad">
    <input name="estado">
    <input name="entidad">
    <input name="cargo">
    <input name="celular">
    <input name="telefono">
    <input name="correo">
    <input name="integrante">
    <input name="vigencia">
    <button>Guardar</button>
  </form>

  <?php
  if ($_POST) {
    $conn->query("INSERT INTO directivos VALUES(
NULL,'$_POST[titulo]','$_POST[nombre]','$_POST[apellido]',
'$_POST[cedula]','$_POST[calidad]','$_POST[estado]',
'$_POST[entidad]','$_POST[cargo]','$_POST[celular]',
'$_POST[telefono]','$_POST[correo]',
'$_POST[integrante]','$_POST[vigencia]')");
  }
  ?>

</body>

</html>