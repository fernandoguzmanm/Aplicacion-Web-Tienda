<body>
    <h2>Resultados de búsqueda</h2>

    <div class="filtro-precio">
        <form action="controller.php" method="get">
            <label for="min_precio">Precio Mínimo:</label>
            <input type="number" id="min_precio" name="min_precio" step="0.01" value="<?php echo isset($_GET['min_precio']) ? $_GET['min_precio'] : ''; ?>" placeholder="Mínimo">
            
            <label for="max_precio">Precio Máximo:</label>
            <input type="number" id="max_precio" name="max_precio" step="0.01" value="<?php echo isset($_GET['max_precio']) ? $_GET['max_precio'] : ''; ?>" placeholder="Máximo">

            <input type="hidden" name="controller" value="busqueda">
            <input type="hidden" name="action" value="mostrarBusqueda">
            <button type="submit">Filtrar</button>
        </form>
    </div>

    <div class="productos-container">
        <?php if (empty($resultados)): ?>
            <p>No se encontraron productos.</p>
        <?php else: ?>
            <?php foreach ($resultados as $producto): ?>
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
        <?php endif; ?>
    </div>
</body>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>