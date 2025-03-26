<?php
class PlanificacionModel {
    public function obtenerTareas() {
        return [
            "Investigación y análisis" => "Estudio de plataformas similares y definición de requisitos.",
            "Diseño de la interfaz" => "Creación de bocetos y wireframes para la estructura de la web.",
            "Desarrollo de contenido" => "Redacción de textos e inclusión de imágenes y gráficos.",
            "Implementación HTML" => "Creación de las distintas páginas siguiendo los estándares HTML5.",
            "Pruebas y validación" => "Revisión de la navegación, validación de código y corrección de errores.",
            "Entrega final" => "Compilación de todos los archivos y presentación del proyecto."
        ];
    }

    public function obtenerHitos() {
        return [
            ["Investigación", "Definición de funcionalidades y estructura", "3 de febrero de 2025"],
            ["Diseño", "Creación de bocetos y esquemas", "21 de febrero de 2025"],
            ["Desarrollo HTML", "Implementación de las páginas web", "7 de marzo de 2025"],
            ["Pruebas", "Revisión y validación del código", "28 de marzo de 2025"],
            ["Entrega Final", "Compilación y presentación del proyecto", "9 de mayo de 2025"]
        ];
    }
}
?>
