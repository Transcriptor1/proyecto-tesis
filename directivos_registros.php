<?php
/**
 * Modulo Directivos - Ver registros.
 *
 * Consulta y muestra todos los registros de la tabla `directivos` en una
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
  <title>Directivos - Registros - SIRAD</title>
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

    <div class="page-actions">
      <a href="directivos.php">Registrar</a>
      <a href="directivos_registros.php" class="active">Ver registros</a>
    </div>

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
