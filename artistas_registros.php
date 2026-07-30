<?php require "auth.php"; include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Artistas - Registros - SIRAD</title>
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

    <div class="page-actions">
      <a href="artistas.php">Registrar</a>
      <a href="artistas_registros.php" class="active">Ver registros</a>
    </div>

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
