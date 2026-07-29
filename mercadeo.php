<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html>

<body>

    <h2>Mercadeo</h2>

    <form method="POST">
        <input name="empresa">
        <input name="nombre">
        <input name="cargo">
        <input name="tema">
        <input name="contacto">
        <input name="telefono">
        <input name="correo">
        <input name="direccion">
        <input name="proyecto">
        <input name="patrocinio">
        <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
        $stmt = $conn->prepare("INSERT INTO mercadeo (empresa, nombre, cargo, tema, contacto, telefono, correo, direccion, proyecto, patrocinio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssssss",
            $_POST['empresa'],
            $_POST['nombre'],
            $_POST['cargo'],
            $_POST['tema'],
            $_POST['contacto'],
            $_POST['telefono'],
            $_POST['correo'],
            $_POST['direccion'],
            $_POST['proyecto'],
            $_POST['patrocinio']
        );
        $stmt->execute();
        $stmt->close();
    }
    ?>

</body>

</html>