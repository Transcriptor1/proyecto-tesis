<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Asocajas - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <header>
    <div class="logo">SIRAD</div>
    <a href="index.php">&larr; Volver al directorio</a>
  </header>

  <main>
    <h1>Asocajas</h1>

    <form class="form-card" method="POST">
      <label>Caja<input name="caja"></label>
      <label>Departamento<input name="departamento"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Contacto<input name="contacto"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Correo<input name="correo"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO asocajas (caja, departamento, cargo, contacto, telefono, direccion, correo) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssssss",
        $_POST['caja'],
        $_POST['departamento'],
        $_POST['cargo'],
        $_POST['contacto'],
        $_POST['telefono'],
        $_POST['direccion'],
        $_POST['correo']
      );
      $stmt->execute();
      $stmt->close();
    }
    ?>

    <div class="table-card">
      <table>
        <tr>
          <th>Caja</th>
          <th>Departamento</th>
          <th>Cargo</th>
          <th>Contacto</th>
          <th>Teléfono</th>
          <th>Dirección</th>
          <th>Correo</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM asocajas");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['caja']) . "</td>"
            . "<td>" . htmlspecialchars($f['departamento']) . "</td>"
            . "<td>" . htmlspecialchars($f['cargo']) . "</td>"
            . "<td>" . htmlspecialchars($f['contacto']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['direccion']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
