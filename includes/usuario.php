<?php
require_once './includes/config.php';
require_once __DIR__ . '/aplicacion.php';
//require_once RUTA_INCLUDES . 'aplicacion.php';

class Usuario
{
    private static $instance = null;
    private $conn;

    public static function getInstance($conn) {
        if (self::$instance === null) {
            self::$instance = new Usuario($conn);
        }
        return self::$instance;
    }
    
    public static function login($correo, $password)
    {   
        $usuario = self::buscaUsuario($correo);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }
    
    public static function crea($correo, $password, $nombre, $tipoUsuario)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $usuario = new Usuario(null, $nombre, $correo, $passwordHash, $tipoUsuario, 0);
        return $usuario->guarda();
    }

    public static function buscaUsuario($correo)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE email='%s'", $conn->real_escape_string($correo));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario($fila['id_usuario'], $fila['nombre'], $fila['email'], $fila['contraseña'], $fila['tipo_usuario'], $fila['puntos_fidelidad']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuarios WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'], $fila['id']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    
    public static function obtenerTodosLosUsuarios() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT id_usuario, nombre, email, tipo_usuario FROM usuarios";
        $result = $conn->query($query);

        $usuarios = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
            $result->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $usuarios;
    }

    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private static function cargaRol($usuario)
    {
         if ($usuario->tipo_usuario == "admin") {
            $_SESSION["rol"] = 'admin';
            exit();
        } else if ($usuario->tipo_usuario == "vendedor") {
            $_SESSION["rol"] = 'vendedor';
            exit();
        } else {
            $_SESSION['rol'] = 'cliente';
            exit();
        }
    }
    
    private static function inserta($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO usuarios (nombre, email, contraseña, tipo_usuario, puntos_fidelidad) VALUES ('%s', '%s', '%s', '%s', '%s')",
            $conn->real_escape_string($usuario->nombre),
            $conn->real_escape_string($usuario->email),
            $conn->real_escape_string($usuario->password),
            $conn->real_escape_string($usuario->tipo_usuario),
            $conn->real_escape_string($usuario->puntos_fidelidad)
        );
        if ($conn->query($query)) {
            $usuario->id = $conn->insert_id;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    private static function actualiza($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "UPDATE usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s' WHERE U.id=%d",
            $conn->real_escape_string($usuario->nombreUsuario),
            $conn->real_escape_string($usuario->nombre),
            $conn->real_escape_string($usuario->password),
            $usuario->id
        );
        if ($conn->query($query)) {
            $result = true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    private static function borraPorId($idUsuario)
    {
        if (!$idUsuario) {
            return false;
        }
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM Usuarios U WHERE U.id = %d", $idUsuario);
        if (!$conn->query($query)) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    private $id_usuario;
    private $nombre;
    private $email;
    private $password;
    private $tipo_usuario;
    private $puntos_fidelidad;

    private function __construct($id_usuario, $nombre, $email, $password, $tipo_usuario, $puntos_fidelidad)
    {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->tipo_usuario = $tipo_usuario;
        $this->puntos_fidelidad = $puntos_fidelidad;
    }

    public function getId()
    {
        return $this->id_usuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }

    public function compruebaPassword($password)
    {
        return (password_verify($password, $this->password) || $password == $this-> password);
    }

    public function guarda()
    {
        if ($this->id_usuario !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }

    public function borrate()
    {
        if ($this->id_usuario !== null) {
            return self::borraPorId($this->id_usuario);
        }
        return false;
    }
}
