<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'controladores/adminController.php';

$tituloPagina = 'Admin';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consola de Administración</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS . 'estilo.css'; ?>">
</head>
<body>
    <div id="contenedor">
        <?php include RUTA_VISTAS . 'comun/header.php'; ?>

        <div id="contenido">
            <h2>Consola de Administración</h2>
            <p>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']); ?>.</p>

            <ul>
                <li><a href="<?= RUTA_APP . 'controller.php?controller=admin&action=gestionarUsuarios' ?>">Gestionar Usuarios</a></li>
                <li><a href="<?= RUTA_APP . 'controller.php?controller=admin&action=gestionarProductos' ?>">Gestionar Productos</a></li>
                <li><a href="<?= RUTA_APP . 'controller.php?controller=admin&action=gestionarPedidos' ?>">Gestionar Pedidos</a></li>
            </ul>
        </div>
    </div>
</body>
</html>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>