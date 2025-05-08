<?php
$tituloPagina = 'Registro';
require_once './includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
require_once RUTA_INCLUDES . 'formularioregistro.php';

$form = new FormularioRegistro();
$htmlFormRegistro = $form->gestiona();
?> 

<body>
    <h2>Registro de Usuario</h2>
    <?= $htmlFormRegistro ?>
</body>