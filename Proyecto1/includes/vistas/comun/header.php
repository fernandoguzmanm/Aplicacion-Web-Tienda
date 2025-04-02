<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$carrito_count = isset($_SESSION['carrito']) ? array_sum(array_column($_SESSION['carrito'], 'cantidad')) : 0;
?>

<!DOCTYPE html>
<html lang="es">

<body>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= URL_CSS . 'cssHeader.css?v=6' ?>">
</head>

<header>
    <h1> <?= ucfirst($tituloPagina); ?> </h1>
    <div class="header-container">
        <nav>
            <ul>
                <li><a href="<?= RUTA_APP . 'index.php' ?>">Inicio</a></li>
                <li><a href="<?= RUTA_APP . 'controller.php?controller=tienda&action=mostrarTienda' ?>">Tienda</a></li>
                <li><a href="<?= RUTA_APP . 'controller.php?controller=detalles&action=mostrarDetalles' ?>">Detalles</a></li>
                <li><a href="<?= RUTA_APP . 'controller.php?controller=bocetos&action=mostrarBocetos' ?>">Bocetos</a></li>
                <li><a href="<?= RUTA_APP . 'controller.php?controller=miembros&action=mostrarMiembros' ?>">Miembros</a></li>
                <li><a href="<?= RUTA_APP . 'controller.php?controller=planificacion&action=mostrarPlanificacion' ?>">Planificación</a></li>
            </ul>
        </nav>

        <div class="right-section">
            <div id="login-container">
                <?php if (isset($_SESSION['login'])) : ?>
                    <p>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']); ?></p>
                    <p><a href="<?= RUTA_APP . 'includes/controladores/logoutlogica.php' ?>">Cerrar sesión</a></p>
                <?php else : ?>
                    <p><a href="<?= RUTA_APP . 'login.php' ?>">Iniciar sesión</a></p>
                <?php endif; ?>
            </div>
            
            <div id="carrito-container">
            <?php if (isset($_SESSION['login']) && $_SESSION['rol'] === 'vendedor'): ?>
                <a href="<?= RUTA_APP . 'controller.php?controller=vendedor&action=mostrarVendedor' ?>" class="carrito-btn">Vendedor</a>
            <?php else : ?>
                <a href="<?= RUTA_APP . 'carrito.php' ?>" class="carrito-btn">
                    🛒 Carrito <?php if ($carrito_count > 0) echo "($carrito_count)"; ?>
                </a>
            <?php endif;?>
            </div>
        </div>
    </div>
</header>