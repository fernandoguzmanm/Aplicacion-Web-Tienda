<?php
//namespace aw\proyecto1;
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

    public function buscarProductos($query, $categoria, $min_precio = null, $max_precio = null) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE ?";
        $params = ["%$query%"];
        $types = "s";
    
        if (!empty($categoria)) {
            $sql .= " AND descripcion = ?";
            $params[] = $categoria;
            $types .= "s";
        }
    
        if (!is_null($min_precio)) {
            $sql .= " AND precio >= ?";
            $params[] = $min_precio;
            $types .= "d";
        }
    
        if (!is_null($max_precio)) {
            $sql .= " AND precio <= ?";
            $params[] = $max_precio;
            $types .= "d";
        }
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    

    public function obtenerProductoPorId($id_producto) {
        $stmt = $this->conn->prepare("SELECT id_producto, nombre, precio, imagen, descripcion, stock FROM productos WHERE id_producto = ?");
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function reducirStock($id_producto, $cantidad) {
        $stmt = $this->conn->prepare("UPDATE productos SET stock = stock - ? WHERE id_producto = ? AND stock >= ?");
        $stmt->bind_param("iii", $cantidad, $id_producto, $cantidad);
        $stmt->execute();
    
        return $stmt->affected_rows > 0;
    }
    public function aumentarStock($id_producto, $cantidad) {
        $stmt = $this->conn->prepare("UPDATE productos SET stock = stock + ? WHERE id_producto = ? AND stock >= ?");
        $stmt->bind_param("iii", $cantidad, $id_producto, $cantidad);
        $stmt->execute();
    
        return $stmt->affected_rows > 0;
    }
}
?>