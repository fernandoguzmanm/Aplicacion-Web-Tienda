<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir configuración y controladores
require_once './includes/config.php';

$controladores = [
    'tienda' => 'tiendaController',
    'detalles' => 'detallesController',
    'bocetos' => 'bocetosController',
    'miembros' => 'miembrosController',
    'planificacion' => 'planificacionController',
    'busqueda' => 'busquedaController',
    'carrito' => 'carritoController',
    'detalle' => 'detalleProductoController',
    'vendedor' => 'vendedorController',
    'admin' => 'adminController',
    'logout' => 'logoutlogica',
    'checkout' => 'checkoutController',
];

// Obtener controlador y acción desde la URL
$controlador = isset($_GET['controller']) ? $_GET['controller'] : 'tienda';
$accion = isset($_GET['action']) ? $_GET['action'] : 'mostrarTienda';

// Validar si el controlador existe
if (!array_key_exists($controlador, $controladores)) {
    die('Error: Controlador no encontrado');
}

// Incluir el archivo del controlador
$controladorClase = $controladores[$controlador];
$controladorArchivo = RUTA_CONTROLADORES . $controladorClase . '.php'; // Respetar el formato exacto

if (!file_exists($controladorArchivo)) {
    die('Error: Archivo del controlador no encontrado en ' . $controladorArchivo);
}

require_once $controladorArchivo;

// Instanciar el controlador
if (!class_exists($controladorClase)) {
    die('Error: Clase del controlador no encontrada');
}

$controller = new $controladorClase();

// Validar acciones específicas para algunos controladores

if ($controlador === 'carrito') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'eliminarProducto':
                if (isset($_GET['id'])) {
                    $cantidad = isset($_GET['numero_unidades']) ? intval($_GET['numero_unidades']) : 1;
                    $controller->eliminarProducto($_GET['id'], $cantidad);
                }
                header("Location: carrito.php");
                exit();
            case 'vaciarCarrito':
                $controller->vaciarCarrito();
                header("Location: carrito.php");
                exit();
            case 'añadirProducto':
                if (isset($_GET['id'])) {
                    $cantidad = isset($_GET['numero_unidades']) ? intval($_GET['numero_unidades']) : 1;
                    $controller->añadirProducto($_GET['id'], $cantidad);
                }
                header("Location: carrito.php");
                exit();
        }
    }
    header("Location: carrito.php");
    exit();
}

if ($controlador === 'vendedor') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'mostrarVendedor':
                $controller->mostrarVendedor();
                exit();
            case 'eliminarStock':
                if (isset($_GET['id'])) {
                    $cantidad = isset($_GET['numero_unidades']) ? intval($_GET['numero_unidades']) : 1;
                    $controller->eliminarStock($_GET['id'], $cantidad);
                }
                header("Location: index.php");
                exit();
            case 'añadirStock':
                if (isset($_GET['id'])) {
                    $cantidad = isset($_GET['numero_unidades']) ? intval($_GET['numero_unidades']) : 1;
                    $controller->añadirStock($_GET['id'], $cantidad);
                }
                header("Location: index.php");
                exit();
            case 'modificarProducto':
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $controller->modificarProducto($_GET['id']);
                    exit();
                }
        }
    }
    header("Location: vendedor.php");
    exit();
}

if ($controlador === 'admin') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'mostrarAdmin':
                $controller->mostrarAdmin();
                exit();

            case 'gestionarUsuarios':
                $controller->gestionarUsuarios();
                exit();

            case 'gestionarProductos':
                $controller->gestionarProductos();
                exit();

            case 'gestionarPedidos':
                $controller->gestionarPedidos();
                exit();
            
            case 'gestionarCategorias':
                $controller->gestionarCategorias();
                exit();

            case 'eliminarUsuario':
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $controller->eliminarUsuario($_GET['id']);
                }
                header("Location: controller.php?controller=admin&action=gestionarUsuarios");
                exit();

            case 'modificarUsuario':
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $controller->modificarUsuario($_GET['id']);  
                    exit();
                }

            case 'eliminarProducto':
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $controller->eliminarProducto($_GET['id']);
                }
                header("Location: controller.php?controller=admin&action=gestionarProductos");
                exit();

            case 'cambiarEstadoPedido':
                $controller->cambiarEstadoPedido($_POST['id_pedido'], $_POST['nuevo_estado']);
                header("Location: controller.php?controller=admin&action=gestionarPedidos");
                exit();
            
            case 'modificarProducto':
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $controller->modificarProducto($_GET['id']);
                    exit();
                }
            case 'eliminarCategoria':
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $controller->eliminarCategoria($_GET['id']);
                }
                header("Location: controller.php?controller=admin&action=gestionarCategorias");
                exit();
            
            case 'modificarCategoria':
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $controller->modificarCategoria($_GET['id']);
                    exit();
                }
                header("Location: controller.php?controller=admin&action=gestionarCategorias");
                exit();

            default:
                die('Error: Acción no válida para el administrador.');
        }
    }
    header("Location: admin.php");
    exit();
}

if ($controlador === 'detalle') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $controller->mostrarDetalle($_GET['id']);
        exit();
    } else {
        header("Location: tienda.php");
        exit();
    }
}

if ($controlador === 'usuario') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'modificarUsuario':
                if (isset($_POST['id_usuario']) && $_POST['id_usuario'] == $_SESSION['id_usuario']) {
                    $controller->modificarUsuario($_POST['id_usuario']);
                } else {
                    die('Error: No tienes permiso para modificar este usuario.');
                }
                exit();
        }
    }
}

// Validar si la acción existe en el controlador
if (!method_exists($controller, $accion)) {
    die('Error: Acción no encontrada');
}

// Ejecutar la acción
$controller->$accion();
?>
