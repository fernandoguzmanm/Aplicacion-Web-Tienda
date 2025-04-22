<?php 
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'controladores/mispedidosController.php';

$tituloPagina = "Mis Pedidos";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true): ?>
    <main class="carrito-container">
        <h2>Acceso Denegado</h2>
        <p>Debes iniciar sesión para acceder a tus pedidos.</p>
        <a href="login.php" class="btn">Iniciar Sesión</a>
    </main>
<?php else:
    $id_usuario = $_SESSION['id_usuario'];
    $conn = Aplicacion::getInstance()->getConexionBd();
    $mispedidosController = new MispedidosController($conn);
    $pedidos = $mispedidosController->obtenerPedidosUsuario($id_usuario);
    ?>

    <main class="carrito-container">
        <h2>Mis Pedidos</h2>

        <?php if (empty($pedidos)): ?>
            <p>No tienes pedidos realizados.</p>
        <?php else: ?>
            <table border="1" class="tabla-pedidos">
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= htmlspecialchars($pedido->getIdPedido()) ?></td>
                            <td><?= htmlspecialchars($pedido->getFecha()) ?></td>
                            <td><?= ucfirst(htmlspecialchars($pedido->getEstado())) ?></td>
                            <td>$<?= number_format($pedido->getTotal(), 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>Detalles de los Pedidos</h2>
            <?php foreach ($pedidos as $pedido): ?>
                <h3>Detalles del Pedido #<?= htmlspecialchars($pedido->getIdPedido()) ?></h3>
                <table border="1" class="tabla-detalles">
                    <thead>
                        <tr>
                            <th>ID Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $detalles = $mispedidosController->obtenerDetallesPedido($pedido->getIdPedido());
                        foreach ($detalles as $detalle): ?>
                            <tr>
                                <td><?= htmlspecialchars($detalle->getIdProducto()) ?></td>
                                <td><?= htmlspecialchars($detalle->getCantidad()) ?></td>
                                <td>$<?= number_format($detalle->getPrecioUnidad(), 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

<?php endif; ?>

<?php require RUTA_VISTAS . 'plantillas/plantilla2.php'; ?>