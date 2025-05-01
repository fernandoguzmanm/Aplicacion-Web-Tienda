<?php
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'formularioregistro.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$form = new formularioregistro();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Admin';
?>
<main>
    <h2>Crear Usuario</h2>
    <?= $htmlFormRegistro ?>
    <a href="<?= RUTA_APP . 'controller.php?controller=admin&action=gestionarUsuarios' ?>" class="btn">Volver</a>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>