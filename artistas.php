<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html>

<body>

  <h2>Artistas</h2>

  <form method="POST">
    <input name="nombre" placeholder="Nombre">
    <input name="perfil" placeholder="Perfil">
    <input name="organizacion" placeholder="Organización">
    <input name="agenda" placeholder="Agenda">
    <input name="telefono" placeholder="Teléfono">
    <input name="correo" placeholder="Correo">
    <input name="filbo" placeholder="Filbo">
    <button>Guardar</button>
  </form>

  <?php
  if ($_POST) {
    $conn->query("INSERT INTO artistas VALUES(
NULL,'$_POST[nombre]','$_POST[perfil]','$_POST[organizacion]',
'$_POST[agenda]','$_POST[telefono]','$_POST[correo]','$_POST[filbo]')");
  }
  ?>

  <table border="1">
    <tr>
      <th>Nombre</th>
      <th>Organización</th>
    </tr>
    <?php
    $r = $conn->query("SELECT * FROM artistas");
    while ($f = $r->fetch_assoc()) {
      echo "<tr><td>$f[nombre]</td><td>$f[organizacion]</td></tr>";
    }
    ?>
  </table>

</body>

</html>