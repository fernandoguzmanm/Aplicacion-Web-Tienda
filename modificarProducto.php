<?php 
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'formulariomodificarproducto.php';

$tituloPagina = 'Admin';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$form = new formulariomodificarproducto($producto);
$htmlFormModificarProducto = $form->gestiona();
?>

<main class="detalle-container">
    <h2>Detalles del Producto</h2>
    <?= $htmlFormModificarProducto ?>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>
