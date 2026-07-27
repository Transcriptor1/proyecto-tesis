<?php
$conn = new mysqli("localhost", "root", "", "directorio");
if ($conn->connect_error) {
    die("Error de conexión");
}
