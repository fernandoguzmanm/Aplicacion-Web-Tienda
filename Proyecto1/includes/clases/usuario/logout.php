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
    <link rel="stylesheet" href="CSS/cssLogout.css">
</head>
<body>
    <div id="contenedor">
        <?php include("header.php"); ?>
        
        <div id="contenido">
            <?php
            if (isset($_SESSION["login"])) {
                echo "<h2>Adiós</h2>";
                echo "<h2>Adiós</h2>";
                echo "<h2>Adiós</h2>";
                echo "<p>Gracias por visitar nuestra web. Hasta pronto.</p>";
                echo "<a href='index.php'>Volver a la página principal</a>";
                session_destroy();
            } else {
                echo "<h2>No hay sesión iniciada</h2>";
                echo "<p><a href='index.php'>Volver a la página principal</a></p>";
            }
            ?>
        </div>

    </div>
</body>
</html>