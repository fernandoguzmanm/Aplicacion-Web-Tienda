<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/modelos/producto.php';

$tituloPagina = 'Gestión de Productos';

$productos = \es\ucm\fdi\aw\Producto::obtenerProductos();

require_once __DIR__.'/includes/vistas/comun/header.php';
?>

<h1>Panel de Vendedor - Gestión de Productos</h1>

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
                <td><?= (int)$producto['cantidad'] ?></td>
                <td>
                    <a href="editar_producto.php?id=<?= urlencode($producto['id']) ?>">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
require_once __DIR__.'/includes/vistas/comun/pie.php';
?>
