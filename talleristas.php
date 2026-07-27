<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html>

<body>

  <h2>Talleristas</h2>

  <form method="POST">
    <input name="nombre">
    <input name="telefono">
    <input name="correo">
    <input name="cargo">
    <input name="perfil">
    <button>Guardar</button>
  </form>

  <?php
  if ($_POST) {
    $conn->query("INSERT INTO talleristas VALUES(
NULL,'$_POST[nombre]','$_POST[telefono]','$_POST[correo]',
'$_POST[cargo]','$_POST[perfil]')");
  }
  ?>

  <table border="1">
    <?php
    $r = $conn->query("SELECT * FROM talleristas");
    while ($f = $r->fetch_assoc()) {
      echo "<tr><td>$f[nombre]</td><td>$f[cargo]</td></tr>";
    }
    ?>
  </table>

</body>

</html>