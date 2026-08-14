<?php
/**
 * Modulo Practicantes - Ver registros.
 *
 * Consulta y muestra todos los registros de la tabla `practicantes` en una
 * tabla HTML, con la salida escapada (htmlspecialchars). Permite editar
 * o eliminar cada registro individualmente, y exportar un rango de
 * fechas a Excel (exportar.php). Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

if (isset($_POST['eliminar_id'])) {
    $stmt = $conn->prepare("DELETE FROM practicantes WHERE id = ?");
    $id = (int) $_POST['eliminar_id'];
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: practicantes_registros.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Practicantes - Registros - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/animations.js" defer></script>
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
      <a href="practicantes_exportar.php">Descargar Excel</a>
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
          <th>Fecha inicio</th>
          <th>Fecha fin</th>
          <th>Cumpleaños</th>
          <th>Contacto de emergencia</th>
          <th>Teléfono contacto</th>
          <th>Acciones</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM practicantes");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "<td>" . htmlspecialchars($f['direccion']) . "</td>"
            . "<td>" . htmlspecialchars($f['disciplina']) . "</td>"
            . "<td>" . htmlspecialchars($f['generacion']) . "</td>"
            . "<td>" . htmlspecialchars($f['inicio']) . "</td>"
            . "<td>" . htmlspecialchars($f['fin']) . "</td>"
            . "<td>" . htmlspecialchars($f['cumple']) . "</td>"
            . "<td>" . htmlspecialchars($f['contacto']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono_contacto']) . "</td>"
            . "<td>"
            . "<a href=\"practicantes.php?id=" . (int) $f['id'] . "\" class=\"btn-edit\">Editar</a>"
            . "<form method=\"POST\" style=\"display:inline\" onsubmit=\"return confirm('&iquest;Eliminar este registro?');\">"
            . "<input type=\"hidden\" name=\"eliminar_id\" value=\"" . (int) $f['id'] . "\">"
            . "<button type=\"submit\" class=\"btn-delete\">Borrar</button>"
            . "</form></td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
