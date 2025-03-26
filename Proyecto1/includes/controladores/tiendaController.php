<?php
require_once 'includes/modelos/producto.php';
//require_once 'includes/mysql/conexion.php';

class TiendaController {
    private $producto;

    public function __construct() {
        global $conn;
        $this->producto = new Producto($conn);
    }

    public function mostrarTienda() {
        $productos = $this->producto->obtenerProductos();
        require 'tienda.php';
    }
}
?>
