<?php
require_once 'includes/modelos/DetallesModel.php';

class DetallesController {
    private $modelo;

    public function __construct() {
        $this->modelo = new DetallesModel();
    }

    public function mostrarDetalles() {
        $tituloPagina = 'Detalles';
        $usuarios = $this->modelo->obtenerUsuarios();
        $funcionalidades = $this->modelo->obtenerFuncionalidades();

        require 'detalles.php';
    }
}

?>
