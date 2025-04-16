<?php 
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'formulariounidadescarrito.php';
$tituloPagina = 'Producto';
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
    <p class="descripcion"><?php echo ucfirst(htmlspecialchars($producto['descripcion'])); ?></p>

    <?php if (!(isset($_SESSION['rol']) && $_SESSION['rol'] == 'vendedor')):?> 
	<?php
	$form = new formulariounidadescarrito($producto['id_producto']);
	$htmlFormUdsCarrito = $form->gestiona();
	?>
	<?= $htmlFormUdsCarrito ?>
    <?php endif; ?>
    <a href="controller.php?controller=tienda&action=mostrarTienda" class="btn">Volver a la tienda</a>
</main>

<?php require RUTA_VISTAS . 'plantillas/plantilla2.php'; ?>
