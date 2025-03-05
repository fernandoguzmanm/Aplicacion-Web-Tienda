<?php
include './mysql/conexion.php'; 

// Obtener productos de la base de datos
$result = $conn->query("SELECT id_producto, nombre, precio, imagen, descripcion, stock FROM productos");

//INSERT INTO `productos`(`id_producto`, `nombre`, `precio`, `imagen`, `descripcion`, `stock`, `id_vendedor`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]');
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda</title>
    <link rel="stylesheet" href="CSS/cssTienda.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <h2>Nuestros Productos</h2>
    <div class="productos-container">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="producto">
                <img src="img/productos/<?php echo $row['imagen']; ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                <p class="precio">$<?php echo number_format($row['precio'], 2); ?></p>
                <a href="detalle_producto.php?id=<?php echo $row['id_producto']; ?>" class="btn">Ver detalles</a>
                <a href="detalle_producto.php?id=<?php echo $row['id_producto']; ?>" class="btn">Añadir al carrito</a>  
            </div>
        <?php endwhile; ?>
    </div>
</main>

</body>
</html>