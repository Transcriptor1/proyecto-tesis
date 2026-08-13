<?php
/**
 * Modulo Asocajas - Ver registros.
 *
 * Consulta y muestra todos los registros de la tabla `asocajas` en una
 * tabla HTML, con la salida escapada (htmlspecialchars). Requiere
 * sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

if (isset($_POST['eliminar_id'])) {
    $stmt = $conn->prepare("DELETE FROM asocajas WHERE id = ?");
    $id = (int) $_POST['eliminar_id'];
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: asocajas_registros.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Asocajas - Registros - SIRAD</title>
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
    <h1>Asocajas</h1>

    <div class="page-actions">
      <a href="asocajas.php">Registrar</a>
      <a href="asocajas_registros.php" class="active">Ver registros</a>
    </div>

    <div class="table-card">
      <table>
        <tr>
          <th>Caja</th>
          <th>Departamento</th>
          <th>Cargo</th>
          <th>Contacto</th>
          <th>Teléfono</th>
          <th>Dirección</th>
          <th>Correo</th>
          <th>Acciones</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM asocajas");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['caja']) . "</td>"
            . "<td>" . htmlspecialchars($f['departamento']) . "</td>"
            . "<td>" . htmlspecialchars($f['cargo']) . "</td>"
            . "<td>" . htmlspecialchars($f['contacto']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['direccion']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "<td><form method=\"POST\" onsubmit=\"return confirm('¿Eliminar este registro?');\">"
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
