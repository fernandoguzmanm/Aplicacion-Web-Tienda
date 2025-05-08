<?php 
$tituloPagina = 'Login';
require_once './includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
require_once RUTA_INCLUDES . 'formulariologin.php';

$form = new formulariologin();
$htmlFormLogin = $form->gestiona();
?>
<body>
    <h2> Iniciar Sesión</h2>
    <?= $htmlFormLogin ?>
</body>