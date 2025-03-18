<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/cssFormularios.css">
</head>
<?php include("includes/vistas/comun/header.php"); ?>
<body>

    <h2>Iniciar Sesión</h2>
    <form action="procesarLogin.php" method="post">
        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required><br>
        <button type="submit">Iniciar Sesión</button>
        <p>Si todavía no tienes una cuenta creada:</p>
        <a href="registro.php">Registro</a></li>

</body>
</html>
