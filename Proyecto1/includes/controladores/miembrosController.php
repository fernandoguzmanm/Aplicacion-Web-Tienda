<?php
require_once __DIR__ . '/../modelos/MiembrosModel.php';

class MiembrosController {
    public function mostrarMiembros() {
        $tituloPagina = 'Miembros';

        // Obtener los datos del modelo
        $modelo = new MiembrosModel();
        $miembros = $modelo->obtenerMiembros();
        $datos_miembros = $modelo->obtenerDatosMiembros();

        require 'miembros.php';
    }
}
?>
