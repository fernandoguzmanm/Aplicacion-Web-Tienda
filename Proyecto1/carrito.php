<?php $tituloPagina = "Carrito";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

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
                    <td><?php echo ucfirst($producto['nombre']); ?></td>
                    <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td>$<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                    <td>
                        <a href="controller.php?controller=carrito&action=eliminarProducto&id=<?php echo $id; ?>" class="btn">Eliminar</a>
                    </td>
                </tr>
                <?php $total += $producto['precio'] * $producto['cantidad']; ?>
            <?php endforeach; ?>
        </table>
        <h3>Total: $<?php echo number_format($total, 2); ?></h3>
        <a href="controller.php?controller=carrito&action=vaciarCarrito" class="btn">Vaciar Carrito</a>
        <a href="checkout.php" class="btn">Finalizar Compra</a>
    <?php endif; ?>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>

