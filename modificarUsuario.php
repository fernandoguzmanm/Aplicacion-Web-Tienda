<?php
$tituloPagina = 'Usuario';
require_once './includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
require_once RUTA_INCLUDES . 'usuario.php';
require_once RUTA_INCLUDES . 'formulariomodificarusuario.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    die('Acceso denegado: Debes iniciar sesión para modificar tus datos.');
}

$id_usuario = $_SESSION['id_usuario'];

$usuario = Usuario::buscaPorId($id_usuario);
if (!$usuario) {
    die('Error: Usuario no encontrado.');
}

$form = new formularioModificarUsuario($usuario);
$htmlFormModificarUsuario = $form->gestiona();
?>

<main class="detalle-container">
    <h2>Modificar Datos de Usuario</h2>
    <?= $htmlFormModificarUsuario ?>
    <a href="index.php" class="btn">Volver</a>
</main>