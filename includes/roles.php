<?php
/**
 * Control de acceso por rol.
 *
 * is_admin() indica si el usuario en sesion tiene rol administrador.
 * require_admin() corta la ejecucion con 403 si no lo es. Requiere que
 * auth.php ya haya iniciado la sesion.
 */

function is_admin(): bool
{
    return ($_SESSION['usuario_rol'] ?? '') === 'admin';
}

function require_admin(): void
{
    if (is_admin()) {
        return;
    }
    http_response_code(403);
    ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Acceso denegado - SIRAD</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <div class="auth-page">
    <div class="form-card auth-card">
      <h1>Acceso denegado</h1>
      <p class="auth-subtitle">Esta acción requiere permisos de administrador.</p>
      <p class="auth-link"><a href="index.php">&larr; Volver al directorio</a></p>
    </div>
  </div>
</body>

</html>
    <?php
    exit;
}
