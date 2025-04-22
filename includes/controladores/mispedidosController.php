<?php
require_once RUTA_INCLUDES . 'pedido.php';
require_once RUTA_INCLUDES . 'detallespedido.php';

class MispedidosController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerPedidosUsuario($id_usuario) {
        $query = "SELECT * FROM pedidos WHERE id_usuario = ? ORDER BY fecha_pedido DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        $pedidos = [];
        while ($row = $result->fetch_assoc()) {
            $pedidos[] = new Pedido($this->conn, $row);
        }

        return $pedidos;
    }

    public function obtenerDetallesPedido($id_pedido) {
        $query = "SELECT * FROM detalles_pedido WHERE id_pedido = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_pedido);
        $stmt->execute();
        $result = $stmt->get_result();

        $detalles = [];
        while ($row = $result->fetch_assoc()) {
            $detalles[] = new DetallesPedido($this->conn, $row);
        }

        return $detalles;
    }
}
?>