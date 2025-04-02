<?php 
$tituloPagina = 'Tienda';

require_once './includes/config.php';
require_once RUTA_INCLUDES . 'formulariounidadescarrito.php';
?>

<main>
    <h2>Nuestros Productos</h2>
    
    <div class="productos-container">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
                    <img src="<?php echo RUTA_IMGS . 'productos/' . (!empty($producto['imagen']) ? $producto['imagen'] : 'default.png'); ?>" 
                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <h3><?php echo ucfirst(htmlspecialchars($producto['nombre'])); ?></h3>
                    <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                    <p class="stock">Stock disponible: <?php echo $producto['stock']; ?></p>
                    
                    <a href="controller.php?controller=detalle&action=mostrarDetalle&id=<?php echo $producto['id_producto']; ?>" class="btn">Ver detalles</a>
                    <?php
                    $form = new formulariounidadescarrito($producto['id_producto']);                   
                    $htmlFormUdsCarrito = $form->gestiona();
                    ?> 
                    <?= $htmlFormUdsCarrito ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles en este momento.</p>
        <?php endif; ?>
    </div>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>