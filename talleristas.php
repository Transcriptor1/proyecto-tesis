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
    $stmt = $conn->prepare("INSERT INTO talleristas (nombre, telefono, correo, cargo, perfil) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param(
      "sssss",
      $_POST['nombre'],
      $_POST['telefono'],
      $_POST['correo'],
      $_POST['cargo'],
      $_POST['perfil']
    );
    $stmt->execute();
    $stmt->close();
  }
  ?>

  <table border="1">
    <?php
    $r = $conn->query("SELECT * FROM talleristas");
    while ($f = $r->fetch_assoc()) {
      echo "<tr><td>" . htmlspecialchars($f['nombre']) . "</td><td>" . htmlspecialchars($f['cargo']) . "</td></tr>";
    }
    ?>
  </table>

</body>

</html>