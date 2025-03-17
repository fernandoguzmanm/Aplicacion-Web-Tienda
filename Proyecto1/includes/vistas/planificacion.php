<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Planificación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cssPlanificacion.css?v=2"> 
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <section>
        <h2>Plan de Desarrollo</h2>
        <p>El desarrollo de ShopEasy se organizará en varias fases para garantizar un flujo de trabajo eficiente y estructurado. A continuación, se detallan las tareas clave del proyecto y su distribución.</p>
    </section>

    <section>
        <h2>Tareas y Responsabilidades</h2>
        <ul>
            <?php
            $tareas = [
                "Investigación y análisis" => "Estudio de plataformas similares y definición de requisitos.",
                "Diseño de la interfaz" => "Creación de bocetos y wireframes para la estructura de la web.",
                "Desarrollo de contenido" => "Redacción de textos e inclusión de imágenes y gráficos.",
                "Implementación HTML" => "Creación de las distintas páginas siguiendo los estándares HTML5.",
                "Pruebas y validación" => "Revisión de la navegación, validación de código y corrección de errores.",
                "Entrega final" => "Compilación de todos los archivos y presentación del proyecto."
            ];

            foreach ($tareas as $titulo => $descripcion) {
                echo "<li><strong>$titulo:</strong> $descripcion</li>";
            }
            ?>
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
            <?php
            $hitos = [
                ["Investigación", "Definición de funcionalidades y estructura", "3 de febrero de 2025"],
                ["Diseño", "Creación de bocetos y esquemas", "21 de febrero de 2025"],
                ["Desarrollo HTML", "Implementación de las páginas web", "7 de marzo de 2025"],
                ["Pruebas", "Revisión y validación del código", "28 de marzo de 2025"],
                ["Entrega Final", "Compilación y presentación del proyecto", "9 de mayo de 2025"]
            ];

            foreach ($hitos as $hito) {
                echo "<tr>
                        <td>{$hito[0]}</td>
                        <td>{$hito[1]}</td>
                        <td>{$hito[2]}</td>
                      </tr>";
            }
            ?>
        </table>
    </section>
</main>

</body>
</html>
