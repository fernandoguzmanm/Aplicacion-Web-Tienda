<?php
require_once './includes/config.php';
require_once __DIR__ . '/aplicacion.php';

class Categoria
{
    private $id_categoria;
    private $nombre;

    private $conn;

    private function __construct($id_categoria, $nombre)
    {
        $this->id_categoria = $id_categoria;
        $this->nombre = $nombre;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public static function buscarPorId($id_categoria)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM categorias WHERE id_categoria = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_categoria);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($fila = $result->fetch_assoc()) {
            return new Categoria($fila['id_categoria'], $fila['nombre']);
        }

        return null;
    }

    public static function crea($nombre)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "INSERT INTO categorias (nombre) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $nombre);

        if ($stmt->execute()) {
            return new Categoria($stmt->insert_id, $nombre);
        } else {
            error_log("Error al crear categoría ({$conn->errno}): {$conn->error}");
            return null;
        }
    }

    public static function obtenerTodas()
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM categorias";
        $result = $conn->query($query);

        $categorias = [];
        if ($result) {
            while ($fila = $result->fetch_assoc()) {
                $categorias[] = new Categoria($fila['id_categoria'], $fila['nombre']);
            }
            $result->free();
        } else {
            error_log("Error al obtener categorías ({$conn->errno}): {$conn->error}");
        }

        return $categorias;
    }

    public static function eliminarCategoria($id_categoria)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "DELETE FROM categorias WHERE id_categoria = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_categoria);

        if ($stmt->execute()) {
            return $stmt->affected_rows > 0;
        } else {
            error_log("Error al eliminar categoría ({$conn->errno}): {$conn->error}");
            return false;
        }
    }

    public static function modificarCategoria($id_categoria, $nombre)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "UPDATE categorias SET nombre = ? WHERE id_categoria = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $nombre, $id_categoria);

        if ($stmt->execute()) {
            return $stmt->affected_rows > 0;
        } else {
            error_log("Error al modificar categoría ({$conn->errno}): {$conn->error}");
            return false;
        }
    }
}