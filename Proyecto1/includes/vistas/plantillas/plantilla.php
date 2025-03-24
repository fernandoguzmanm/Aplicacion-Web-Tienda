<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" type="text/css" href="/AW/Proyecto1/css/estilo.css" />
</head>
<body>
<?php
require(__DIR__ . '/../comun/header.php');
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

<?php require(__DIR__ . '/../comun/pie.php'); ?>