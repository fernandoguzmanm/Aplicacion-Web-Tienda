<?php
require_once __DIR__.'/includes/config.php';
//require_once __DIR__.'/includes/modelos/producto.php';
//require_once RUTA_CONTROLADORES . 'vendedorController.php';

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
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['nombre']) ?></td>
                    <td><?= number_format($producto['precio'], 2) ?></td>
                    <td><?= (int)$producto['stock'] ?></td>
                    <td>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>
