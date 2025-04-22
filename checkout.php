<?php 
//require './includes/config.php';
require_once RUTA_INCLUDES . 'formulariocheckout.php';
$tituloPagina = "Checkout";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true): ?>
    <main class="carrito-container">
        <h2>Acceso Denegado</h2>
        <p>Debes iniciar sesión para acceder al checkout.</p>
        <a href="login.php" class="btn">Iniciar Sesión</a>
    </main>
<?php else:
    $carrito = $_SESSION['carrito'];
    //$total = $checkout->calcularTotal(); // Calcula el total
    ?>

    <main class="carrito-container">
        <h2>Carrito de Compras</h2>

        <?php if (empty($carrito)): ?>
            <p>Tu carrito está vacío.</p>
            <a href="index.php" class="btn">Volver al inicio</a>
        <?php else: ?>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($carrito as $producto): ?>
                    <tr>
                        <td><?= ucfirst(htmlspecialchars($producto['nombre'])); ?></td>
                        <td>$<?= number_format($producto['precio'], 2); ?></td>
                        <td><?= $producto['cantidad']; ?></td>
                        <td>$<?= number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <h3>Total: $<?= number_format($total, 2); ?></h3>
            <a href="controller.php?controller=carrito&action=mostrarCarrito" class="btn">Volver atrás</a>

            <?php
            $form = new formulariocheckout();
            $htmlFormCheckout = $form->gestiona();
            ?>
            <?= $htmlFormCheckout ?>
        <?php endif; ?>
    </main>

<?php endif; ?>

<?php require RUTA_VISTAS . 'plantillas/plantilla2.php'; ?>