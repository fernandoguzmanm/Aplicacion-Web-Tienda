<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './includes/config.php'; // Incluir config.php para usar las constantes definidas
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
            <?php
            if (!isset($_SESSION["nombre"])) {
                echo "<h2>Acceso Denegado</h2>";
                echo "<p>Por favor, <a href='" . RUTA_APP . "login.php'>inicia sesión</a>.</p>";
            } elseif ($_SESSION["nombre"] == "Administrador") {
                echo "<h1>Consola de Administración</h1>";
                echo "<p>Hola Administrador</p>";
                echo "<a href='" . RUTA_APP . "logout.php'>Cerrar sesión</a>";
                echo "<a href='" . RUTA_APP . "index.php'>Volver a la página principal</a>";
            } else {
                echo "<h2>Acceso Denegado</h2>";
                echo "<p>No tienes permisos para acceder a esta página.</p>";
                echo "<a href='" . RUTA_APP . "index.php'>Volver a la página principal</a>";
            }
            ?>
        </div>

    </div>
</body>
</html>