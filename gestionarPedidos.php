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
                <p><strong>Estado:</strong> <?= htmlspecialchars($pedido->getEstado()) ?></p>
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
                                    <td><?= htmlspecialchars($detalle->getNombre()) ?></td>
                                    <td><?= htmlspecialchars($detalle->getCantidad()) ?></td>
                                    <td>$<?= number_format($detalle->getPrecioUnidad(), 2) ?></td>
                                    <td>$<?= number_format($detalle->getCantidad() * $detalle->getPrecioUnidad(), 2) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>