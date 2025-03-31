<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$carrito_count = isset($_SESSION['carrito']) ? array_sum(array_column($_SESSION['carrito'], 'cantidad')) : 0;
$base_url = "/AW/Proyecto1/";
//require_once 'C:\xampp\htdocs\AW\Proyecto1\includes\usuario.php';//cambiar
//var_dump($usuario);
?>



<!DOCTYPE html>
<html lang="es">

<body>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?=$base_url ?>css/cssHeader.css?v=6">
</head>

<header>
    <h1> <?php echo ucfirst($tituloPagina); ?> </h1>
    <div class="header-container">
        <nav>
            <ul>
                <li><a href="<?=$base_url ?>index.php">Inicio</a></li>
                <li><a href="controller.php?controller=tienda&action=mostrarTienda">Tienda</a></li>
                <li><a href="controller.php?controller=detalles&action=mostrarDetalles">Detalles</a></li>
                <li><a href="controller.php?controller=bocetos&action=mostrarBocetos">Bocetos</a></li>
                <li><a href="controller.php?controller=miembros&action=mostrarMiembros">Miembros</a></li>
                <li><a href="controller.php?controller=planificacion&action=mostrarPlanificacion">Planificacion</a></li>
            </ul>
        </nav>

        <div class="busqueda-container">
            <form action="controller.php" method="GET" class="busqueda-form">
                <input type="product-name" name="query" placeholder="Buscar productos">
                <select name="categorias">
                    <option value="">Todas las categorías</option>
                    <option value="cereales">Cereales</option>
                    <option value="fruta">Fruta</option>
                    <option value="lacteo">Lacteos</option>
                    <option value="dulce">Dulces</option>
                    <option value="refresco">Refrescos</option>
                </select>
                <input type="hidden" name="controller" value="busqueda">
                <input type="hidden" name="action" value="mostrarBusqueda">
                <button type="submit-product">Buscar</button>
            </form>
        </div>
        <p><a href="logout.php">Cerrar sesión</a></p>
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
