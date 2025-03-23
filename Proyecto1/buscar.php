<?php
require 'includes/mysql/conexion.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$categoria = isset($_GET['categorias']) ? $_GET['categorias'] : '';

$sql = "SELECT * FROM productos WHERE nombre LIKE ?";

$params = ["%$query%"];

if (!empty($categoria)) {
    $sql .= " AND categorias = ?";
    $params[] = $categoria;
}

$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat("s", count($params)), ...$params);
$stmt->execute();
$result = $stmt->get_result();
$resultados = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de búsqueda</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h2>Resultados de búsqueda</h2>
    <ul>
        <?php if (empty($resultados)): ?>
            <p>No se encontraron productos.</p>
        <?php else: ?>
            <?php foreach ($resultados as $producto): ?>
                <div class="producto">
                <img src="img/productos/<?php echo !empty($producto['imagen']) ? $producto['imagen'] : 'default.png'; ?>" 
                alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>

                <a href="detalleproducto.php?id=<?php echo $producto['id_producto']; ?>" class="btn">Ver detalles</a>
                <a href="carrito.php?add=<?php echo $producto['id_producto']; ?>" class="btn">Añadir al carrito</a>  
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>
</html>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>