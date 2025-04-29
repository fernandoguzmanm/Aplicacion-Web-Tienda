<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" type="text/css" href="<?= URL_CSS . 'estilo2.css?v=4' ?>">
    <link rel="stylesheet" type="text/css" href="<?= URL_CSS . 'cssHeader.css?v=6' ?>"> <!-- CSS del header -->
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