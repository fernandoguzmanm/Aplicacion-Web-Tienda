<?php 
$tituloPagina = 'Búsqueda';
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'formulariobuscar.php';
?>

<body>
    <h2>Resultados de búsqueda</h2>
    <?php
        $form = new formulariobuscar();
        $htmlFormBuscar = $form->gestiona();
        ?>
        <?= $htmlFormBuscar ?>
    </div>

    <div class="productos-container">
        <?php if (empty($resultados)): ?>
            <p>No se encontraron productos.</p>
        <?php else: ?>
            <?php foreach ($resultados as $producto): ?>
                <div class="producto">
                    <img src="<?php echo RUTA_IMGS . 'productos/' . (!empty($producto->getImagen()) ? $producto->getImagen() : 'default.png'); ?>" 
                         alt="<?php echo htmlspecialchars($producto->getNombre()); ?>">
                    <h3><?php echo ucfirst(htmlspecialchars($producto->getNombre())); ?></h3>
                    <p class="precio">$<?php echo number_format($producto->getPrecio(), 2); ?></p>
                    <a href="controller.php?controller=detalle&action=mostrarDetalle&id=<?php echo $producto->getIdProducto(); ?>" class="btn">Ver detalles</a>
                    <a href="<?php echo RUTA_APP . 'carrito.php?add=' . $producto->getIdProducto(); ?>" class="btn">Añadir al carrito</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

<?php require RUTA_VISTAS . 'plantillas/plantilla2.php'; ?>