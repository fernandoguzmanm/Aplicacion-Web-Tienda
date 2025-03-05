<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/cssHeader.css">
</head>
<body>

<?php
session_start(); // Iniciar sesión para detectar si el usuario ha iniciado sesión
$page_title = basename($_SERVER['PHP_SELF'], ".php");
?>

<header>
    <div class="header-container">
        <h1> <?php echo ucfirst($page_title); ?> </h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="tienda.php">Tienda</a></li>
                <li><a href="detalles.php">Detalles</a></li>
                <li><a href="bocetos.php">Bocetos</a></li>
                <li><a href="miembros.php">Miembros</a></li>
                <li><a href="planificacion.php">Planificación</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>

        <div id="login-container">
            <?php
            if (isset($_SESSION['usuario'])) {
                //var_dump($_SESSION);
                echo "<p>Bienvenido, " . $_SESSION['nombre'];
                echo "<p><a href='logout.php'>Cerrar sesión</a></p>";
            } else {
                echo "<p><a href='login.php'>Iniciar sesión</a></p>";
            }
            ?>
        </div>
    </div>
</header>