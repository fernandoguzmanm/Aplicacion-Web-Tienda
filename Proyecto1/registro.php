<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
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
