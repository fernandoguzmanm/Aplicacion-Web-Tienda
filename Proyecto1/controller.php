<?php
require_once './includes/mysql/conexion.php';
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
            $cantidad = isset($_GET['numero_unidades']) ? intval($_GET['numero_unidades']) : 1;
            $controller->eliminarProducto($_GET['id'], $cantidad);
        }
        else if (isset($_GET['action']) && $_GET['action'] == 'vaciarCarrito') {
            $controller->vaciarCarrito();
        }
        else if (isset($_GET['action']) && $_GET['action'] == 'añadirProducto' && isset($_GET['id'])) {
            $cantidad = isset($_GET['numero_unidades']) ? intval($_GET['numero_unidades']) : 1;
            $controller->añadirProducto($_GET['id'], $cantidad);
            /*
            $id_producto = $_GET['id'] ?? null;
            $numero_unidades = $_GET['numero_unidades'] ?? 1;

            if ($id_producto) {
                $query = "SELECT stock FROM productos WHERE id_producto = ?";
                $stmt = $db->prepare($query);
                $stmt->bind_param('i', $id_producto);
                $stmt->execute();
                $result = $stmt->get_result();
                $producto = $result->fetch_assoc();

                if ($producto && $producto['stock'] >= $numero_unidades) {
                    // meter al carrito
                    echo "Producto añadido al carrito.";
                } else {
                    echo "Lo sentimos, no hay suficiente stock disponible.";
                }
            } else {
                echo "Producto no válido.";
            }*/
        }
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
