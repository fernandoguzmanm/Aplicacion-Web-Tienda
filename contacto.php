<?php 

require_once './includes/config.php';
require_once RUTA_INCLUDES . 'formulariocontacto.php';

$form = new formulariocontacto();
$htmlFormContacto = $form->gestiona();

$tituloPagina = 'Contacto';
?>
<body>
    <h2>Formulario de Contacto</h2>
    <?= $htmlFormContacto ?>
</body>
<?php require RUTA_VISTAS . 'plantillas/plantilla3.php'; ?>