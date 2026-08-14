<?php
/**
 * Exportacion de registros a Excel por rango de fechas.
 *
 * Genera un archivo .xls (tabla HTML interpretada por Excel) con los
 * registros de un modulo cuya fecha_registro esta entre "desde" y
 * "hasta" (parametros GET), validando el modulo contra una lista blanca
 * para evitar acceso a tablas arbitrarias. Requiere sesion activa (auth.php).
 */
require "auth.php";
include "conexion.php";

$modulos = [
    'artistas' => ['tabla' => 'artistas', 'columnas' => ['nombre' => 'Nombre', 'perfil' => 'Perfil', 'organizacion' => 'Organización', 'agenda' => 'Agenda', 'telefono' => 'Teléfono', 'correo' => 'Correo', 'filbo' => 'Filbo']],
    'asocajas' => ['tabla' => 'asocajas', 'columnas' => ['caja' => 'Caja', 'departamento' => 'Departamento', 'cargo' => 'Cargo', 'contacto' => 'Contacto', 'telefono' => 'Teléfono', 'direccion' => 'Dirección', 'correo' => 'Correo']],
    'directivos' => ['tabla' => 'directivos', 'columnas' => ['titulo' => 'Título', 'nombre' => 'Nombre', 'apellido' => 'Apellido', 'cedula' => 'Cédula', 'calidad' => 'Calidad', 'estado' => 'Estado', 'entidad' => 'Entidad', 'cargo' => 'Cargo', 'celular' => 'Celular', 'telefono' => 'Teléfono', 'correo' => 'Correo', 'integrante' => 'Integrante', 'vigencia' => 'Vigencia']],
    'editoriales' => ['tabla' => 'editoriales', 'columnas' => ['nombre' => 'Nombre', 'nit' => 'NIT', 'contacto' => 'Contacto', 'telefono' => 'Teléfono', 'direccion' => 'Dirección', 'correo' => 'Correo', 'descuento' => 'Descuento']],
    'instituciones-e' => ['tabla' => 'instituciones_e', 'columnas' => ['clase' => 'Clase', 'nombre' => 'Nombre', 'nit' => 'NIT', 'calidad' => 'Calidad', 'jornada' => 'Jornada', 'contacto' => 'Contacto', 'cargo' => 'Cargo', 'telefono' => 'Teléfono', 'direccion' => 'Dirección', 'correo' => 'Correo', 'ciudad' => 'Ciudad']],
    'medios' => ['tabla' => 'medios', 'columnas' => ['categoria' => 'Categoría', 'medio' => 'Medio', 'fuente' => 'Fuente', 'nombre' => 'Nombre', 'correo' => 'Correo', 'telefono' => 'Teléfono', 'telefono2' => 'Teléfono 2', 'direccion' => 'Dirección']],
    'mercadeo' => ['tabla' => 'mercadeo', 'columnas' => ['empresa' => 'Empresa', 'nombre' => 'Nombre', 'cargo' => 'Cargo', 'tema' => 'Tema', 'contacto' => 'Contacto', 'telefono' => 'Teléfono', 'correo' => 'Correo', 'direccion' => 'Dirección', 'proyecto' => 'Proyecto', 'patrocinio' => 'Patrocinio']],
    'practicantes' => ['tabla' => 'practicantes', 'columnas' => ['nombre' => 'Nombre', 'telefono' => 'Teléfono', 'correo' => 'Correo', 'direccion' => 'Dirección', 'disciplina' => 'Disciplina', 'generacion' => 'Generación', 'inicio' => 'Fecha inicio', 'fin' => 'Fecha fin', 'cumple' => 'Cumpleaños', 'contacto' => 'Contacto de emergencia', 'telefono_contacto' => 'Teléfono contacto']],
    'proveedores' => ['tabla' => 'proveedores', 'columnas' => ['pais' => 'País', 'nombre' => 'Nombre', 'direccion' => 'Dirección', 'telefono' => 'Teléfono', 'correo' => 'Correo']],
    'talleristas' => ['tabla' => 'talleristas', 'columnas' => ['nombre' => 'Nombre', 'telefono' => 'Teléfono', 'correo' => 'Correo', 'cargo' => 'Cargo', 'perfil' => 'Perfil']],
    'team' => ['tabla' => 'team_pombo', 'columnas' => ['nombre' => 'Nombre', 'apellido' => 'Apellido', 'celular' => 'Celular', 'correo' => 'Correo', 'cargo' => 'Cargo', 'cumple' => 'Cumpleaños', 'contacto' => 'Contacto de emergencia', 'telefono' => 'Teléfono', 'inicio' => 'Fecha inicio', 'fin' => 'Fecha fin']],
];

$modulo = $_GET['modulo'] ?? '';
if (!isset($modulos[$modulo])) {
    http_response_code(400);
    exit('Módulo no válido.');
}

$desde = $_GET['desde'] ?? '';
$hasta = $_GET['hasta'] ?? '';
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $desde) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $hasta)) {
    http_response_code(400);
    exit('Rango de fechas no válido.');
}

$tabla = $modulos[$modulo]['tabla'];
$columnas = $modulos[$modulo]['columnas'];

$stmt = $conn->prepare("SELECT * FROM `$tabla` WHERE fecha_registro >= ? AND fecha_registro < DATE_ADD(?, INTERVAL 1 DAY) ORDER BY fecha_registro");
$stmt->bind_param("ss", $desde, $hasta);
$stmt->execute();
$resultado = $stmt->get_result();

$nombreArchivo = $modulo . '_' . $desde . '_a_' . $hasta . '.xls';

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$nombreArchivo\"");

echo "\xEF\xBB\xBF";
echo "<table border='1'>";
echo "<tr>";
foreach ($columnas as $etiqueta) {
    echo "<th>" . htmlspecialchars($etiqueta) . "</th>";
}
echo "</tr>";

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>";
    foreach (array_keys($columnas) as $campo) {
        echo "<td>" . htmlspecialchars($fila[$campo] ?? '') . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

$stmt->close();
