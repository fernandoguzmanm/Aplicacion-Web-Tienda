<?php $tituloPagina = 'Tienda' ?>

<main>
    <h2>Nuestros Productos</h2>
    
    <div class="productos-container">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
                    <img src="img/productos/<?php echo !empty($producto['imagen']) ? $producto['imagen'] : 'default.png'; ?>" 
                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <h3><?php echo ucfirst(htmlspecialchars($producto['nombre'])); ?></h3>
                    <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                    
                    <a href="controller.php?controller=detalle&action=mostrarDetalle&id=<?php echo $producto['id_producto']; ?>" class="btn">Ver detalles</a>

                    <form action="controller.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $producto['id_producto']; ?>">
                        <input type="number" id="numero_unidades" name="numero_unidades" step="1" min="1" value="<?php echo isset($_GET['numero_unidades']) ? $_GET['numero_unidades'] : ''; ?>" placeholder="Número">
                        <input type="hidden" name="controller" value="carrito">
                        <input type="hidden" name="action" value="añadirProducto">
                        <button type="submit" class="btn">Añadir al carrito</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles en este momento.</p>
        <?php endif; ?>
    </div>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>