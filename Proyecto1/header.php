<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/cssHeader.css?v=2">
</head>
<body>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$page_title = basename($_SERVER['PHP_SELF'], ".php");

// Contar productos en el carrito
$carrito_count = isset($_SESSION['carrito']) ? array_sum(array_column($_SESSION['carrito'], 'cantidad')) : 0;

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
        
        <div class="right-section">
            <div id="login-container">
                <?php if (isset($_SESSION['usuario'])) : ?>
                    <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
                    <p><a href="logout.php">Cerrar sesión</a></p>
                <?php else : ?>
                    <p><a href="login.php">Iniciar sesión</a></p>
                <?php endif; ?>
            </div>

            <div id="carrito-container">
                <a href="carrito.php" class="carrito-btn">
                    🛒 Carrito <?php if ($carrito_count > 0) echo "($carrito_count)"; ?>
                </a>
            </div>
        </div>
    </div>
</header>
