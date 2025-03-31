<?php $tituloPagina = 'Registro';?>

<body>
    <h2>Registro de Usuario</h2>
    <form action="procesarregistro.php" method="POST" class="formulario-form">
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" name="nombre" required>

        <label for="email">Correo:</label>
        <input type="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit-button">Registrarse</button>
    </form>
</body>

<?php require './includes/vistas/plantillas/plantilla3.php'; ?>