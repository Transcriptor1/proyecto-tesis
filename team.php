<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Team - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <header>
    <div class="logo">SIRAD</div>
    <a href="index.php">&larr; Volver al directorio</a>
  </header>

  <main>
    <h1>Team</h1>

    <form class="form-card" method="POST">
      <label>Nombre<input name="nombre"></label>
      <label>Apellido<input name="apellido"></label>
      <label>Celular<input name="celular"></label>
      <label>Correo<input name="correo"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Cumpleaños<input name="cumple" type="date"></label>
      <label>Contacto de emergencia<input name="contacto"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Fecha inicio<input name="inicio" type="date"></label>
      <label>Fecha fin<input name="fin" type="date"></label>
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

    <div class="table-card">
      <table>
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
    </div>
  </main>

</body>

</html>
