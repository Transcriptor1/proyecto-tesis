<?php
/**
 * Conexion a la base de datos.
 *
 * Abre la conexion mysqli a la base de datos `directorio` y fija el
 * charset utf8mb4 para evitar problemas de codificacion con tildes y
 * enies. Incluido por todos los modulos y por las paginas de
 * autenticacion.
 */
$conn = new mysqli("localhost", "root", "", "directorio");
if ($conn->connect_error) {
    die("Error de conexión");
}
$conn->set_charset("utf8mb4");
