<?php
include './mysql/conexion.php'; 

// Obtener productos de la base de datos
$result = $conn->query("SELECT id_producto, nombre, precio, imagen, descripcion, stock FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda</title>
    <link rel="stylesheet" href="./css/cssHeader.css">
    <link rel="stylesheet" href="./css/cssTienda.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <h2>Nuestros Productos</h2>
    
    <div class="productos-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="producto">
                    <img src="img/productos/<?php echo !empty($row['imagen']) ? $row['imagen'] : 'default.png'; ?>" 
                         alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                    <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                    <p class="precio">$<?php echo number_format($row['precio'], 2); ?></p>
                    
                    <a href="detalleproducto.php?id=<?php echo $row['id_producto']; ?>" class="btn">Ver detalles</a>
                    <a href="carrito.php?add=<?php echo $row['id_producto']; ?>" class="btn">Añadir al carrito</a>  
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay productos disponibles en este momento.</p>
        <?php endif; ?>
    </div>
</main>

</body>
</html>
