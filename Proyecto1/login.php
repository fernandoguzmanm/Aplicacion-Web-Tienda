<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/cssLogin.css">
</head>
<body>
    <div id="contenedor">
        <?php include("header.php"); ?>
        

        <div id="contenido">
            <h2>Iniciar Sesión</h2>
            <form action="procesarLogin.php" method="post">
                <label for="nombre">Usuario:</label>
                <input type="text" id="nombre" name="nombre" required><br>
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required><br>
                <button type="submit">Iniciar Sesión</button>
                <p>Si todavía no tienes una cuenta creada:</p>
                <a href="registro.php">Registro</a></li>
                   </div>

        
    </div>
</body>
</html>
