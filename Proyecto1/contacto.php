<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <script src="./JS/mailto.js" defer></script> 
    <link rel="stylesheet" href="./css/cssContacto.css"> 
</head>
<body>

<?php include 'header.php'; ?> <!-- Incluir el header modular -->

<main>
    <h1>Formulario de Contacto</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = htmlspecialchars($_POST['nombre']);
        $email = htmlspecialchars($_POST['email']);
        $motivo = htmlspecialchars($_POST['motivo']);
        $mensaje = htmlspecialchars($_POST['mensaje']);

        echo "<p><strong>Mensaje enviado con éxito:</strong></p>";
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Correo Electrónico:</strong> $email</p>";
        echo "<p><strong>Motivo:</strong> $motivo</p>";
        echo "<p><strong>Consulta:</strong> $mensaje</p>";
    } else {
    ?>

    <form action="contacto.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
    
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>
    
        <p>Motivo de la consulta:</p>
        <input type="radio" id="evaluacion" name="motivo" value="Evaluación" required>
        <label for="evaluacion">Evaluación</label><br>
    
        <input type="radio" id="sugerencias" name="motivo" value="Sugerencias" required>
        <label for="sugerencias">Sugerencias</label><br>
    
        <input type="radio" id="criticas" name="motivo" value="Críticas" required>
        <label for="criticas">Críticas</label><br><br>

        <input type="checkbox" id="terminos" name="terminos" required>
        <label for="terminos">Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio</label>
    
        <label for="mensaje">Consulta:</label><br>
        <textarea id="mensaje" name="mensaje" rows="4" cols="50" required></textarea><br><br>
    
        <input type="submit" value="Enviar">
    </form>

    <?php } ?> <!-- Cierre del bloque PHP -->
</main>

</body>
</html>
