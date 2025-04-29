<?php
require_once __DIR__ . '/../config.php'; 
require_once RUTA_INCLUDES . 'producto.php';
require_once RUTA_INCLUDES . 'usuario.php';
require_once RUTA_INCLUDES . 'pedido.php';
require_once RUTA_INCLUDES . 'detallespedido.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class AdminController {
    private $producto;
    private $usuario;
    private $pedido;
    private $detallespedido;

    public function __construct() {
        global $conn;
        $this->producto = new Producto($conn);
        $this->usuario = Usuario::getInstance($conn);
        $this->pedido = new Pedido($conn);
        $this->detallespedido = new DetallesPedido($conn);


        if (!isset($_SESSION['login']) || $_SESSION['rol'] !== 'administrador') {
            die('Acceso denegado: No tienes permisos para acceder a esta página.');
        }
    }

    public function mostrarAdmin() {
        require RUTA_BASE . 'admin.php';
    }

    public function gestionarUsuarios() {
        $usuarios = $this->usuario->obtenerTodosLosUsuarios();
        require 'gestionarUsuarios.php';
    }

    public function gestionarProductos() {
        $productos = $this->producto->obtenerProductos();
        require 'gestionarProductos.php';
    }

    public function gestionarPedidos() {
        $pedidos = $this->pedido->obtenerTodosLosPedidos();
        $detalles = $this->detallespedido->obtenerTodosLosDetalles();
        require 'gestionarPedidos.php';
    }
    
    public function modificarProducto($id_producto) {
        $producto = $this->producto->obtenerProductoPorId($id_producto);
        if ($producto) {
            require 'modificarProducto.php';
        } else {
            echo "Producto no encontrado.";
        }
    }

    public function eliminarUsuario($id_usuario) {
        if ($this->usuario->eliminarUsuario($id_usuario)) {
            echo "Usuario eliminado con éxito.";
        } else {
            echo "Error al eliminar el usuario.";
        }
    }

    public function eliminarProducto($id_producto) {
        if ($this->producto->eliminarProducto($id_producto)) {
            echo "Producto eliminado con éxito.";
        } else {
            echo "Error al eliminar el producto.";
        }
    }

    public function cambiarEstadoPedido($id_pedido, $estado) {
        if ($this->pedido->cambiarEstadoPedido($id_pedido, $estado)) {
            echo "Estado del pedido actualizado con éxito.";
        } else {
            echo "Error al actualizar el estado del pedido.";
        }
    }
}
?>