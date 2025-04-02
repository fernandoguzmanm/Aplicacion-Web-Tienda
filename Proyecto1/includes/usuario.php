<?php
require_once './includes/config.php';
require_once __DIR__ . '/aplicacion.php';
//require_once RUTA_INCLUDES . 'aplicacion.php';

class Usuario
{
    public const ADMIN_ROLE = 1;
    public const USER_ROLE = 2;
    public const VENDEDOR_ROLE = 3;

    public static function login($correo, $password)
    {   
        $usuario = self::buscaUsuario($correo);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }
    
    public static function crea($correo, $password, $nombre)
    {
        $user = new Usuario(null, $nombre, $correo, self::hashPassword($password), "cliente", 0);
        return $user->guarda();
    }

    public static function buscaUsuario($correo)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        var_dump("aaaaa");
        $query = sprintf("SELECT * FROM Usuarios U WHERE email='%s'", $conn->real_escape_string($correo));
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
        $query = sprintf("SELECT * FROM Usuarios WHERE id=%d", $idUsuario);
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
    
    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private static function cargaRoles($usuario) //esto no se si deberia ser diferente
     {
         /*
         $roles=[];
             
         $conn = Aplicacion::getInstance()->getConexionBd();
         $query = sprintf("SELECT RU.rol FROM RolesUsuario RU WHERE RU.usuario=%d"
             , $usuario->id
         );
         $rs = $conn->query($query);
         if ($rs) {
             $roles = $rs->fetch_all(MYSQLI_ASSOC);
             $rs->free();
 
             $usuario->roles = [];
             foreach($roles as $rol) {
                 $usuario->roles[] = $rol['rol'];
             }
             return $usuario;
 
         } else {
             error_log("Error BD ({$conn->errno}): {$conn->error}");
         }
         return false;*/
         if ($usuario->tipo_usuario == "admin") {
             $_SESSION["esAdmin"] = true;
             header("Location: admin.php");
             exit();
         } else if ($usuario->tipo_usuario == "vendedor") {
             $_SESSION["vendedor"] = true;
             header("Location: login.php");
             exit();
         }
         else {
             $_SESSION["usuario"] = true;
             $_SESSION["cliente"] = true;
             //header("Location: login.php");
             //exit();
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
            "UPDATE Usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s' WHERE U.id=%d",
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