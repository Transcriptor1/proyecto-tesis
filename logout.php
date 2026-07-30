<?php
/**
 * Cierre de sesion.
 *
 * Destruye la sesion activa (session_destroy()) y redirige a
 * login.php.
 */
session_start();
session_destroy();
header("Location: login.php");
exit;
