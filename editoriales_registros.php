<?php
/**
 * Modulo Editoriales - Ver registros.
 *
 * Consulta y muestra todos los registros de la tabla `editoriales` en una
 * tabla HTML, con la salida escapada (htmlspecialchars). Permite editar
 * o eliminar cada registro individualmente, y exportar un rango de
 * fechas a Excel (exportar.php). Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

if (isset($_POST['eliminar_id'])) {
    $stmt = $conn->prepare("DELETE FROM editoriales WHERE id = ?");
    $id = (int) $_POST['eliminar_id'];
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: editoriales_registros.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Editoriales - Registros - SIRAD</title>
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
    <h1>Editoriales</h1>

    <div class="page-actions">
      <a href="editoriales.php">Registrar</a>
      <a href="editoriales_registros.php" class="active">Ver registros</a>
    </div>

    <div class="export-bar">
      <form method="GET" action="exportar.php">
        <input type="hidden" name="modulo" value="editoriales">
        <label>Desde<input type="date" name="desde" required></label>
        <label>Hasta<input type="date" name="hasta" required></label>
        <button type="submit">Descargar Excel</button>
      </form>
    </div>

    <div class="table-card">
      <table>
        <tr>
          <th>Nombre</th>
          <th>NIT</th>
          <th>Contacto</th>
          <th>Teléfono</th>
          <th>Dirección</th>
          <th>Correo</th>
          <th>Descuento</th>
          <th>Acciones</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM editoriales");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['nit']) . "</td>"
            . "<td>" . htmlspecialchars($f['contacto']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['direccion']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "<td>" . htmlspecialchars($f['descuento']) . "</td>"
            . "<td>"
            . "<a href=\"editoriales.php?id=" . (int) $f['id'] . "\" class=\"btn-edit\">Editar</a>"
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
