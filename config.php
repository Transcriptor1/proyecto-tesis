<?php
/**
 * Configuracion central del sistema.
 *
 * Credenciales de conexion a MySQL y manejo de errores: en vez de
 * mostrar errores de PHP en pantalla, se registran en logs/php-error.log.
 */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'directorio');

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/logs/php-error.log');
