<?php
session_start();
include 'mysql/conexion.php';

// Obtener el ID del producto desde la URL
$id = $_GET['id'] ?? null;

// Redirigir a tienda si no hay ID válido
if (!$id || !is_numeric($id)) {
    header("Location: tienda.php");
    exit();
}

// Obtener detalles del producto
$stmt = $conn->prepare("SELECT nombre, precio, imagen, descripcion FROM productos WHERE id_producto = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

// Si no existe el producto, redirigir a tienda
if (!$producto) {
    header("Location: tienda.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($producto['nombre']); ?></title>
    <link rel="stylesheet" href="CSS/cssDetalleProducto.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="detalle-container">
    <img src="img/productos/<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="detalle-imagen">
    <h2><?php echo htmlspecialchars($producto['nombre']); ?></h2>
    <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
    <p class="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
    <a href="tienda.php" class="btn">Volver a la tienda</a>
</main>

</body>
</html>
