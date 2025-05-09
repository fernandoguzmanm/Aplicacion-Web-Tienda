<?php 
$tituloPagina = 'Categoría';
require_once './includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
require_once RUTA_INCLUDES . 'formulariomodificarcategoria.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$form = new formulariomodificarcategoria($categoria);
$htmlFormModificarCategoria = $form->gestiona();
?>

<main class="detalle-container">
    <h2>Categoría</h2>
    <?= $htmlFormModificarCategoria ?>
</main>