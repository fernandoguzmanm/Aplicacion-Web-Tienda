<?php 
$tituloPagina = 'Búsqueda';
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'formulariobuscar.php';
require_once RUTA_INCLUDES . 'formulariounidadescarrito.php';
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
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
		    <?php if (!(isset($_SESSION['rol']) && $_SESSION['rol'] == 'vendedor')): ?>
		    <?php
		    $form = new formulariounidadescarrito($producto->getIdProducto());
		    $htmlFormUdsCarrito = $form->gestiona();
		    ?>
		    <?= $htmlFormUdsCarrito ?>
		    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

<?php require RUTA_VISTAS . 'plantillas/plantilla2.php'; ?>
