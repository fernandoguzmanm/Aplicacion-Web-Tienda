<?php
require_once RUTA_MODELOS . 'producto.php';

class DetalleProductoController {
    private $producto;

    public function __construct() {
        global $conn;
        $this->producto = new Producto($conn);
    }

    public function obtenerDetalleProducto($id_producto) {
        $producto = $this->producto->obtenerProductoPorId($id_producto);
        
        if (!$producto) {
            header("Location: " . RUTA_APP . "tienda.php");
            exit();
        }
        
        return $producto;
    }
    
    public function mostrarDetalle($id_producto) {
        $producto = $this->obtenerDetalleProducto($id_producto);
        include RAIZ_APP . 'detalleProducto.php';
    }
}
?>