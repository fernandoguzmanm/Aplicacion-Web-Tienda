<?php
require_once RUTA_MYSQL . 'conexion.php';
/**
 * Clase que mantiene el estado global de la aplicación.
 */

class Aplicacion
{
    private static $instance;
    private $conn;

    /**
     * Devuelve una instancia de {@see Aplicacion}.
     * 
     * @return Aplicacion Obtiene la única instancia de la <code>Aplicacion</code>
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Aplicacion();
        }
        return self::$instance;
    }

    /**
     * @var array Almacena los datos de configuración de la BD
     */
    private $bdDatosConexion;

    /**
     * Almacena si la Aplicacion ya ha sido inicializada.
     * 
     * @var boolean
     */
    private $inicializada = false;

    /**
     * Evita que se pueda instanciar la clase directamente.
     */
    private function __construct()
    {
        $this->conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        if ($this->conn->connect_error) {
            die("Error de conexión a la base de datos: " . $this->conn->connect_error);
        }
    }

    /**
     * Inicializa la aplicación.
     *
     * @param array $bdDatosConexion Datos de configuración de la BD
     */
    public function init($bdDatosConexion)
    {
        if (!$this->inicializada) {
            $this->bdDatosConexion = $bdDatosConexion;
            $this->inicializada = true;

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    /**
     * Cierre de la aplicación.
     */
    public function shutdown()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    /**
     * Comprueba si la aplicación está inicializada. Si no lo está, muestra un mensaje y termina la ejecución.
     */
    private function compruebaInstanciaInicializada()
    {
        if (!$this->inicializada) {
            echo "Error: La aplicación no ha sido inicializada correctamente.";
            exit();
        }
    }

    /**
     * Devuelve una conexión a la BD. Se asegura de que exista como mucho una conexión a la BD por petición.
     * 
     * @return \mysqli Conexión a MySQL.
     */
    public function getConexionBd()
    {   
        return $this->conn;
    }
}