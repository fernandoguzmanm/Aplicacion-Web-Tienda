<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../config/database.php';

class BusquedaController {
    private $productoModel;

    public function __construct() {
        global $conn; // Conexión a la BD
        $this->productoModel = new Producto($conn);
    }

    public function buscar() {
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
        $categoria = isset($_GET['categorias']) ? $_GET['categorias'] : '';

        $resultados = $this->productoModel->buscarProductos($query, $categoria);

        require __DIR__ . '/../views/busqueda.php'; // Carga la vista
    }
}

$controller = new BusquedaController();
$controller->buscar();
?>
