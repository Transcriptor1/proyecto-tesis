<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Mercadeo - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <header>
    <div class="logo">SIRAD</div>
    <a href="index.php">&larr; Volver al directorio</a>
  </header>

  <main>
    <h1>Mercadeo</h1>

    <form class="form-card" method="POST">
      <label>Empresa<input name="empresa"></label>
      <label>Nombre<input name="nombre"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Tema<input name="tema"></label>
      <label>Contacto<input name="contacto"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Proyecto<input name="proyecto"></label>
      <label>Patrocinio<input name="patrocinio"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO mercadeo (empresa, nombre, cargo, tema, contacto, telefono, correo, direccion, proyecto, patrocinio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "ssssssssss",
        $_POST['empresa'],
        $_POST['nombre'],
        $_POST['cargo'],
        $_POST['tema'],
        $_POST['contacto'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['direccion'],
        $_POST['proyecto'],
        $_POST['patrocinio']
      );
      $stmt->execute();
      $stmt->close();
    }
    ?>

    <div class="table-card">
      <table>
        <tr>
          <th>Empresa</th>
          <th>Nombre</th>
          <th>Cargo</th>
          <th>Tema</th>
          <th>Contacto</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Dirección</th>
          <th>Proyecto</th>
          <th>Patrocinio</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM mercadeo");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['empresa']) . "</td>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['cargo']) . "</td>"
            . "<td>" . htmlspecialchars($f['tema']) . "</td>"
            . "<td>" . htmlspecialchars($f['contacto']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "<td>" . htmlspecialchars($f['direccion']) . "</td>"
            . "<td>" . htmlspecialchars($f['proyecto']) . "</td>"
            . "<td>" . htmlspecialchars($f['patrocinio']) . "</td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
