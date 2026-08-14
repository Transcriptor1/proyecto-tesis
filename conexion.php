<?php
/**
 * Conexion a la base de datos.
 *
 * Abre la conexion mysqli a la base de datos `directorio` (credenciales
 * en config.php) y fija el charset utf8mb4 para evitar problemas de
 * codificacion con tildes y enies. Incluido por todos los modulos y por
 * las paginas de autenticacion.
 */
require_once __DIR__ . "/config.php";
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Error de conexión");
}
$conn->set_charset("utf8mb4");
