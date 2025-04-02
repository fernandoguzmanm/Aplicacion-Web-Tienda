<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS . 'estilo.css?v=4' ?>" />
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
?>
</body>
</html>

<?php require RUTA_VISTAS . 'comun/pie.php'; ?>