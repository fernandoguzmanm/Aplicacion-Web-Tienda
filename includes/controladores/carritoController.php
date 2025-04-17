<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once RUTA_INCLUDES . 'producto.php';

class CarritoController {
    private $producto;

    public function __construct() {
        global $conn;
        $this->producto = new Producto($conn);
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }
    
    public function añadirProducto($id_producto, $cantidad) {
        $producto = $this->producto->obtenerProductoPorId($id_producto);
        if ($producto && $cantidad <= $producto['stock']) {
            $this->producto->reducirStock($id_producto, $cantidad);
            if (isset($_SESSION['carrito'][$id_producto])) {
                $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
            } else {
                $_SESSION['carrito'][$id_producto] = [
                    'id_producto' => $id_producto, 
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'imagen' => $producto['imagen'],
                    'cantidad' => $cantidad
                ];
            }
        }
    }

    public function eliminarProducto($id_producto, $cantidad) {
        $producto = $this->producto->obtenerProductoPorId($id_producto);
        if ($producto) {
            if ($cantidad > $_SESSION['carrito'][$id_producto]['cantidad']) {
                $cantidad = $_SESSION['carrito'][$id_producto]['cantidad'];
            }
            $this->producto->aumentarStock($id_producto, $cantidad);
            $_SESSION['carrito'][$id_producto]['cantidad'] -= $cantidad;
            
            if ($_SESSION['carrito'][$id_producto]['cantidad'] <= 0) {
                unset($_SESSION['carrito'][$id_producto]);
            }
        }
    }

    public function vaciarCarrito() {
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $id_producto => $producto) {
                $this->producto->aumentarStock($id_producto, $producto['cantidad']);
            }
        }
    
        $_SESSION['carrito'] = [];
        header("Location: " . RUTA_APP . "carrito.php");
        exit();
    }

    public function calcularTotal() {
        $total = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $producto) {
                $total += $producto['precio'] * $producto['cantidad'];
            }
        }
        return $total;
    }
        
    public function mostrarCarrito() {
        $total = $this->calcularTotal();
        include RUTA_VISTAS . 'comun/header.php';
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
                    <?php foreach ($_SESSION['carrito'] as $id => $producto): ?>
                        <tr>
                            <td><img src="<?= RUTA_IMG . 'productos/' . $producto['imagen']; ?>" alt="<?= $producto['nombre']; ?>" class="carrito-img"></td>
                            <td><?= $producto['nombre']; ?></td>
                            <td>$<?= number_format($producto['precio'], 2); ?></td>
                            <td><?= $producto['cantidad']; ?></td>
                            <td>$<?= number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                            <td>
                                <a href="<?= RUTA_APP . "carrito.php?action=remove&remove=$id"; ?>" class="btn">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <h3>Total: $<?= number_format($total, 2); ?></h3>
                <a href="<?= RUTA_APP . "carrito.php?action=clear"; ?>" class="btn">Vaciar Carrito</a>
                <a href="<?php echo RUTA_APP . 'controller.php?controller=checkout&action=mostrarCheckout'; ?>" class="btn">Finalizar Compra</a>
                <?php endif; ?>
        </main>
        <?php
    }
}

$carrito = new CarritoController($conn);
?>