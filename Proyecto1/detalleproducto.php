<?php $tituloPagina = 'Producto' ?>

<main class="detalle-container">
    <img src="img/productos/<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="detalle-imagen">
    <h2><?php echo ucfirst(htmlspecialchars($producto['nombre'])); ?></h2>
    <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
    <p class="descripcion"><?php echo ucfirst(htmlspecialchars($producto['descripcion'])); ?></p>
    <a href="controller.php?controller=tienda&action=mostrarTienda" class="btn">Volver a la tienda</a>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>
