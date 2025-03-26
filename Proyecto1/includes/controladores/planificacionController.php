<?php
require_once __DIR__ . '/../modelos/PlanificacionModel.php';

class PlanificacionController {
    public function mostrarPlanificacion() {
        $tituloPagina = 'Planificación';

        // Obtener los datos del modelo
        $modelo = new PlanificacionModel();
        $tareas = $modelo->obtenerTareas();
        $hitos = $modelo->obtenerHitos();

        require 'planificacion.php';
    }
}
?>
