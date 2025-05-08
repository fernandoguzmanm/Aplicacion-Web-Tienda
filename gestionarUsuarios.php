<?php
$tituloPagina = 'Admin';
require_once __DIR__.'/includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
require_once RUTA_INCLUDES . 'controladores/vendedorController.php';
?>
<main>
<h2>Gestión de Usuarios</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= ucfirst(htmlspecialchars($usuario['tipo_usuario'])) ?></td>
                    <td>
                        <a href="<?= RUTA_APP . 'controller.php?controller=admin&action=eliminarUsuario&id=' . $usuario['id_usuario'] ?>">Eliminar</a>
                        <a href="<?= RUTA_APP . 'controller.php?controller=admin&action=modificarUsuario&id=' . $usuario['id_usuario'] ?>">Modificar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
    <a href="<?= RUTA_APP . 'crearUsuario.php' ?>" class="btn">Crear Usuario</a>
</main>