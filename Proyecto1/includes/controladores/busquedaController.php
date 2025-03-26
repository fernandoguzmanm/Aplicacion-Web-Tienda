<?php
require_once 'includes/modelos/Producto.php';

class BusquedaController {

    private $productoModel;

    public function __construct() {
        global $conn;
        $this->productoModel = new Producto($conn);
    }

    public function mostrarBusqueda() {
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
        $categoria = isset($_GET['categorias']) ? $_GET['categorias'] : '';

        $resultados = $this->productoModel->buscarProductos($query, $categoria);

        require 'buscar.php';
    }
}
?>
