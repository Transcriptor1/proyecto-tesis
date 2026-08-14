<?php
/**
 * Elementos de layout compartidos por los modulos.
 *
 * render_header() imprime la barra superior (logo, saludo, insignia de
 * rol, volver al directorio, cerrar sesion), identica antes en las 33
 * paginas. render_page_actions() imprime las pestanas
 * Registrar/Ver registros/Descargar Excel, ocultando la ultima si el
 * usuario en sesion no es administrador.
 */
require_once __DIR__ . '/roles.php';

function render_header(bool $mostrarVolver = true): void
{
    $rolLabel = is_admin() ? 'Administrador' : 'Usuario';
    ?>
  <header>
    <div class="logo">SIRAD</div>
    <div class="header-actions">
      <span>Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?> <span class="badge"><?= $rolLabel ?></span></span>
      <a href="buscar.php">Buscar</a>
      <a href="importar.php">Importar</a>
      <?php if ($mostrarVolver): ?>
      <a href="index.php">&larr; Volver al directorio</a>
      <?php endif; ?>
      <a href="logout.php">Cerrar sesión</a>
    </div>
  </header>
    <?php
}

function render_page_actions(string $archivo, string $activo): void
{
    $tabs = [
        'registrar' => ["$archivo.php", 'Registrar'],
        'registros' => ["{$archivo}_registros.php", 'Ver registros'],
    ];
    if (is_admin()) {
        $tabs['exportar'] = ["{$archivo}_exportar.php", 'Descargar Excel'];
    }
    echo '<div class="page-actions">';
    foreach ($tabs as $clave => $tab) {
        [$href, $label] = $tab;
        $clase = $clave === $activo ? ' class="active"' : '';
        echo '<a href="' . htmlspecialchars($href) . '"' . $clase . '>' . htmlspecialchars($label) . '</a>';
    }
    echo '</div>';
}
