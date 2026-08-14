<?php
/**
 * Proteccion CSRF.
 *
 * Genera un token por sesion. csrf_field() lo imprime como input
 * oculto en un formulario; csrf_verify() lo valida al procesar un
 * POST y corta la ejecucion si no coincide. Requiere sesion iniciada.
 */

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): void
{
    echo '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrf_token()) . '">';
}

function csrf_verify(): void
{
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(403);
        exit('Token de seguridad inválido. Recarga la página e intenta de nuevo.');
    }
}
