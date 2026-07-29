<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Directivos</title>
</head>

<body>

  <h2>Directivos</h2>

  <form method="POST">
    <input name="titulo" placeholder="Título">
    <input name="nombre" placeholder="Nombre">
    <input name="apellido" placeholder="Apellido">
    <input name="cedula" placeholder="Cédula">
    <input name="calidad" placeholder="Calidad">
    <input name="estado" placeholder="Estado">
    <input name="entidad" placeholder="Entidad">
    <input name="cargo" placeholder="Cargo">
    <input name="celular" placeholder="Celular">
    <input name="telefono" placeholder="Teléfono">
    <input name="correo" placeholder="Correo">
    <input name="integrante" placeholder="Integrante">
    <input name="vigencia" placeholder="Vigencia">
    <button>Guardar</button>
  </form>

  <?php
  if ($_POST) {
    $stmt = $conn->prepare("INSERT INTO directivos (titulo, nombre, apellido, cedula, calidad, estado, entidad, cargo, celular, telefono, correo, integrante, vigencia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
      "sssssssssssss",
      $_POST['titulo'],
      $_POST['nombre'],
      $_POST['apellido'],
      $_POST['cedula'],
      $_POST['calidad'],
      $_POST['estado'],
      $_POST['entidad'],
      $_POST['cargo'],
      $_POST['celular'],
      $_POST['telefono'],
      $_POST['correo'],
      $_POST['integrante'],
      $_POST['vigencia']
    );
    $stmt->execute();
    $stmt->close();
  }
  ?>

  <table border="1">
    <tr>
      <th>Título</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Cédula</th>
      <th>Calidad</th>
      <th>Estado</th>
      <th>Entidad</th>
      <th>Cargo</th>
      <th>Celular</th>
      <th>Teléfono</th>
      <th>Correo</th>
      <th>Integrante</th>
      <th>Vigencia</th>
    </tr>
    <?php
    $r = $conn->query("SELECT * FROM directivos");
    while ($f = $r->fetch_assoc()) {
      echo "<tr>"
        . "<td>" . htmlspecialchars($f['titulo']) . "</td>"
        . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
        . "<td>" . htmlspecialchars($f['apellido']) . "</td>"
        . "<td>" . htmlspecialchars($f['cedula']) . "</td>"
        . "<td>" . htmlspecialchars($f['calidad']) . "</td>"
        . "<td>" . htmlspecialchars($f['estado']) . "</td>"
        . "<td>" . htmlspecialchars($f['entidad']) . "</td>"
        . "<td>" . htmlspecialchars($f['cargo']) . "</td>"
        . "<td>" . htmlspecialchars($f['celular']) . "</td>"
        . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
        . "<td>" . htmlspecialchars($f['correo']) . "</td>"
        . "<td>" . htmlspecialchars($f['integrante']) . "</td>"
        . "<td>" . htmlspecialchars($f['vigencia']) . "</td>"
        . "</tr>";
    }
    ?>
  </table>

</body>

</html>
