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

                    <a href="carrito.php?add=<?php echo $producto['id_producto']; ?>" class="btn">Añadir al carrito</a>  
                    <a href="controller.php?controller=add&action=añadirProducto&add=<?php echo $producto['id_producto']; ?>" class="btn">Añadir al carrito2</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles en este momento.</p>
        <?php endif; ?>
    </div>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>