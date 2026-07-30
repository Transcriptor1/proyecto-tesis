<?php
/**
 * Modulo Talleristas - Ver registros.
 *
 * Consulta y muestra todos los registros de la tabla `talleristas` en una
 * tabla HTML, con la salida escapada (htmlspecialchars). Requiere
 * sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Talleristas - Registros - SIRAD</title>
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
    <h1>Talleristas</h1>

    <div class="page-actions">
      <a href="talleristas.php">Registrar</a>
      <a href="talleristas_registros.php" class="active">Ver registros</a>
    </div>

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
