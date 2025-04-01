<?php 

require_once './includes/formulariologin.php';
require_once './includes/config.php';

$form = new formulariologin();
$htmlFormLogin = $form->gestiona();

$tituloPagina = 'Login';
?>
<body>
    <h2> Iniciar Sesión</h2>
    <?= $htmlFormLogin ?>
</body>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/AW/Proyecto1/includes/vistas/plantillas/plantilla3.php'; ?>
