<?php 
$tituloPagina = 'Productos';

require_once './includes/config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<main>
    <h2>Gestión de Productos</h2>

    <div class="productos-container">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
			<img src="<?php echo RUTA_IMGS . 'productos/' . (!empty($producto->getImagen()) ? $producto->getImagen() : 'default.png'); ?>" 
                         alt="<?php echo htmlspecialchars($producto->getNombre()); ?>">
                    <h3><?php echo ucfirst(htmlspecialchars($producto->getNombre())); ?></h3>
                    
                    <a href="controller.php?controller=admin&action=eliminarProducto&id=<?php echo $producto->getIdProducto(); ?>" class="btn">Eliminar Producto</a>
                    <a href="controller.php?controller=admin&action=modificarProducto&id=<?php echo $producto->getIdProducto(); ?>" class="btn">Modificar Producto</a>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles en este momento.</p>
        <?php endif; ?>
    </div>
    <a href="<?= RUTA_APP . 'crearProducto.php' ?>" class="btn">Crear Producto</a>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>
