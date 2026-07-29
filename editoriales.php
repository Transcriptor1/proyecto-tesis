<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Editoriales - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <header>
    <div class="logo">SIRAD</div>
    <a href="index.php">&larr; Volver al directorio</a>
  </header>

  <main>
    <h1>Editoriales</h1>

    <form class="form-card" method="POST">
      <label>Nombre<input name="nombre"></label>
      <label>NIT<input name="nit"></label>
      <label>Contacto<input name="contacto"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Correo<input name="correo"></label>
      <label>Descuento<input name="descuento"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO editoriales (nombre, nit, contacto, telefono, direccion, correo, descuento) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssssss",
        $_POST['nombre'],
        $_POST['nit'],
        $_POST['contacto'],
        $_POST['telefono'],
        $_POST['direccion'],
        $_POST['correo'],
        $_POST['descuento']
      );
      $stmt->execute();
      $stmt->close();
    }
    ?>

    <div class="table-card">
      <table>
        <tr>
          <th>Nombre</th>
          <th>NIT</th>
          <th>Contacto</th>
          <th>Teléfono</th>
          <th>Dirección</th>
          <th>Correo</th>
          <th>Descuento</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM editoriales");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['nit']) . "</td>"
            . "<td>" . htmlspecialchars($f['contacto']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['direccion']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "<td>" . htmlspecialchars($f['descuento']) . "</td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
