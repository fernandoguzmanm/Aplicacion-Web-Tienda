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
}
?>