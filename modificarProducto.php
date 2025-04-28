<?php 
require_once './includes/config.php';
$tituloPagina = 'Admin';
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
?>

<main class="detalle-container">
    <img src="<?php echo RUTA_IMGS . 'productos/' . htmlspecialchars($producto['imagen']); ?>" 
         alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
         class="detalle-imagen">
    <h2><?php echo ucfirst(htmlspecialchars($producto['nombre'])); ?></h2>
    <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>

    <a href="controller.php?controller=admin&action=gestionarProductos" class="btn">Volver</a>
</main>

<?php require RUTA_VISTAS . 'plantillas/plantilla2.php'; ?>
