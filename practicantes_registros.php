<?php
/**
 * Modulo Practicantes - Ver registros.
 *
 * Consulta y muestra todos los registros de la tabla `practicantes` en una
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
  <title>Practicantes - Registros - SIRAD</title>
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
    <h1>Practicantes</h1>

    <div class="page-actions">
      <a href="practicantes.php">Registrar</a>
      <a href="practicantes_registros.php" class="active">Ver registros</a>
    </div>

    <div class="table-card">
      <table>
        <tr>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Dirección</th>
          <th>Disciplina</th>
          <th>Generación</th>
          <th>Inicio</th>
          <th>Fin</th>
          <th>Cumpleaños</th>
          <th>Contacto</th>
          <th>Teléfono contacto</th>
        </tr>
        <?php
        $res = $conn->query("SELECT * FROM practicantes");
        while ($r = $res->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($r['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($r['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($r['correo']) . "</td>"
            . "<td>" . htmlspecialchars($r['direccion']) . "</td>"
            . "<td>" . htmlspecialchars($r['disciplina']) . "</td>"
            . "<td>" . htmlspecialchars($r['generacion']) . "</td>"
            . "<td>" . htmlspecialchars($r['inicio']) . "</td>"
            . "<td>" . htmlspecialchars($r['fin']) . "</td>"
            . "<td>" . htmlspecialchars($r['cumple']) . "</td>"
            . "<td>" . htmlspecialchars($r['contacto']) . "</td>"
            . "<td>" . htmlspecialchars($r['telefono_contacto']) . "</td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
