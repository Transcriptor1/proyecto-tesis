<?php
/**
 * Modulo Team - Ver registros.
 *
 * Consulta y muestra todos los registros de la tabla `team_pombo` en una
 * tabla HTML, con la salida escapada (htmlspecialchars). Permite editar
 * o eliminar cada registro individualmente, y exportar un rango de
 * fechas a Excel (exportar.php). Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

if (isset($_POST['eliminar_id'])) {
    $stmt = $conn->prepare("DELETE FROM team_pombo WHERE id = ?");
    $id = (int) $_POST['eliminar_id'];
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: team_registros.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Team - Registros - SIRAD</title>
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
    <h1>Team</h1>

    <div class="page-actions">
      <a href="team.php">Registrar</a>
      <a href="team_registros.php" class="active">Ver registros</a>
    </div>

    <div class="export-bar">
      <form method="GET" action="exportar.php">
        <input type="hidden" name="modulo" value="team">
        <label>Desde<input type="date" name="desde" required></label>
        <label>Hasta<input type="date" name="hasta" required></label>
        <button type="submit">Descargar Excel</button>
      </form>
    </div>

    <div class="table-card">
      <table>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Celular</th>
          <th>Correo</th>
          <th>Cargo</th>
          <th>Cumpleaños</th>
          <th>Contacto de emergencia</th>
          <th>Teléfono</th>
          <th>Fecha inicio</th>
          <th>Fecha fin</th>
          <th>Acciones</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM team_pombo");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['apellido']) . "</td>"
            . "<td>" . htmlspecialchars($f['celular']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "<td>" . htmlspecialchars($f['cargo']) . "</td>"
            . "<td>" . htmlspecialchars($f['cumple']) . "</td>"
            . "<td>" . htmlspecialchars($f['contacto']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['inicio']) . "</td>"
            . "<td>" . htmlspecialchars($f['fin']) . "</td>"
            . "<td>"
            . "<a href=\"team.php?id=" . (int) $f['id'] . "\" class=\"btn-edit\">Editar</a>"
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
