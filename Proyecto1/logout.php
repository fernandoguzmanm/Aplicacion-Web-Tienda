<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>
    <div id="contenedor">
        <?php include("includes/vistas/comun/header.php"); ?>
        
        <div id="contenido">
            <?php
            session_destroy();
            if (isset($_SESSION["login"])) {
                echo "<h2>Adiós</h2>";
                echo "<h4>Gracias por visitar nuestra web. Hasta pronto.<h4>";
                echo "<a href='::7::7::7index.php'>Volver a la página principal</a>";
            } else {
                echo "<h2>No hay sesión iniciada</h2>";
                echo "<p><a href='index.php'>Volver a la página principal</a></p>";
            }
            ?>
        </div>

    </div>
</body>
</html>