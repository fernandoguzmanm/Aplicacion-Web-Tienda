<?php
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'formularionuevoproducto.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$form = new formularionuevoproducto();
$htmlFormNuevoProducto = $form->gestiona();

$tituloPagina = 'Admin';
?>
<main>
    <h2>Crear Producto</h2>
    <?= $htmlFormNuevoProducto ?>
    <a href="<?= RUTA_APP . 'controller.php?controller=admin&action=gestionarProductos' ?>" class="btn">Volver</a>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>