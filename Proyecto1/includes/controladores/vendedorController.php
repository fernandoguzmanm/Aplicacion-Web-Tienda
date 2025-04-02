<?php
require_once __DIR__ . '/../config.php'; 
require_once RUTA_MODELOS . 'producto.php';


class VendedorController {
    private $producto;

    public function __construct() {
        global $conn;
        $this->producto = new Producto($conn);
    }

    public function mostrarVendedor() {
        $productos = $this->producto->obtenerProductos();
        require RUTA_BASE . 'vendedor.php';
    }
}
?>