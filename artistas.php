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
    $stmt = $conn->prepare("INSERT INTO artistas (nombre, perfil, organizacion, agenda, telefono, correo, filbo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
      "sssssss",
      $_POST['nombre'],
      $_POST['perfil'],
      $_POST['organizacion'],
      $_POST['agenda'],
      $_POST['telefono'],
      $_POST['correo'],
      $_POST['filbo']
    );
    $stmt->execute();
    $stmt->close();
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
      echo "<tr><td>" . htmlspecialchars($f['nombre']) . "</td><td>" . htmlspecialchars($f['organizacion']) . "</td></tr>";
    }
    ?>
  </table>

</body>

</html>