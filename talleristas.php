<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Talleristas - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <header>
    <div class="logo">SIRAD</div>
    <a href="index.php">&larr; Volver al directorio</a>
  </header>

  <main>
    <h1>Talleristas</h1>

    <form class="form-card" method="POST">
      <label>Nombre<input name="nombre"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Perfil<input name="perfil"></label>
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

    <div class="table-card">
      <table>
        <tr>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Cargo</th>
          <th>Perfil</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM talleristas");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "<td>" . htmlspecialchars($f['cargo']) . "</td>"
            . "<td>" . htmlspecialchars($f['perfil']) . "</td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
