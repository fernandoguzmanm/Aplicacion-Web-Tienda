<?php
require_once 'includes/modelos/producto.php';
//use aw\proyecto1\producto;
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
