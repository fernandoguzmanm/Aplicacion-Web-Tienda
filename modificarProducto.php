<?php 
$tituloPagina = 'Producto';
require_once './includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
require_once RUTA_INCLUDES . 'formulariomodificarproducto.php';

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