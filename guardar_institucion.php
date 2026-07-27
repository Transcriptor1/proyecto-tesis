<?php
include "conexion.php";

$sql = "INSERT INTO instituciones_e
(clase, nombre, nit, calidad, jornada, contacto, cargo, telefono, direccion, correo, ciudad)
VALUES (
'{$_POST['clase']}',
'{$_POST['nombre']}',
'{$_POST['nit']}',
'{$_POST['calidad']}',
'{$_POST['jornada']}',
'{$_POST['contacto']}',
'{$_POST['cargo']}',
'{$_POST['telefono']}',
'{$_POST['direccion']}',
'{$_POST['correo']}',
'{$_POST['ciudad']}'
)";

$conn->query($sql);

header("Location: instituciones-e.php");
