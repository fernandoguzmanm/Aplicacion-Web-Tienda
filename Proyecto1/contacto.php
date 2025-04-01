<?php 

require_once './includes/formulariocontacto.php';
require_once './includes/config.php';

$form = new formulariocontacto();
$htmlFormContacto = $form->gestiona();

$tituloPagina = 'Contacto';
?>
<body>
    <h2> Formulario de Contacto</h2>
    <?= $htmlFormContacto ?>
</body>
<?php require './includes/vistas/plantillas/plantilla3.php'; 

/*
<body>
    <h2>Formulario de Contacto</h2>

    
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
        <form action="contacto.php" method="post" class="formulario-form">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
    
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>
    
        <p>Motivo de la consulta:</p>
        
        <label for="evaluacion">Evaluación</label><br>
        <input type="radio" id="evaluacion" name="motivo" value="Evaluación" required>
        
        <label for="sugerencias">Sugerencias</label><br>
        <input type="radio" id="sugerencias" name="motivo" value="Sugerencias" required>
        
        <label for="criticas">Críticas</label><br><br>
        <input type="radio" id="criticas" name="motivo" value="Críticas" required>
        
        <label for="terminos">Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio</label>
        <input type="checkbox" id="terminos" name="terminos" required>

        <label for="mensaje">Consulta:</label><br>
        <textarea id="mensaje" name="mensaje" rows="4" cols="50" required></textarea><br><br>
    
        <input type="submit-button" value="Enviar">
    </form>
    }
</body>*/
?>