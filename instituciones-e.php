<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html>

<body>

    <h2>Instituciones E</h2>

    <form method="POST">
        <input name="clase" placeholder="Clase institución">
        <input name="nombre" placeholder="Nombre institución">
        <input name="nit" placeholder="NIT">
        <input name="calidad" placeholder="Calidad">
        <input name="jornada" placeholder="Jornada">
        <input name="contacto" placeholder="Contacto">
        <input name="cargo" placeholder="Cargo">
        <input name="telefono" placeholder="Teléfono">
        <input name="direccion" placeholder="Dirección">
        <input name="correo" placeholder="Correo">
        <input name="ciudad" placeholder="Ciudad">
        <button>Guardar</button>
    </form>

    <?php
    if ($_POST) {
        $conn->query("INSERT INTO instituciones_e VALUES(
NULL,'$_POST[clase]','$_POST[nombre]','$_POST[nit]','$_POST[calidad]',
'$_POST[jornada]','$_POST[contacto]','$_POST[cargo]',
'$_POST[telefono]','$_POST[direccion]','$_POST[correo]','$_POST[ciudad]')");
    }
    ?>

    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>NIT</th>
            <th>Ciudad</th>
        </tr>
        <?php
        $r = $conn->query("SELECT * FROM instituciones_e");
        while ($f = $r->fetch_assoc()) {
            echo "<tr><td>$f[nombre]</td><td>$f[nit]</td><td>$f[ciudad]</td></tr>";
        }
        ?>
    </table>

</body>

</html>