<?php
/**
 * Respaldo de la base de datos (solo linea de comandos).
 *
 * Genera un dump de estructura y datos de la base `directorio` en
 * db/backups/backup_<fecha>.sql. No se expone por HTTP: si se accede
 * desde un navegador, corta la ejecucion con 403.
 *
 * Uso: php db/backup.php
 */
if (php_sapi_name() !== 'cli') {
    http_response_code(403);
    exit('Este script solo puede ejecutarse desde la línea de comandos.');
}

require_once __DIR__ . '/../config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    fwrite(STDERR, "Error de conexión: {$conn->connect_error}\n");
    exit(1);
}
$conn->set_charset('utf8mb4');

$carpeta = __DIR__ . '/backups';
if (!is_dir($carpeta)) {
    mkdir($carpeta, 0777, true);
}
$archivo = $carpeta . '/backup_' . date('Y-m-d_His') . '.sql';
$salida = fopen($archivo, 'w');

fwrite($salida, "-- Respaldo de la base de datos \"" . DB_NAME . "\" generado el " . date('Y-m-d H:i:s') . "\n");
fwrite($salida, "SET NAMES utf8mb4;\n\n");

$tablas = [];
$resultado = $conn->query('SHOW TABLES');
while ($fila = $resultado->fetch_row()) {
    $tablas[] = $fila[0];
}

foreach ($tablas as $tabla) {
    fwrite($salida, "DROP TABLE IF EXISTS `$tabla`;\n");
    $crear = $conn->query("SHOW CREATE TABLE `$tabla`")->fetch_row()[1];
    fwrite($salida, $crear . ";\n\n");

    $datos = $conn->query("SELECT * FROM `$tabla`");
    while ($registro = $datos->fetch_assoc()) {
        $columnas = array_map(fn($c) => "`$c`", array_keys($registro));
        $valores = array_map(function ($v) use ($conn) {
            return $v === null ? 'NULL' : "'" . $conn->real_escape_string($v) . "'";
        }, array_values($registro));
        fwrite($salida, "INSERT INTO `$tabla` (" . implode(',', $columnas) . ") VALUES (" . implode(',', $valores) . ");\n");
    }
    fwrite($salida, "\n");
}

fclose($salida);
$conn->close();

echo "Respaldo generado en: $archivo\n";
