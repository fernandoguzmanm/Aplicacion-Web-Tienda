<?php 
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'formulariomodificarusuario.php';

$tituloPagina = 'Admin';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$form = new formulariomodificarusuario($usuario);
$htmlFormModificarUsuario = $form->gestiona();
?>

<main class="detalle-container">
    <h2>Detalles del Usuario</h2>
    <?= $htmlFormModificarUsuario ?>
    <a href="controller.php?controller=admin&action=gestionarUsuarios" class="btn">Volver</a>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>
