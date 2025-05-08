<?php
ob_start();
$tituloPagina = 'Admin';
require_once __DIR__ . '/includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
require_once RUTA_INCLUDES . 'formularionuevacategoria.php';
?>

<main>
    <h2>Gestión de Categorías</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categorias)): ?>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?= htmlspecialchars($categoria->getIdCategoria()) ?></td>
                        <td><?= ucfirst(htmlspecialchars($categoria->getNombre())) ?></td>
                        <td>
                            <a href="<?= RUTA_APP . 'controller.php?controller=admin&action=eliminarCategoria&id=' . $categoria->getIdCategoria() ?>">Eliminar</a>
                            <a href="<?= RUTA_APP . 'controller.php?controller=admin&action=modificarCategoria&id=' . $categoria->getIdCategoria() ?>">Modificar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay categorías disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h3>Crear Nueva Categoría</h3>
    <?php
    $form = new formularioNuevaCategoria();
    echo $form->gestiona();
    ?>
</main>