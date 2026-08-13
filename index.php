<?php
/**
 * Panel principal de SIRAD.
 *
 * Pagina de entrada del sistema tras iniciar sesion: muestra una
 * tarjeta de acceso por cada uno de los once modulos del directorio.
 * Requiere sesion activa (auth.php).
 */
require "auth.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>SIRAD - Sistema de Registro y Administración de Directorios</title>
    <script src="js/animations.js" defer></script>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            background:
                radial-gradient(circle at 15% 0%, rgba(99, 102, 241, 0.08), transparent 40%),
                radial-gradient(circle at 85% 10%, rgba(37, 99, 235, 0.08), transparent 40%),
                #f4f6fb;
            color: #1f2937;
        }

        header {
            background: linear-gradient(120deg, #1d4ed8, #4338ca, #2563eb);
            background-size: 220% 220%;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 18px rgba(30, 64, 175, 0.28);
        }

        header .logo {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 0.3px;
            display: inline-block;
            transition: transform 0.25s ease;
        }

        header .logo:hover {
            transform: scale(1.05);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 18px;
            font-size: 14px;
        }

        .header-actions a {
            position: relative;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.2s ease;
        }

        .header-actions a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0;
            height: 2px;
            background: white;
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .header-actions a:hover {
            opacity: 0.95;
        }

        .header-actions a:hover::after {
            width: 100%;
        }

        h1 {
            text-align: center;
            margin: 40px 20px 6px;
            font-size: 32px;
        }

        .subtitle {
            text-align: center;
            margin: 0 20px 40px;
            color: #6b7280;
            font-size: 15px;
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
            position: relative;
            overflow: hidden;
            background: white;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2563eb, #6366f1, #ec4899);
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.14);
        }

        .icon {
            font-size: 40px;
            margin-bottom: 15px;
            transition: transform 0.25s ease;
        }

        .card:hover .icon {
            transform: scale(1.15) rotate(-4deg);
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
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card a:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
            🗂️ SIRAD<br>
            <small>Sistema de Registro y Administración de Directorios</small>
        </div>
        <div class="header-actions">
            <span>Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </header>

    <h1>SIRAD</h1>
    <p class="subtitle">Selecciona un módulo para registrar o consultar información institucional</p>

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