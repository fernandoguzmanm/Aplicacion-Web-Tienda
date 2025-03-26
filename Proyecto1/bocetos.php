<main>
    <?php foreach ($bocetos as $id => $titulo) : ?>
        <h2 id="<?= $id ?>"><?= htmlspecialchars($titulo) ?></h2>
        <p><?= htmlspecialchars((new BocetosModel())->obtenerDescripcion($id)) ?></p>
        <img src="bocetos/<?= $id ?>.png" alt="Boceto de la <?= htmlspecialchars($titulo) ?>" class="bocetos-img">
    <?php endforeach; ?>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>