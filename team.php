<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Team</title>
</head>

<body>

  <h2>Team</h2>

  <form method="POST">
    <input name="nombre" placeholder="Nombre">
    <input name="apellido" placeholder="Apellido">
    <input name="celular" placeholder="Celular">
    <input name="correo" placeholder="Correo">
    <input name="cargo" placeholder="Cargo">
    <input name="cumple" type="date" placeholder="Cumpleaños">
    <input name="contacto" placeholder="Contacto de emergencia">
    <input name="telefono" placeholder="Teléfono">
    <input name="inicio" type="date" placeholder="Fecha inicio">
    <input name="fin" type="date" placeholder="Fecha fin">
    <button>Guardar</button>
  </form>

  <?php
  if ($_POST) {
    $cumple = $_POST['cumple'] !== '' ? $_POST['cumple'] : null;
    $inicio = $_POST['inicio'] !== '' ? $_POST['inicio'] : null;
    $fin = $_POST['fin'] !== '' ? $_POST['fin'] : null;
    $stmt = $conn->prepare("INSERT INTO team_pombo (nombre, apellido, celular, correo, cargo, cumple, contacto, telefono, inicio, fin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
      "ssssssssss",
      $_POST['nombre'],
      $_POST['apellido'],
      $_POST['celular'],
      $_POST['correo'],
      $_POST['cargo'],
      $cumple,
      $_POST['contacto'],
      $_POST['telefono'],
      $inicio,
      $fin
    );
    $stmt->execute();
    $stmt->close();
  }
  ?>

  <table border="1">
    <tr>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Celular</th>
      <th>Correo</th>
      <th>Cargo</th>
      <th>Cumpleaños</th>
      <th>Contacto</th>
      <th>Teléfono</th>
      <th>Inicio</th>
      <th>Fin</th>
    </tr>
    <?php
    $r = $conn->query("SELECT * FROM team_pombo");
    while ($f = $r->fetch_assoc()) {
      echo "<tr>"
        . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
        . "<td>" . htmlspecialchars($f['apellido']) . "</td>"
        . "<td>" . htmlspecialchars($f['celular']) . "</td>"
        . "<td>" . htmlspecialchars($f['correo']) . "</td>"
        . "<td>" . htmlspecialchars($f['cargo']) . "</td>"
        . "<td>" . htmlspecialchars($f['cumple']) . "</td>"
        . "<td>" . htmlspecialchars($f['contacto']) . "</td>"
        . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
        . "<td>" . htmlspecialchars($f['inicio']) . "</td>"
        . "<td>" . htmlspecialchars($f['fin']) . "</td>"
        . "</tr>";
    }
    ?>
  </table>

</body>

</html>
