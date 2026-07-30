<?php
/**
 * Modulo Proveedores - Ver registros.
 *
 * Consulta y muestra todos los registros de la tabla `proveedores` en una
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
  <title>Proveedores - Registros - SIRAD</title>
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
    <h1>Proveedores</h1>

    <div class="page-actions">
      <a href="proveedores.php">Registrar</a>
      <a href="proveedores_registros.php" class="active">Ver registros</a>
    </div>

    <div class="table-card">
      <table>
        <tr>
          <th>País</th>
          <th>Nombre</th>
          <th>Dirección</th>
          <th>Teléfono</th>
          <th>Correo</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM proveedores");
        while ($f = $r->fetch_assoc()) {
          echo "<tr>"
            . "<td>" . htmlspecialchars($f['pais']) . "</td>"
            . "<td>" . htmlspecialchars($f['nombre']) . "</td>"
            . "<td>" . htmlspecialchars($f['direccion']) . "</td>"
            . "<td>" . htmlspecialchars($f['telefono']) . "</td>"
            . "<td>" . htmlspecialchars($f['correo']) . "</td>"
            . "</tr>";
        }
        ?>
      </table>
    </div>
  </main>

</body>

</html>
