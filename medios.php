<?php require "auth.php"; include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Medios - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <header>
    <div class="logo">SIRAD</div>
    <div class="header-actions">
      <span>Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
      <a href="index.php">&larr; Volver al directorio</a>
      <a href="logout.php">Cerrar sesión</a>
    </div>
  </header>

  <main>
    <h1>Medios</h1>

    <form class="form-card" method="POST">
      <label>Categoría<input name="categoria"></label>
      <label>Medio<input name="medio"></label>
      <label>Fuente<input name="fuente"></label>
      <label>Nombre<input name="nombre"></label>
      <label>Correo<input name="correo"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Teléfono 2<input name="telefono2"></label>
      <label>Dirección<input name="direccion"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO medios (categoria, medio, fuente, nombre, correo, telefono, telefono2, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "ssssssss",
        $_POST['categoria'],
        $_POST['medio'],
        $_POST['fuente'],
        $_POST['nombre'],
        $_POST['correo'],
        $_POST['telefono'],
        $_POST['telefono2'],
        $_POST['direccion']
      );
      $stmt->execute();
      $stmt->close();
    }
    ?>

    <div class="table-card">
      <table>
        <tr>
          <th>Categoría</th>
          <th>Medio</th>
          <th>Fuente</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Teléfono 2</th>
          <th>Dirección</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM medios");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['categoria']) . "</td>"
            . "<td>" . htmlspecialchars($f['medio']) . "</td>"
            . "<td>" . htmlspecialchars($f['fuente']) . "</td>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono2']) . "</td>"
            . "<td>" . htmlspecialchars($f['direccion']) . "</td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
