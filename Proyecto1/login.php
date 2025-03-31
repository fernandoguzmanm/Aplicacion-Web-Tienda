<?php $tituloPagina = 'Login';?>

<body>
    <h2>Iniciar Sesión</h2>
    <form action="../../../procesarLogin.php" method="post" class="formulario-form">
        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required><br>
        <button type="submit-button">Iniciar Sesión</button>
        <p>Si todavía no tienes una cuenta creada:</p>
        <a href="../../../registro.php">Registro</a></li>
    </form>
</body>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/AW/Proyecto1/includes/vistas/plantillas/plantilla3.php'; ?>
