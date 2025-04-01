<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/formularioregistro.php';
//use es\ucm\fdi\aw\FormularioRegistro;

$form = new FormularioRegistro();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';
?> 

<body>
    <h2> Registro de Usuario</h2>
    <?= $htmlFormRegistro ?>
</body>

<?php require './includes/vistas/plantillas/plantilla3.php'; ?>