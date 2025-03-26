<?php
class MiembrosModel {
    public function obtenerMiembros() {
        return [
            "fernando_guzman" => "Fernando Guzmán Muñoz",
            "fernando_vieites" => "Fernando Vieites Moreira",
            "rishi" => "Rishi Pursnani Mirpuri",
            "guillermo" => "Guillermo Guzmán González Ortiz"
        ];
    }

    public function obtenerDatosMiembros() {
        return [
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
    }
}
?>
