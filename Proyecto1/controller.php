<?php
require_once './includes/config.php'; // Incluir config.php para usar las constantes definidas
require_once RUTA_MYSQL . 'conexion.php';
require_once RUTA_CONTROLADORES . 'tiendaController.php';
require_once RUTA_CONTROLADORES . 'detallesController.php';
require_once RUTA_CONTROLADORES . 'bocetosController.php';
require_once RUTA_CONTROLADORES . 'miembrosController.php';
require_once RUTA_CONTROLADORES . 'planificacionController.php';
require_once RUTA_CONTROLADORES . 'busquedaController.php';
require_once RUTA_CONTROLADORES . 'carritoController.php';
require_once RUTA_CONTROLADORES . 'detalleProductoController.php';
require_once RUTA_CONTROLADORES . 'vendedorController.php';

$controlador = isset($_GET['controller']) ? $_GET['controller'] : 'tienda';
$accion = isset($_GET['action']) ? $_GET['action'] : 'mostrarTienda';

switch ($controlador) {
    case 'tienda':
        $controller = new TiendaController();
        break;
    case 'vendedor':
        $controller = new VendedorController();
        break;
    case 'detalles':
        $controller = new DetallesController();
        break;
    case 'bocetos':
        $controller = new BocetosController();
        break;  
    case 'miembros':
        $controller = new MiembrosController();
        break;
    case 'planificacion':
        $controller = new PlanificacionController();
        break;
    case 'busqueda':
        $controller = new BusquedaController();
        break;
    case 'carrito':
        $controller = new CarritoController();
        if (isset($_GET['action']) && $_GET['action'] == 'eliminarProducto' && isset($_GET['id'])) {
            $cantidad = isset($_GET['numero_unidades']) ? intval($_GET['numero_unidades']) : 1;
            $controller->eliminarProducto($_GET['id'], $cantidad);
        }
        else if (isset($_GET['action']) && $_GET['action'] == 'vaciarCarrito') {
            $controller->vaciarCarrito();
        }
        else if (isset($_GET['action']) && $_GET['action'] == 'añadirProducto' && isset($_GET['id'])) {
            $cantidad = isset($_GET['numero_unidades']) ? intval($_GET['numero_unidades']) : 1;
            $controller->añadirProducto($_GET['id'], $cantidad);
        }
        header("Location: carrito.php");
        break;
    case 'detalle':
        $controller = new DetalleProductoController();
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $controller->mostrarDetalle($_GET['id']);
        } else {
            header("Location: tienda.php");
            exit();
        }
        break;
    default:
        die('Error: Controlador no encontrado');
}

if (!method_exists($controller, $accion)) {
    die('Error: Acción no encontrada');
}

$controller->$accion();
?>