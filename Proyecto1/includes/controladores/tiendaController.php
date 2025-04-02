<?php
require_once RUTA_MODELOS . 'producto.php';

class TiendaController {
    private $producto;

    public function __construct() {
        global $conn;
        $this->producto = new Producto($conn);
    }

    public function mostrarTienda() {
        $productos = $this->producto->obtenerProductos();
        require RUTA_VISTAS . 'tienda.php';
    }
}
?>