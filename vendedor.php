<?php
$tituloPagina = 'Vendedor';
require_once __DIR__.'/includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
require_once RUTA_INCLUDES . 'formularioanadirstock.php';
require_once RUTA_INCLUDES . 'formularioeliminarstock.php';
require_once RUTA_INCLUDES . 'controladores/vendedorController.php';
require_once RUTA_INCLUDES . 'formularionuevacategoria.php';

$form = new formularioNuevaCategoria();
$htmlFormNuevaCategoria = $form->gestiona();

$vendedorController = new VendedorController();
$productosVendidos = $vendedorController->obtenerProductosVendidos();
$totalVendido = 0;
?>
<main>
    <h2>Panel de Vendedor - Gestión de Productos</h2>

    <table>
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
                            $form = new formularioanadirstock($producto->getIdProducto());                   
                            $htmlFormAnadirStock = $form->gestiona();

                            $form2 = new formularioeliminarstock($producto->getIdProducto());                   
                            $htmlFormEliminarStock = $form2->gestiona();
                            ?>

                            <?= $htmlFormAnadirStock ?>
                            <?= $htmlFormEliminarStock ?>

                            <a href="controller.php?controller=vendedor&action=eliminarProducto&id=<?php echo $producto->getIdProducto(); ?>" class="btn">Eliminar Producto</a>
                            <a href="controller.php?controller=vendedor&action=modificarProducto&id=<?php echo $producto->getIdProducto(); ?>" class="btn">Modificar Producto</a>
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

    <a href="<?= RUTA_APP . 'crearProducto.php' ?>" class="btn">Crear Producto</a>

    <h2>Productos Vendidos</h2>
    <table>
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

    <h3>Crear Nueva Categoría</h3>
    <?= $htmlFormNuevaCategoria ?>
</main>