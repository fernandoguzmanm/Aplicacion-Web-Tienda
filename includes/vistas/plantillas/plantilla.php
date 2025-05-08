<!DOCTYPE html>
<html lang ="es">
<head>
    <meta charset="UTF-8">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" type="text/css" href="<?= URL_CSS . 'estilo2.css?v=4' ?>">
</head>
<body>
<?php
require RUTA_VISTAS . 'comun/header.php';
?>
    <main>
        <article>
            <?= $contenidoPrincipal ?>
        </article>
    </main>
<?php
require RUTA_VISTAS . 'comun/pie.php';
?>
</body>
</html>