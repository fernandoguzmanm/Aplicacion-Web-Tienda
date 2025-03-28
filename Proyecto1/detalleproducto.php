<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($producto['nombre']); ?></title>
    <link rel="stylesheet" href="CSS/cssDetalleProducto.css">
</head>
<body>

<?php include 'includes/vistas/comun/header.php'; ?>

<main class="detalle-container">
    <img src="img/productos/<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="detalle-imagen">
    <h2><?php echo ucfirst(htmlspecialchars($producto['nombre'])); ?></h2>
    <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
    <p class="descripcion"><?php echo ucfirst(htmlspecialchars($producto['descripcion'])); ?></p>
    <a href="tienda.php" class="btn">Volver a la tienda</a>
</main>

</body>
</html>
