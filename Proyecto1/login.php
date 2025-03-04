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
                <label for="user">Usuario:</label>
                <input type="text" id="user" name="user" required><br>
                <label for="pwd">Contraseña:</label>
                <input type="password" id="pwd" name="pwd" required><br>
                <button type="submit">Iniciar Sesión</button>
                   </div>

        
    </div> <!-- Fin del contenedor -->
</body>
</html>