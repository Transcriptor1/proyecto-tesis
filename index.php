<?php require "auth.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>SIRAD - Sistema de Registro y Administración de Directorios</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            background-color: #f4f6fb;
            color: #1f2937;
        }

        header {
            background-color: #2563eb;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 18px;
            font-weight: bold;
        }

        header nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 18px;
            font-size: 14px;
        }

        h1 {
            text-align: center;
            margin: 40px 20px;
            font-size: 32px;
        }

        .container {
            max-width: 1300px;
            margin: auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .card h3 {
            margin: 10px 0;
            font-size: 22px;
        }

        .card p {
            font-size: 15px;
            color: #6b7280;
            margin-bottom: 25px;
        }

        .card a {
            display: block;
            padding: 14px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            text-decoration: none;
        }

        .blue {
            background: #3b82f6;
        }

        .green {
            background: #10b981;
        }

        .orange {
            background: #f59e0b;
        }

        .red {
            background: #ef4444;
        }

        .purple {
            background: #6366f1;
        }

        .pink {
            background: #ec4899;
        }

        .gray {
            background: #64748b;
        }

        .blue:hover {
            background: #2563eb;
        }

        .green:hover {
            background: #059669;
        }

        .orange:hover {
            background: #d97706;
        }

        .red:hover {
            background: #dc2626;
        }

        .purple:hover {
            background: #4f46e5;
        }

        .pink:hover {
            background: #db2777;
        }

        .gray:hover {
            background: #475569;
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            SIRAD<br>
            <small>Sistema de Registro y Administración de Directorios</small>
        </div>
        <nav>
            <a href="instituciones-e.php">Instituciones</a>
            <a href="practicantes.php">Practicantes</a>
            <a href="artistas.php">Artistas</a>
            <a href="team.php">Team</a>
        </nav>
        <div class="header-actions">
            <span>Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </header>

    <h1>SIRAD</h1>

    <div class="container">

        <div class="card">
            <div class="icon">🏫</div>
            <h3>Instituciones Educativas</h3>
            <p>Universidades, colegios y jardines vinculados</p>
            <a href="instituciones-e.php" class="blue">Ingresar</a>
        </div>

        <div class="card">
            <div class="icon">🎓</div>
            <h3>Practicantes</h3>
            <p>Estudiantes en práctica académica</p>
            <a href="practicantes.php" class="green">Ingresar</a>
        </div>

        <div class="card">
            <div class="icon">🎨</div>
            <h3>Artistas</h3>
            <p>Ilustradores, escritores y creadores</p>
            <a href="artistas.php" class="orange">Ingresar</a>
        </div>

        <div class="card">
            <div class="icon">🧑‍🏫</div>
            <h3>Talleristas</h3>
            <p>Facilitadores y formadores</p>
            <a href="talleristas.php" class="purple">Ingresar</a>
        </div>

        <div class="card">
            <div class="icon">📚</div>
            <h3>Editoriales</h3>
            <p>Editoriales aliadas</p>
            <a href="editoriales.php" class="pink">Ingresar</a>
        </div>

        <div class="card">
            <div class="icon">🤝</div>
            <h3>Asocajas</h3>
            <p>Cajas de compensación</p>
            <a href="asocajas.php" class="gray">Ingresar</a>
        </div>

        <div class="card">
            <div class="icon">📢</div>
            <h3>Mercadeo</h3>
            <p>Empresas y patrocinios</p>
            <a href="mercadeo.php" class="blue">Ingresar</a>
        </div>

        <div class="card">
            <div class="icon">🚚</div>
            <h3>Proveedores</h3>
            <p>Proveedores nacionales e internacionales</p>
            <a href="proveedores.php" class="green">Ingresar</a>
        </div>

        <div class="card">
            <div class="icon">📰</div>
            <h3>Medios</h3>
            <p>Prensa, radio y medios digitales</p>
            <a href="medios.php" class="orange">Ingresar</a>
        </div>

        <div class="card">
            <div class="icon">👥</div>
            <h3>Team</h3>
            <p>Equipo interno de la fundación</p>
            <a href="team.php" class="purple">Ingresar</a>
        </div>

        <div class="card">
            <div class="icon">🏛️</div>
            <h3>Directivos</h3>
            <p>Miembros directivos y vigencias</p>
            <a href="directivos.php" class="red">Ingresar</a>
        </div>

    </div>

</body>

</html>