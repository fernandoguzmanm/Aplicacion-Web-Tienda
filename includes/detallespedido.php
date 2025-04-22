<?php
require_once './includes/config.php';
require_once __DIR__ . '/aplicacion.php';

class DetallesPedido {
    private $id_pedido;
    private $id_producto;
    private $cantidad;
    private $precio_unidad;

    private $conn;

    public function __construct($conn, $data = null) {
        $this->conn = $conn;

        if ($data) {
            $this->id_pedido = $data['id_pedido'] ?? null;
            $this->id_producto = $data['id_producto'] ?? null;
            $this->cantidad = $data['cantidad'] ?? null;
            $this->precio_unidad = $data['precio_unidad'] ?? null;
        }
    }

    public function getIdPedido() {
        return $this->id_pedido;
    }

    public function getIdProducto() {
        return $this->id_producto;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getPrecioUnidad() {
        return $this->precio_unidad;
    }

    public function agregarDetalle($id_pedido, $id_producto, $cantidad, $precio_unidad) {
        $query = "INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio_unidad) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiid", $id_pedido, $id_producto, $cantidad, $precio_unidad);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error BD ({$this->conn->errno}): {$this->conn->error}");
            return false;
        }
    }
}
?>