<?php
require_once './includes/config.php';
require_once __DIR__ . '/aplicacion.php';

class DetallesPedido {
    private $id_pedido;
    private $id_producto;
    private $cantidad;
    private $precio_unidad;
    private $nombre;
    private $id_vendedor;

    private $conn;

    public function __construct($conn, $data = null) {
        $this->conn = $conn;

        if ($data) {
            $this->id_pedido = $data['id_pedido'] ?? null;
            $this->id_producto = $data['id_producto'] ?? null;
            $this->cantidad = $data['cantidad'] ?? null;
            $this->precio_unidad = $data['precio_unidad'] ?? null;
            $this->nombre = $data['nombre'] ?? null;
            $this->id_vendedor = $data['id_vendedor'] ?? null;
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

    public function getNombre() {
        return $this->nombre;
    }   

    public function getIdVendedor() {
        return $this->id_vendedor;
    }

    public function agregarDetalle($id_pedido, $id_producto, $cantidad, $precio_unidad, $nombre, $id_vendedor) {
        $query = "INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio_unidad, nombre, id_vendedor) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiidsi", $id_pedido, $id_producto, $cantidad, $precio_unidad, $nombre, $id_vendedor);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error BD ({$this->conn->errno}): {$this->conn->error}");
            return false;
        }
    }

    public function eliminarDetallePedido($id_pedido) {
        $query = "DELETE FROM detalles_pedido WHERE id_pedido = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_pedido);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error BD ({$this->conn->errno}): {$this->conn->error}");
            return false;
        }
    }

    public function obtenerProductosVendidosPorVendedor($id_vendedor) {
        $query = "SELECT dp.id_pedido, dp.nombre, dp.cantidad, dp.precio_unidad 
                  FROM detalles_pedido dp
                  WHERE dp.id_vendedor = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_vendedor);
        $stmt->execute();
        $result = $stmt->get_result();

        $productosVendidos = [];
        while ($row = $result->fetch_assoc()) {
            $productosVendidos[] = $row;
        }

        return $productosVendidos;
    }

    public function obtenerTodosLosDetalles() {
        $sql = "SELECT id_pedido, id_producto, cantidad, precio_unidad, nombre, id_vendedor FROM detalles_pedido";
        $result = $this->conn->query($sql);

        $detalles = [];
        while ($fila = $result->fetch_assoc()) {
            $detalles[] = new DetallesPedido($this->conn, $fila);
        }

        return $detalles;
    }
}
?>