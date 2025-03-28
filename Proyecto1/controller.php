<?php
require_once './includes/controladores/tiendaController.php';
require_once './includes/controladores/detallesController.php';
require_once './includes/controladores/bocetosController.php';
require_once './includes/controladores/miembrosController.php';
require_once './includes/controladores/planificacionController.php';
require_once './includes/controladores/busquedaController.php';
require_once './includes/controladores/carritoController.php';
require_once './includes/controladores/detalleProductoController.php';

$controlador = isset($_GET['controller']) ? $_GET['controller'] : 'tienda';
$accion = isset($_GET['action']) ? $_GET['action'] : 'mostrarTienda';

switch ($controlador) {
    case 'tienda':
        $controller = new TiendaController();
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
            $controller->eliminarProducto($_GET['id']);
        }
        else if (isset($_GET['action']) && $_GET['action'] == 'vaciarCarrito' && isset($_GET['id'])) {
            $controller->vaciarCarrio();
        }
        break;
    case 'add':
        if (isset($_GET['add']) && is_numeric($_GET['add'])) {
            $carritoController = new CarritoController();
            $carritoController->añadirProducto($_GET['add']);
        }
        header("Location: carrito.php");
        exit();
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
