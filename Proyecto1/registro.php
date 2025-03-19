<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="./css/cssFormularios.css?v=2">
</head>
<?php include("includes/vistas/comun/header.php"); ?>
<body>
    

    <h2>Registro de Usuario</h2>
    <form action="procesarregistro.php" method="POST">
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" name="nombre" required>

        <label for="email">Correo:</label>
        <input type="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
