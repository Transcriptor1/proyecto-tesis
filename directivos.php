<?php require "auth.php"; include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Directivos - SIRAD</title>
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
    <h1>Directivos</h1>

    <form class="form-card" method="POST">
      <label>Título<input name="titulo"></label>
      <label>Nombre<input name="nombre"></label>
      <label>Apellido<input name="apellido"></label>
      <label>Cédula<input name="cedula"></label>
      <label>Calidad<input name="calidad"></label>
      <label>Estado<input name="estado"></label>
      <label>Entidad<input name="entidad"></label>
      <label>Cargo<input name="cargo"></label>
      <label>Celular<input name="celular"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <label>Integrante<input name="integrante"></label>
      <label>Vigencia<input name="vigencia"></label>
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

    <div class="table-card">
      <table>
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
    </div>
  </main>

</body>

</html>
