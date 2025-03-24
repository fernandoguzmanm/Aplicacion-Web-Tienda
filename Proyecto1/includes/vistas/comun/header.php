<!DOCTYPE html>
<html lang="es">

<body>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$page_title = basename($_SERVER['PHP_SELF'], ".php");

// Contar productos en el carrito
$carrito_count = isset($_SESSION['carrito']) ? array_sum(array_column($_SESSION['carrito'], 'cantidad')) : 0;
$base_url = "/AW/Proyecto1/";
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?=$base_url ?>css/cssHeader.css?v=6">
</head>

<header>
    <h1> <?php echo ucfirst($page_title); ?> </h1>
    <div class="header-container">
        <nav>
            <ul>
                <li><a href="<?=$base_url ?>index.php">Inicio</a></li>
                <li><a href="<?=$base_url ?>tienda.php">Tienda</a></li>
                <li><a href="<?=$base_url ?>detalles.php">Detalles</a></li>
                <li><a href="<?=$base_url ?>bocetos.php">Bocetos</a></li>
                <li><a href="<?=$base_url ?>miembros.php">Miembros</a></li>
                <li><a href="<?=$base_url ?>planificacion.php">Planificación</a></li>
            </ul>
        </nav>

        <form action="buscar.php" method="GET" class="busqueda-form">
            <input type="text" name="query" placeholder="Buscar productos">
            <select name="categorias">
                <option value="">Todas las categorías</option>
                <option value="cereales">Cereales</option>
                <option value="fruta">Fruta</option>
            </select>
            <button type="submit">Buscar</button>
        </form>
        
        <div class="right-section">
            <div id="login-container">
                <?php if (isset($_SESSION['usuario'])) : ?>
                    <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
                    <p><a href="includes/clases/usuario/logout.php">Cerrar sesión</a></p>
                <?php else : ?>
                    <p><a href="includes/clases/usuario/login.php">Iniciar sesión</a></p>
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
