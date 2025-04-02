<?php 
require_once './includes/config.php';

require_once RUTA_INCLUDES . 'formulariologin.php';

$form = new formulariologin();
$htmlFormLogin = $form->gestiona();

$tituloPagina = 'Login';
?>
<body>
    <h2> Iniciar Sesión</h2>
    <?= $htmlFormLogin ?>
</body>

<?php require RUTA_VISTAS . 'plantillas/plantilla3.php'; ?>