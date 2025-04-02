<?php 
require './includes/config.php';
$tituloPagina = "Carrito";
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
                    <td>
                        <img src="<?php echo RUTA_IMGS . 'productos/' . htmlspecialchars($producto['imagen']); ?>" 
                             alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                             class="carrito-img">
                    </td>
                    <td><?php echo ucfirst(htmlspecialchars($producto['nombre'])); ?></td>
                    <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td>$<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                    <td>
                        <form action="controller.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="number" id="numero_unidades" name="numero_unidades" step="1" min="1" value="<?php echo isset($_GET['numero_unidades']) ? $_GET['numero_unidades'] : ''; ?>" placeholder="Número">
                            <input type="hidden" name="controller" value="carrito">
                            <input type="hidden" name="action" value="eliminarProducto">
                            <button type="submit" class="btn">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php $total += $producto['precio'] * $producto['cantidad']; ?>
            <?php endforeach; ?>
        </table>
        <h3>Total: $<?php echo number_format($total, 2); ?></h3>
        <a href="controller.php?controller=carrito&action=vaciarCarrito" class="btn">Vaciar Carrito</a>
        <a href="<?php echo RUTA_APP . 'checkout.php'; ?>" class="btn">Finalizar Compra</a>
    <?php endif; ?>
</main>

<?php require RUTA_VISTAS . 'plantillas/plantilla2.php'; ?>