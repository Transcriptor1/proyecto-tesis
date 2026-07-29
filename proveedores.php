<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Proveedores - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <header>
    <div class="logo">SIRAD</div>
    <a href="index.php">&larr; Volver al directorio</a>
  </header>

  <main>
    <h1>Proveedores</h1>

    <form class="form-card" method="POST">
      <label>País<input name="pais"></label>
      <label>Nombre<input name="nombre"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO proveedores (pais, nombre, direccion, telefono, correo) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssss",
        $_POST['pais'],
        $_POST['nombre'],
        $_POST['direccion'],
        $_POST['telefono'],
        $_POST['correo']
      );
      $stmt->execute();
      $stmt->close();
    }
    ?>

    <div class="table-card">
      <table>
        <tr>
          <th>País</th>
          <th>Nombre</th>
          <th>Dirección</th>
          <th>Teléfono</th>
          <th>Correo</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM proveedores");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['pais']) . "</td>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['direccion']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
