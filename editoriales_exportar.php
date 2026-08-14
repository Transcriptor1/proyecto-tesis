<?php
/**
 * Modulo Editoriales - Descargar Excel.
 *
 * Formulario para elegir un rango de fechas y descargar en Excel los
 * registros de la tabla `editoriales` cuya fecha_registro este en ese
 * rango. El archivo lo genera exportar.php. Requiere sesion activa
 * (auth.php).
 */
require "auth.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Editoriales - Descargar Excel - SIRAD</title>
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
      <a href="editoriales_registros.php">Ver registros</a>
      <a href="editoriales_exportar.php" class="active">Descargar Excel</a>
    </div>

    <div class="export-bar">
      <form method="GET" action="exportar.php">
        <input type="hidden" name="modulo" value="editoriales">
        <label>Desde<input type="date" name="desde" required></label>
        <label>Hasta<input type="date" name="hasta" required></label>
        <button type="submit">Descargar Excel</button>
      </form>
    </div>
  </main>

</body>

</html>
