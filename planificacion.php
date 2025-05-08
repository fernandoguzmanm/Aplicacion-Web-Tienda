<?php
require_once './includes/config.php';
require RUTA_VISTAS . 'plantillas/plantilla2.php';
$tituloPagina = 'Planificación';
?>

<main>
    <section>
        <h2>Plan de Desarrollo</h2>
        <p>El desarrollo de ShopEasy se organizará en varias fases para garantizar un flujo de trabajo eficiente y estructurado. A continuación, se detallan las tareas clave del proyecto y su distribución.</p>
    </section>

    <section>
        <h2>Tareas y Responsabilidades</h2>
        <ul>
            <?php if (!empty($tareas)): ?>
                <?php foreach ($tareas as $titulo => $descripcion): ?>
                    <li><strong><?= htmlspecialchars($titulo) ?>:</strong> <?= htmlspecialchars($descripcion) ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No hay tareas definidas en este momento.</li>
            <?php endif; ?>
        </ul>
    </section>

    <section>
        <h2>Plazos y Hitos</h2>
        <table>
            <tr>
                <th>Hito</th>
                <th>Descripción</th>
                <th>Fecha de Finalización</th>
            </tr>
            <?php if (!empty($hitos)): ?>
                <?php foreach ($hitos as $hito): ?>
                    <tr>
                        <td><?= htmlspecialchars($hito[0]) ?></td>
                        <td><?= htmlspecialchars($hito[1]) ?></td>
                        <td><?= htmlspecialchars($hito[2]) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay hitos definidos en este momento.</td>
                </tr>
            <?php endif; ?>
        </table>
    </section>
</main>