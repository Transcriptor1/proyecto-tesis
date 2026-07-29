<?php require "auth.php"; include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Instituciones Educativas - SIRAD</title>
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
    <h1>Instituciones Educativas</h1>

    <form class="form-card" method="POST">
      <label>Clase institución<input name="clase"></label>
      <label>Nombre institución<input name="nombre"></label>
      <label>NIT<input name="nit"></label>
      <label>Calidad<input name="calidad"></label>
      <label>Jornada<input name="jornada"></label>
      <label>Contacto<input name="contacto"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Dirección<input name="direccion"></label>
      <label>Correo<input name="correo"></label>
      <label>Ciudad<input name="ciudad"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO instituciones_e (clase, nombre, nit, calidad, jornada, contacto, cargo, telefono, direccion, correo, ciudad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssssssssss",
        $_POST['clase'],
        $_POST['nombre'],
        $_POST['nit'],
        $_POST['calidad'],
        $_POST['jornada'],
        $_POST['contacto'],
        $_POST['cargo'],
        $_POST['telefono'],
        $_POST['direccion'],
        $_POST['correo'],
        $_POST['ciudad']
      );
      $stmt->execute();
      $stmt->close();
    }
    ?>

    <div class="table-card">
      <table>
        <tr>
          <th>Clase</th>
          <th>Nombre</th>
          <th>NIT</th>
          <th>Calidad</th>
          <th>Jornada</th>
          <th>Contacto</th>
          <th>Cargo</th>
          <th>Teléfono</th>
          <th>Dirección</th>
          <th>Correo</th>
          <th>Ciudad</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM instituciones_e");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['clase']) . "</td>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['nit']) . "</td>"
            . "<td>" . htmlspecialchars($f['calidad']) . "</td>"
            . "<td>" . htmlspecialchars($f['jornada']) . "</td>"
            . "<td>" . htmlspecialchars($f['contacto']) . "</td>"
            . "<td>" . htmlspecialchars($f['cargo']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['direccion']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "<td>" . htmlspecialchars($f['ciudad']) . "</td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
