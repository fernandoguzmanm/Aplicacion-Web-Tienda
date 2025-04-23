<?php
require_once __DIR__.'/includes/config.php';
require_once RUTA_INCLUDES . 'formularioañadirstock.php';
require_once RUTA_INCLUDES . 'formularioeliminarstock.php';
require_once RUTA_INCLUDES . 'controladores/vendedorController.php';

$tituloPagina = 'Vendedor';

$vendedorController = new VendedorController();
$productosVendidos = $vendedorController->obtenerProductosVendidos();
$totalVendido = 0;
?>
<main>
    <h2>Panel de Vendedor - Gestión de Productos</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio (€)</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= ucfirst(htmlspecialchars($producto->getNombre())) ?></td>
                        <td><?= number_format($producto->getPrecio(), 2) ?></td>
                        <td><?= (int)$producto->getStock() ?></td>
                        <td>
                            <?php
                            $form = new formularioañadirstock($producto->getIdProducto());                   
                            $htmlFormAñadirStock = $form->gestiona();

                            $form2 = new formularioeliminarstock($producto->getIdProducto());                   
                            $htmlFormEliminarStock = $form2->gestiona();
                            ?>

                            <?= $htmlFormAñadirStock ?>
                            <?= $htmlFormEliminarStock ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay productos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Productos Vendidos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Nombre del Producto</th>
                <th>Unidades</th>
                <th>Precio Unidad (€)</th>
                <th>Total (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productosVendidos)): ?>
                <?php foreach ($productosVendidos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['id_pedido']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($producto['nombre'])) ?></td>
                        <td><?= htmlspecialchars($producto['cantidad']) ?></td>
                        <td><?= number_format($producto['precio_unidad'], 2) ?></td>
                        <td>
                            <?php 
                            $totalProducto = $producto['cantidad'] * $producto['precio_unidad'];
                            $totalVendido += $totalProducto;
                            echo number_format($totalProducto, 2);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No se han vendido productos.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h3>Total Vendido: €<?= number_format($totalVendido, 2) ?></h3>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>
