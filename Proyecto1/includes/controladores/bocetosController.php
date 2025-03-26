<?php
require_once __DIR__ . '/../modelos/BocetosModel.php';

class BocetosController {
    public function mostrarBocetos() {
        $tituloPagina = 'Bocetos';

        // Instanciar el modelo
        $model = new BocetosModel();
        $bocetos = $model->obtenerBocetos();

        require 'bocetos.php';
    }
}
?>
