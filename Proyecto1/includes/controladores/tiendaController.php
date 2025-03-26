<?php
require_once 'includes/modelos/producto.php';
require_once 'includes/mysql/conexion.php';

class TiendaController {
    private $productoModel;

    public function __construct() {
        global $conn;
        $this->productoModel = new Producto($conn);
    }

    public function mostrarTienda() {
        $productos = $this->productoModel->obtenerProductos();
        require 'tienda.php';
    }
}
?>
