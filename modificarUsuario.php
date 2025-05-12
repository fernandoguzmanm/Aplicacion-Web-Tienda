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

// Determinar el ID del usuario a modificar
if ($_SESSION['rol'] === 'administrador' && isset($_GET['id']) && ctype_digit($_GET['id'])) {
    // Si es administrador y se pasa un ID por la URL, modifica los datos de ese usuario
    $id_usuario = $_GET['id'];
} else {
    // Si no es administrador, solo puede modificar sus propios datos
    $id_usuario = $_SESSION['id_usuario'];
}

// Buscar el usuario en la base de datos
$usuario = Usuario::buscaPorId($id_usuario);
if (!$usuario) {
    die('Error: Usuario no encontrado.');
}

// Crear el formulario con los datos del usuario
$form = new formularioModificarUsuario($usuario);
$htmlFormModificarUsuario = $form->gestiona();
?>

<main class="detalle-container">
    <h2>Modificar Datos de Usuario</h2>
    <?= $htmlFormModificarUsuario ?>
    <a href="<?= $_SESSION['rol'] === 'administrador' ? 'gestionarUsuarios.php' : 'index.php' ?>" class="btn">Volver</a>
</main>