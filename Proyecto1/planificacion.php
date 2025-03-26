<main>
    <section>
        <h2>Plan de Desarrollo</h2>
        <p>El desarrollo de ShopEasy se organizará en varias fases para garantizar un flujo de trabajo eficiente y estructurado. A continuación, se detallan las tareas clave del proyecto y su distribución.</p>
    </section>

    <section>
        <h2>Tareas y Responsabilidades</h2>
        <ul>
            <?php foreach ($tareas as $titulo => $descripcion): ?>
                <li><strong><?= htmlspecialchars($titulo) ?>:</strong> <?= htmlspecialchars($descripcion) ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section>
        <h2>Plazos y Hitos</h2>
        <table border="1">
            <tr>
                <th>Hito</th>
                <th>Descripción</th>
                <th>Fecha de Finalización</th>
            </tr>
            <?php foreach ($hitos as $hito): ?>
                <tr>
                    <td><?= htmlspecialchars($hito[0]) ?></td>
                    <td><?= htmlspecialchars($hito[1]) ?></td>
                    <td><?= htmlspecialchars($hito[2]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>

<?php require './includes/vistas/plantillas/plantilla2.php'; ?>