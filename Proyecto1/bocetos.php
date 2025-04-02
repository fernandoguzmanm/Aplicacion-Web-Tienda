<?php 
require_once './includes/config.php'; // Incluir config.php para usar las constantes definidas
?>

<main>
    <?php foreach ($bocetos as $id => $titulo) : ?>
        <h2 id="<?= htmlspecialchars($id) ?>"><?= htmlspecialchars($titulo) ?></h2>
        <p><?= htmlspecialchars((new BocetosController())->obtenerDescripcion($id)) ?></p>
        <img src="<?= RUTA_IMGS . 'bocetos/' . htmlspecialchars($id) ?>.png" 
             alt="Boceto de la <?= htmlspecialchars($titulo) ?>" 
             class="bocetos-img">
    <?php endforeach; ?>
</main>

<?php require RUTA_VISTAS . 'plantillas/plantilla2.php'; ?>