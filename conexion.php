<?php
$conn = new mysqli("localhost", "root", "", "directorio");
if ($conn->connect_error) {
    die("Error de conexión");
}
$conn->set_charset("utf8mb4");
