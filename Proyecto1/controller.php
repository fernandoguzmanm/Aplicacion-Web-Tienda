<?php
require_once './includes/controladores/tiendaController.php';
require_once './includes/controladores/detallesController.php';
require_once './includes/controladores/bocetosController.php';
require_once './includes/controladores/miembrosController.php';
require_once './includes/controladores/planificacionController.php';

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
    default:
        die('Error: Controlador no encontrado');
}

if (!method_exists($controller, $accion)) {
    die('Error: Acción no encontrada');
}

$controller->$accion();
?>
