<?php 
$tituloPagina = 'Contacto';
require_once './includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
require_once RUTA_INCLUDES . 'formulariocontacto.php';

$form = new formulariocontacto();
$htmlFormContacto = $form->gestiona();
?>
<body>
    <h2>Formulario de Contacto</h2>
    <?= $htmlFormContacto ?>
</body>