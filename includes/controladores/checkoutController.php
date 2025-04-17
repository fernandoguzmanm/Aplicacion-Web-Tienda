<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once RUTA_INCLUDES . 'producto.php';

class CheckoutController {
    private $producto;

    public function __construct() {
        global $conn;
        $this->producto = new Producto($conn);
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    public function mostrarCheckout() {
        $carrito = $_SESSION['carrito'];
        $total = $this->calcularTotal();
        require RUTA_BASE . 'checkout.php';
    }

    private function calcularTotal() {
        $total = 0;
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
        return $total;
    }
}

$checkout = new CheckoutController($conn);
?>