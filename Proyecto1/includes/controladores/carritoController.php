    <?php
    // Iniciar sesión
    /*
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }*/

    require_once 'includes/modelos/producto.php';

    class CarritoController {
        private $producto;

        public function __construct() {
            global $conn;
            $this->producto = new Producto($conn);

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }
        }

        // Agregar un producto al carrito
        public function agregarProducto($id_producto) {
            // Verificar si el producto existe en la base de datos
            
            $producto = $this->producto->obtenerProductoPorId($id_producto);
            //$stmt->bind_param("i", $id_producto);
            //$stmt->execute();
            //$result = $stmt->get_result();
            //$producto = $result->fetch_assoc();
            if ($producto) {
                // Si el producto ya está en el carrito, aumentar cantidad
                if (isset($_SESSION['carrito'][$id_producto])) {
                    $_SESSION['carrito'][$id_producto]['cantidad']++;
                } else {
                    // Agregar producto al carrito
                    $_SESSION['carrito'][$id_producto] = [
                        'nombre' => $producto['nombre'],
                        'precio' => $producto['precio'],
                        'imagen' => $producto['imagen'],
                        'cantidad' => 1
                    ];
                }
            }

            header("Location: carrito.php");
            exit();
        }

        // Eliminar un producto del carrito
        public function eliminarProducto($id_producto) {
            unset($_SESSION['carrito'][$id_producto]);
        }

        // Vaciar el carrito
        public function vaciarCarrito() {
            var_dump("hola hola");
            unset($_SESSION['carrito']);
        }

        // Calcular el total del carrito
        public function calcularTotal() {
            $total = 0;
            if (!empty($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $producto) {
                    $total += $producto['precio'] * $producto['cantidad'];
                }
            }
            return $total;
        }
            /*
        // Mostrar la vista del carrito
        public function mostrarCarrito() {
            $total = $this->calcularTotal();
            include 'includes/vistas/comun/header.php';
            ?>
            <main class="carrito-container">
                <h2>Carrito de Compras</h2>

                <?php if (empty($_SESSION['carrito'])): ?>
                    <p>Tu carrito está vacío.</p>
                <?php else: ?>
                    <table>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                        <?php $total = 0; ?>
                        <?php foreach ($_SESSION['carrito'] as $id => $producto): ?>
                            <tr>
                                <td><img src="img/productos/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" class="carrito-img"></td>
                                <td><?php echo $producto['nombre']; ?></td>
                                <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                                <td><?php echo $producto['cantidad']; ?></td>
                                <td>$<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                                <td>
                                    <a href="carrito.php?action=remove&remove=<?php echo $id; ?>" class="btn">Eliminar</a>
                                </td>
                            </tr>
                            <?php $total += $producto['precio'] * $producto['cantidad']; ?>
                        <?php endforeach; ?>
                    </table>
                    <h3>Total: $<?php echo number_format($total, 2); ?></h3>
                    <a href="carrito.php?action=clear" class="btn">Vaciar Carrito</a>
                    <a href="checkout.php" class="btn">Finalizar Compra</a>
                <?php endif; ?>
            </main>
            <?php
        }*/
        /*
        // Control de las acciones del carrito
        public function manejarAcciones() {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add':
                        if (isset($_GET['add']) && is_numeric($_GET['add'])) {
                            $id_producto = $_GET['add'];
                            $this->agregarProducto($id_producto);
                        }
                        break;
                    case 'remove':
                        if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
                            $id_producto = $_GET['remove'];
                            $this->eliminarProducto($id_producto);
                        }
                        break;
                    case 'clear':
                        $this->vaciarCarrito();
                        break;
                    default:
                        $this->mostrarCarrito();
                        break;
                }
            } else {
                $this->mostrarCarrito();
            }

            header("Location: carrito.php");
            exit();
        }*/
    }

    $carrito = new CarritoController($conn);
    //$carrito->manejarAcciones();
    ?>
