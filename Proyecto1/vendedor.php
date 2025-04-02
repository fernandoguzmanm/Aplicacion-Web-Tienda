<?php
require_once __DIR__.'/includes/config.php';
//require_once __DIR__.'/includes/modelos/producto.php';
//require_once RUTA_CONTROLADORES . 'vendedorController.php';
require_once RUTA_INCLUDES . 'formularioañadirstock.php';
require_once RUTA_INCLUDES . 'formularioeliminarstock.php';

$tituloPagina = 'Vendedor';
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
                        <td><?= ucfirst(htmlspecialchars($producto['nombre'])) ?></td>
                        <td><?= number_format($producto['precio'], 2) ?></td>
                        <td><?= (int)$producto['stock'] ?></td>
                        <td>
                            <?php
                            $form = new formularioañadirstock($producto['id_producto']);                   
                            $htmlFormAñadirStock = $form->gestiona();

                            $form2 = new formularioeliminarstock($producto['id_producto']);                   
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
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>
