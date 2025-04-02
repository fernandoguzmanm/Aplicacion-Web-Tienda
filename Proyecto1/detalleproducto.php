<?php 
require_once './includes/config.php';

$tituloPagina = 'Producto';
?>

<main class="detalle-container">
    <img src="<?php echo RUTA_IMGS . 'productos/' . htmlspecialchars($producto['imagen']); ?>" 
         alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
         class="detalle-imagen">
    <h2><?php echo ucfirst(htmlspecialchars($producto['nombre'])); ?></h2>
    <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
    <p class="descripcion"><?php echo ucfirst(htmlspecialchars($producto['descripcion'])); ?></p>
    <a href="controller.php?controller=tienda&action=mostrarTienda" class="btn">Volver a la tienda</a>
</main>

<?php require RUTA_VISTAS . 'plantillas/plantilla2.php'; ?>