<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Miembros del Grupo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cssMiembros.css?v=2"> 
</head>
<body>

<?php include 'header.php'; ?> <!-- Incluir la cabecera modular -->

<main>
    <h1>Miembros del Grupo</h1>

    <div class="references">
        <ul>
            <?php
            $miembros = [
                "fernando_guzman" => "Fernando Guzmán Muñoz",
                "fernando_vieites" => "Fernando Vieites Moreira",
                "rishi" => "Rishi Pursnani Mirpuri",
                "guillermo" => "Guillermo Guzmán González Ortiz"
            ];
            
            foreach ($miembros as $id => $nombre) {
                echo "<li><a href='#$id'>$nombre</a></li>";
            }
            ?>
        </ul>
    </div>

    <?php
    $datos_miembros = [
        "fernando_guzman" => [
            "nombre" => "Fernando Guzmán Muñoz",
            "imagen" => "./img/fernando_guzman.jpeg",
            "correo" => "feguzm01@ucm.es",
            "descripcion" => "Apasionado por la inteligencia artificial y la ciberseguridad. En su tiempo libre, disfruta del deporte y los videojuegos."
        ],
        "fernando_vieites" => [
            "nombre" => "Fernando Vieites Moreira",
            "imagen" => "./img/fernando_vieites.jpeg",
            "correo" => "fvieites@ucm.es",
            "descripcion" => "Entusiasta de la robótica y el desarrollo web. Le encanta viajar y probar nuevas gastronomías."
        ],
        "rishi" => [
            "nombre" => "Rishi Pursnani Mirpuri",
            "imagen" => "./img/rishi.jpeg",
            "correo" => "ripursna@ucm.es",
            "descripcion" => "Interesado en la programación competitiva y el análisis de datos. Disfruta de la lectura y el ajedrez."
        ],
        "guillermo" => [
            "nombre" => "Guillermo Guzmán González Ortiz",
            "imagen" => "./img/guillermo.JPG",
            "correo" => "guilgo08@ucm.es",
            "descripcion" => "Le apasiona el desarrollo de videojuegos y la realidad virtual. También hace fútbol en su tiempo libre."
        ]
    ];

    foreach ($datos_miembros as $id => $info) {
        echo "<div id='$id' class='member'>";
        echo "<h2>{$info['nombre']}</h2>";
        echo "<img src='{$info['imagen']}' alt='Foto de {$info['nombre']}'>";
        echo "<p><strong>Correo:</strong> {$info['correo']}</p>";
        echo "<p>{$info['descripcion']}</p>";
        echo "</div>";
    }
    ?>
</main>

</body>
</html>
