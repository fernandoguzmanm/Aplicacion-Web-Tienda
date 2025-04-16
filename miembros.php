<main>
    <h2>Miembros del Grupo</h2>
    <ul>
        <?php foreach ($miembros as $id => $nombre): ?>
            <li><a href="#<?= htmlspecialchars($id) ?>"><?= htmlspecialchars($nombre) ?></a></li>
        <?php endforeach; ?>
    </ul>

    <?php foreach ($datos_miembros as $id => $info): ?>
        <div id="<?= htmlspecialchars($id) ?>" class="member">
            <h2><?= htmlspecialchars($info['nombre']) ?></h2>
            <img src="<?= htmlspecialchars($info['imagen']) ?>" alt="Foto de <?= htmlspecialchars($info['nombre']) ?>">
            <p><strong>Correo:</strong> <?= htmlspecialchars($info['correo']) ?></p>
            <p><?= htmlspecialchars($info['descripcion']) ?></p>
        </div>
    <?php endforeach; ?>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>