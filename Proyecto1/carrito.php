<?php
session_start();
include './mysql/conexion.php'; 

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar un producto al carrito
if (isset($_GET['add']) && is_numeric($_GET['add'])) {
    $id_producto = $_GET['add'];

    // Verificar si el producto existe en la base de datos
    $stmt = $conn->prepare("SELECT id_producto, nombre, precio, imagen FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();

    if ($producto) {
        // Si el producto ya está en el carrito, aumentar cantidad
        if (isset($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto]['cantidad']++;
        } else {
            // Agregar producto al carrito
            $_SESSION['carrito'][$id_producto] = [
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'imagen' => $producto['imagen'],
                'cantidad' => 1
            ];
        }
    }
    header("Location: carrito.php");
    exit();
}

// Eliminar un producto del carrito
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    $id_producto = $_GET['remove'];
    unset($_SESSION['carrito'][$id_producto]);
    header("Location: carrito.php");
    exit();
}

// Vaciar el carrito
if (isset($_GET['clear'])) {
    unset($_SESSION['carrito']);
    header("Location: carrito.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="CSS/cssCarrito.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="carrito-container">
    <h2>Carrito de Compras</h2>

    <?php if (empty($_SESSION['carrito'])): ?>
        <p>Tu carrito está vacío.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
            <?php $total = 0; ?>
            <?php foreach ($_SESSION['carrito'] as $id => $producto): ?>
                <tr>
                    <td><img src="img/productos/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" class="carrito-img"></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td>$<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                    <td>
                        <a href="carrito.php?remove=<?php echo $id; ?>" class="btn">Eliminar</a>
                    </td>
                </tr>
                <?php $total += $producto['precio'] * $producto['cantidad']; ?>
            <?php endforeach; ?>
        </table>
        <h3>Total: $<?php echo number_format($total, 2); ?></h3>
        <a href="carrito.php?clear=true" class="btn">Vaciar Carrito</a>
        <a href="checkout.php" class="btn">Finalizar Compra</a>
    <?php endif; ?>
</main>

</body>
</html>
