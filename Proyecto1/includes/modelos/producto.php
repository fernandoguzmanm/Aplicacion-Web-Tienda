<?php
//require_once __DIR__ . '/../config/database.php';
//include '/../mysql/conexion.php';
require_once 'includes/mysql/conexion.php';

class Producto {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerProductos() {
        $sql = "SELECT id_producto, nombre, precio, imagen, descripcion, stock FROM productos";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function buscarProductos($query, $categoria) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE ?";
        $params = ["%$query%"];

        if (!empty($categoria)) {
            $sql .= " AND descripcion = ?";
            $params[] = $categoria;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(str_repeat("s", count($params)), ...$params);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerProductoPorId($id_producto) {
        $stmt = $this->conn->prepare("SELECT id_producto, nombre, precio, imagen FROM productos WHERE id_producto = ?");
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>