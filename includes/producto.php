<?php
//
//  // Usar la constante RUTA_MYSQL para incluir la conexión a la base de datos
require_once './includes/config.php';
require_once __DIR__ . '/aplicacion.php';

class Producto {
    private $id_producto;
    private $nombre;
    private $precio;
    private $imagen;
    private $descripcion;
    private $stock;

    private $conn;

    public function __construct($conn, $data = null) {
        $this->conn = $conn;

        if ($data) {
            $this->id_producto = $data['id_producto'] ?? null;
            $this->nombre = $data['nombre'] ?? null;
            $this->precio = $data['precio'] ?? null;
            $this->imagen = $data['imagen'] ?? null;
            $this->descripcion = $data['descripcion'] ?? null;
            $this->stock = $data['stock'] ?? null;
        }
    }

    public function getIdProducto() {
        return $this->id_producto;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getStock() {
        return $this->stock;
    }

    public function obtenerProductos() {
        $sql = "SELECT id_producto, nombre, precio, imagen, descripcion, stock FROM productos";
        $result = $this->conn->query($sql);

        $productos = [];
        while ($fila = $result->fetch_assoc()) {
            $productos[] = new Producto($this->conn, $fila);
        }

        return $productos;
    }

    public function obtenerProductosPorVendedor($id_vendedor) {
        $query = "SELECT id_producto, nombre, precio, imagen, descripcion, stock FROM productos WHERE id_vendedor = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_vendedor);
        $stmt->execute();
        $result = $stmt->get_result();

        $productos = [];
        while ($fila = $result->fetch_assoc()) {
            $productos[] = new Producto($this->conn, $fila);
        }

        $stmt->close();
        return $productos;
    }
    
    public function buscarProductos($query, $categoria = null, $min_precio = null, $max_precio = null) {
        $sql = "SELECT id_producto, nombre, precio, imagen, descripcion, stock FROM productos WHERE nombre LIKE ?";
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

        $productos = [];
        while ($fila = $result->fetch_assoc()) {
            $productos[] = new Producto($this->conn, $fila);
        }

        $stmt->close();
        return $productos;
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
        $stmt = $this->conn->prepare("UPDATE productos SET stock = stock + ? WHERE id_producto = ?");
        $stmt->bind_param("ii", $cantidad, $id_producto);
        $stmt->execute();
    
        return $stmt->affected_rows > 0;
    }
}
?>