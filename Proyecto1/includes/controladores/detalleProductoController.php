<?php
require_once 'includes/modelos/producto.php';

class DetalleProductoController {
    private $producto;

    public function __construct() {
        global $conn;
        $this->producto = new Producto($conn);
    }

    public function obtenerDetalleProducto($id_producto) {
        $producto = $this->producto->obtenerProductoPorId($id_producto);
        
        if (!$producto) {
            header("Location: tienda.php");
            exit();
        }
        
        return $producto;
    }
    
    public function mostrarDetalle($id_producto) {
        $producto = $this->obtenerDetalleProducto($id_producto);
        include 'detalleProducto.php';
    }
}
?>