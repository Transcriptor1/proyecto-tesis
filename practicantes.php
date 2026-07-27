<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Practicantes</title>
  <style>
    body {
      font-family: Arial;
      font-size: 18px
    }

    form {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 15px
    }

    input,
    button {
      padding: 10px;
      font-size: 16px
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px
    }

    th {
      background: #eee
    }
  </style>
</head>

<body>

  <h1>Practicantes</h1>

  <form method="POST">
    <input name="nombre" placeholder="Nombre">
    <input name="telefono" placeholder="Teléfono">
    <input name="correo" placeholder="Correo">
    <input name="direccion" placeholder="Dirección">
    <input name="disciplina" placeholder="Disciplina">
    <input name="generacion" placeholder="Generación">
    <input name="inicio" type="date">
    <input name="fin" type="date">
    <input name="cumple" type="date">
    <input name="contacto" placeholder="Contacto">
    <input name="telefono_contacto" placeholder="Teléfono contacto">
    <button>Guardar</button>
  </form>

  <?php
  if ($_POST) {
    $conn->query("
    INSERT INTO practicantes VALUES (
      NULL,
      '{$_POST['nombre']}',
      '{$_POST['telefono']}',
      '{$_POST['correo']}',
      '{$_POST['direccion']}',
      '{$_POST['disciplina']}',
      '{$_POST['generacion']}',
      '{$_POST['inicio']}',
      '{$_POST['fin']}',
      '{$_POST['cumple']}',
      '{$_POST['contacto']}',
      '{$_POST['telefono_contacto']}'
    )
  ");
  }
  ?>

  <table>
    <tr>
      <th>Nombre</th>
      <th>Teléfono</th>
      <th>Correo</th>
      <th>Disciplina</th>
    </tr>

    <?php
    $res = $conn->query("SELECT * FROM practicantes");
    while ($r = $res->fetch_assoc()) {
      echo "<tr>
    <td>{$r['nombre']}</td>
    <td>{$r['telefono']}</td>
    <td>{$r['correo']}</td>
    <td>{$r['disciplina']}</td>
  </tr>";
    }
    ?>
  </table>

</body>

</html>