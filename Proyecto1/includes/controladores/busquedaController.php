<?php
require_once RUTA_MODELOS . 'producto.php';

class BusquedaController {

    private $productoModel;

    public function __construct() {
        global $conn;
        $this->productoModel = new Producto($conn);
    }

    public function mostrarBusqueda() {
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
        $categoria = isset($_GET['categorias']) ? $_GET['categorias'] : '';
        $min_precio = isset($_GET['min_precio']) ? $_GET['min_precio'] : null;
        $max_precio = isset($_GET['max_precio']) ? $_GET['max_precio'] : null;

        $resultados = $this->productoModel->buscarProductos($query, $categoria, $min_precio, $max_precio);

        require RUTA_VISTAS . 'buscar.php';
    }
}
?>