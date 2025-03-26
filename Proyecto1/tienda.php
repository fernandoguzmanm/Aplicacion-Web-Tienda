<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda</title>
    <link rel="stylesheet" href="./css/cssTienda.css?v=2">
    <link rel="stylesheet" href="./css/estilo.css?v=2">
</head>
<body>

<?php include 'includes/vistas/comun/header.php'; ?>


<main>
    <h2>Nuestros Productos</h2>
    
    <div class="productos-container">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
                    <img src="img/productos/<?php echo !empty($producto['imagen']) ? $producto['imagen'] : 'default.png'; ?>" 
                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                    <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                    
                    <a href="detalleproducto.php?id=<?php echo $producto['id_producto']; ?>" class="btn">Ver detalles</a>
                    <a href="controller.php?controller=detalle&action=mostrarDetalle&id=<?php echo $producto['id_producto']; ?>" class="btn">Ver detalles2</a>

                    <a href="carrito.php?add=<?php echo $producto['id_producto']; ?>" class="btn">Añadir al carrito</a>  
                    <a href="controller.php?controller=add&action=añadirProducto&add=<?php echo $producto['id_producto']; ?>" class="btn">Añadir al carrito2</a>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles en este momento.</p>
        <?php endif; ?>
    </div>
</main>

</body>
</html>

</body>
</html>