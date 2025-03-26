<?php
require_once './includes/controladores/tiendaController.php';
require_once './includes/controladores/detallesController.php';
require_once './includes/controladores/bocetosController.php';
require_once './includes/controladores/miembrosController.php';
require_once './includes/controladores/planificacionController.php';
require_once './includes/controladores/busquedaController.php';
require_once './includes/controladores/carritoController.php';

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
        break;
    case 'add':
        // Aquí gestionamos la acción add para agregar al carrito
        if (isset($_GET['add']) && is_numeric($_GET['add'])) {
            // Verificar si la clase CarritoController está bien implementada
            $carritoController = new CarritoController();
            $carritoController->agregarProducto($_GET['add']);
        }
        exit();
    case 'vaciarCarrito':
        $carritoController = new CarritoController();
        $carritoController->vaciarCarrito();
        header("Location: carrito.php");
        exit();
    default:
        die('Error: Controlador no encontrado');
}

if (!method_exists($controller, $accion)) {
    die('Error: Acción no encontrada');
}

$controller->$accion();
?>
