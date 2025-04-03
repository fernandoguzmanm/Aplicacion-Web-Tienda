<?php
require_once __DIR__ . '/../config.php'; 
require_once RUTA_INCLUDES . 'producto.php';

class VendedorController {
    private $producto;
    private $id_vendedor;

    public function __construct($id_vendedor = null) {
        global $conn;
        $this->producto = new Producto($conn);

        if ($id_vendedor === null && isset($_SESSION['id_usuario'])) {
            $this->id_vendedor = $_SESSION['id_usuario'];
        } else {
            $this->id_vendedor = $id_vendedor;
        }
    }

    public function mostrarVendedor() {
        if (!$this->id_vendedor) {
            die('Error: ID del vendedor no definido.');
        }

        $productos = $this->producto->obtenerProductosPorVendedor($this->id_vendedor);
        require RUTA_BASE . 'vendedor.php';
    }

    public function añadirStock($id_producto, $cantidad) {
        $producto = $this->producto->obtenerProductoPorId($id_producto);
        if ($producto) {
            $this->producto->aumentarStock($id_producto, $cantidad);
        }
    }

    public function eliminarStock($id_producto, $cantidad) {
        $producto = $this->producto->obtenerProductoPorId($id_producto);
        if ($producto) {
            $stock_actual = $producto['stock'];
            if ($cantidad > $stock_actual) {
                $cantidad = $stock_actual;
            }
            $this->producto->reducirStock($id_producto, $cantidad);
        }
    }

    public function getIdVendedor() {
        return $this->id_vendedor;
    }
}
?>