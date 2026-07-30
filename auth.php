<?php
/**
 * Guard de autenticacion.
 *
 * Inicia la sesion PHP y, si no existe una sesion activa
 * ($_SESSION['usuario_id']), redirige a login.php. Se incluye al
 * inicio de index.php y de los once modulos del directorio para
 * proteger el acceso.
 */
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
