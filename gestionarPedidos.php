<?php $tituloPagina = "Pedidos"; ?>

<main>
    <h2>Gestión de Pedidos</h2>

    <?php if (empty($pedidos)): ?>
        <p>No hay pedidos registrados.</p>
    <?php else: ?>
        <?php foreach ($pedidos as $pedido): ?>
            <section class="pedido">
                <h3>Pedido #<?= htmlspecialchars($pedido->getIdPedido()) ?></h3>
                <p><strong>Usuario:</strong> <?= htmlspecialchars($pedido->getIdUsuario()) ?></p>
                <p><strong>Fecha:</strong> <?= htmlspecialchars($pedido->getFecha()) ?></p>
                <p><strong>Estado:</strong> <?= ucfirst(htmlspecialchars($pedido->getEstado())) ?></p>
                <p><strong>Total:</strong> $<?= number_format($pedido->getTotal(), 2) ?></p>

                <h3>Detalles del Pedido</h3>
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID Producto</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio Unidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalles as $detalle): ?>
                            <?php if ($detalle->getIdPedido() === $pedido->getIdPedido()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($detalle->getIdProducto()) ?></td>
                                    <td><?= ucfirst(htmlspecialchars($detalle->getNombre())) ?></td>
                                    <td><?= htmlspecialchars($detalle->getCantidad()) ?></td>
                                    <td>$<?= number_format($detalle->getPrecioUnidad(), 2) ?></td>
                                    <td>$<?= number_format($detalle->getCantidad() * $detalle->getPrecioUnidad(), 2) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form method="POST" action="controller.php?controller=admin&action=cambiarEstadoPedido">
                    <input type="hidden" name="id_pedido" value="<?= htmlspecialchars($pedido->getIdPedido()) ?>">
                    <label for="estado_<?= htmlspecialchars($pedido->getIdPedido()) ?>">Cambiar Estado:</label>
                    <select name="nuevo_estado" id="estado_<?= htmlspecialchars($pedido->getIdPedido()) ?>">
                        <option value="pendiente" <?= $pedido->getEstado() === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                        <option value="enviado" <?= $pedido->getEstado() === 'enviado' ? 'selected' : '' ?>>Enviado</option>
                        <option value="entregado" <?= $pedido->getEstado() === 'entregado' ? 'selected' : '' ?>>Entregado</option>
                        <option value="cancelado" <?= $pedido->getEstado() === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                    </select>
                    <button type="submit">Actualizar Estado</button>
                </form>
            </section>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>