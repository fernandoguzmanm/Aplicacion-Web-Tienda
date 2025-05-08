<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$tituloPagina = 'Admin';
require_once './includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
require_once RUTA_INCLUDES . 'controladores/adminController.php';
?>
<body>
    <h2>Consola de Administración</h2>
    <p>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']); ?>.</p>

    <ul>
        <li><a href="<?= RUTA_APP . 'controller.php?controller=admin&action=gestionarUsuarios' ?>">Gestionar Usuarios</a></li>
        <li><a href="<?= RUTA_APP . 'controller.php?controller=admin&action=gestionarProductos' ?>">Gestionar Productos</a></li>
        <li><a href="<?= RUTA_APP . 'controller.php?controller=admin&action=gestionarPedidos' ?>">Gestionar Pedidos</a></li>
        <li><a href="<?= RUTA_APP . 'controller.php?controller=admin&action=gestionarCategorias' ?>">Gestionar Categorías</a></li>
    </ul>
</body>
</html>