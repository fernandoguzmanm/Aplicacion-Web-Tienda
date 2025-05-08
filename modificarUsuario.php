<?php 
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'Usuario.php';
require_once RUTA_INCLUDES . 'formulariomodificarusuario.php';

$tituloPagina = 'Modificar Usuario';

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

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>
