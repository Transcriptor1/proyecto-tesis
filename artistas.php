<?php require "auth.php"; include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Artistas - SIRAD</title>
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
    <h1>Artistas</h1>

    <form class="form-card" method="POST">
      <label>Nombre<input name="nombre"></label>
      <label>Perfil<input name="perfil"></label>
      <label>Organización<input name="organizacion"></label>
      <label>Agenda<input name="agenda"></label>
      <label>Teléfono<input name="telefono"></label>
      <label>Correo<input name="correo"></label>
      <label>Filbo<input name="filbo"></label>
      <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
      $stmt = $conn->prepare("INSERT INTO artistas (nombre, perfil, organizacion, agenda, telefono, correo, filbo) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param(
        "sssssss",
        $_POST['nombre'],
        $_POST['perfil'],
        $_POST['organizacion'],
        $_POST['agenda'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['filbo']
      );
      $stmt->execute();
      $stmt->close();
    }
    ?>

    <div class="table-card">
      <table>
        <tr>
          <th>Nombre</th>
          <th>Perfil</th>
          <th>Organización</th>
          <th>Agenda</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Filbo</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM artistas");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['perfil']) . "</td>"
            . "<td>" . htmlspecialchars($f['organizacion']) . "</td>"
            . "<td>" . htmlspecialchars($f['agenda']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "<td>" . htmlspecialchars($f['filbo']) . "</td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
