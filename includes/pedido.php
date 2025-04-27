<?php
require_once './includes/config.php';
require_once __DIR__ . '/aplicacion.php';

class Pedido {
    private $id_pedido;
    private $id_usuario;
    private $fecha;
    private $estado;
    private $total;

    private $conn;

    public function __construct($conn, $data = null) {
        $this->conn = $conn;

        if ($data) {
            $this->id_pedido = $data['id_pedido'] ?? null;
            $this->id_usuario = $data['id_usuario'] ?? null;
            $this->fecha = $data['fecha_pedido'] ?? null;
            $this->estado = $data['estado'] ?? null;
            $this->total = $data['total'] ?? null;
        }
    }

    public function getIdPedido() {
        return $this->id_pedido;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getTotal() {
        return $this->total;
    }

    public function crearPedido($id_usuario, $estado, $total) {
        $fecha = date('Y-m-d H:i:s'); // Fecha actual en formato MySQL
        $query = "INSERT INTO pedidos (id_usuario, fecha_pedido, estado, total) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issd", $id_usuario, $fecha, $estado, $total);

        if ($stmt->execute()) {
            $this->id_pedido = $this->conn->insert_id; // Obtiene el ID del pedido recién creado
            $this->id_usuario = $id_usuario;
            $this->fecha = $fecha;
            $this->estado = $estado;
            $this->total = $total;
            return true;
        } else {
            error_log("Error BD ({$this->conn->errno}): {$this->conn->error}");
            return false;
        }
    }

    public function eliminarPedido($id_pedido) {
        $queryPedido = "DELETE FROM pedidos WHERE id_pedido = ?";
        $stmtPedido = $this->conn->prepare($queryPedido);
        $stmtPedido->bind_param("i", $id_pedido);

        if ($stmtPedido->execute()) {
            return true;
        } else {
            error_log("Error al eliminar pedido ({$this->conn->errno}): {$this->conn->error}");
            return false;
        }
    }

    public function obtenerTodosLosPedidos() {
        $sql = "SELECT id_pedido, id_usuario, fecha_pedido, estado, total FROM pedidos";
        $result = $this->conn->query($sql);

        $pedidos = [];
        while ($fila = $result->fetch_assoc()) {
            $pedidos[] = new Pedido($this->conn, $fila);
        }

        return $pedidos;
    }

    public function cambiarEstadoPedido($id_pedido, $nuevo_estado) {
        // Lista de estados permitidos
        $estados_permitidos = ['pendiente', 'enviado', 'entregado', 'cancelado'];

        // Validar que el nuevo estado sea válido
        if (!in_array($nuevo_estado, $estados_permitidos)) {
            error_log("Estado no válido: $nuevo_estado");
            return false;
        }

        // Actualizar el estado en la base de datos
        $query = "UPDATE pedidos SET estado = ? WHERE id_pedido = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $nuevo_estado, $id_pedido);

        if ($stmt->execute()) {
            return $stmt->affected_rows > 0; // Devuelve true si se actualizó el estado
        } else {
            error_log("Error al cambiar el estado del pedido ({$this->conn->errno}): {$this->conn->error}");
            return false;
        }
    }
}
?>