<?php
require_once './includes/config.php';
require_once RUTA_INCLUDES . 'formularioregistro.php';

$form = new FormularioRegistro();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';
?> 

<body>
    <h2>Registro de Usuario</h2>
    <?= $htmlFormRegistro ?>
</body>

<?php require RUTA_VISTAS . 'plantillas/plantilla3.php'; ?>