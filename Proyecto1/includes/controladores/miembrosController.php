<?php
class MiembrosController {
    private $miembros;
    private $datosMiembros;

    public function __construct() {
        $this->miembros = $this->obtenerMiembros();
        $this->datosMiembros = $this->obtenerDatosMiembros();
    }

    public function mostrarMiembros() {
        $tituloPagina = 'Miembros';
        $miembros = $this->miembros;
        $datos_miembros = $this->datosMiembros;

        require RUTA_VISTAS . 'miembros.php';
    }

    private function obtenerMiembros() {
        return [
            "fernando_guzman" => "Fernando Guzmán Muñoz",
            "fernando_vieites" => "Fernando Vieites Moreira",
            "rishi" => "Rishi Pursnani Mirpuri",
            "guillermo" => "Guillermo Guzmán González Ortiz"
        ];
    }

    private function obtenerDatosMiembros() {
        return [
            "fernando_guzman" => [
                "nombre" => "Fernando Guzmán Muñoz",
                "imagen" => RUTA_IMG . 'fernando_guzman.jpeg',
                "correo" => "feguzm01@ucm.es",
                "descripcion" => "Apasionado por la inteligencia artificial y la ciberseguridad. En su tiempo libre, disfruta del deporte y los videojuegos."
            ],
            "fernando_vieites" => [
                "nombre" => "Fernando Vieites Moreira",
                "imagen" => RUTA_IMG . 'fernando_vieites.jpeg',
                "correo" => "fvieites@ucm.es",
                "descripcion" => "Entusiasta de la robótica y el desarrollo web. Le encanta viajar y probar nuevas gastronomías."
            ],
            "rishi" => [
                "nombre" => "Rishi Pursnani Mirpuri",
                "imagen" => RUTA_IMG . 'rishi.jpeg',
                "correo" => "ripursna@ucm.es",
                "descripcion" => "Interesado en la programación competitiva y el análisis de datos. Disfruta de la lectura y el ajedrez."
            ],
            "guillermo" => [
                "nombre" => "Guillermo Guzmán González Ortiz",
                "imagen" => RUTA_IMG . 'guillermo.JPG',
                "correo" => "guilgo08@ucm.es",
                "descripcion" => "Le apasiona el desarrollo de videojuegos y la realidad virtual. También hace fútbol en su tiempo libre."
            ]
        ];
    }

    public function getMiembros() {
        return $this->miembros;
    }

    public function getDatosMiembros() {
        return $this->datosMiembros;
    }
}
?>