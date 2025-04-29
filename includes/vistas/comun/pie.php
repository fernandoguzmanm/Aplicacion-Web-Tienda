<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= RUTA_CSS . 'cssHeader.css?v=2' ?>">
</head>

<footer id="footer">
<div class="footer-content">
        <!-- Navegación básica -->
        <nav>
            <ul>
                <li><a href="<?= RUTA_APP . 'contacto.php' ?>">Contacto</a></li>
                <li><a href="<?= RUTA_APP . 'privacidad.php' ?>">Privacidad</a></li>
                <li><a href="<?= RUTA_APP . 'aviso-legal.php' ?>">Aviso Legal</a></li>
            </ul>
        </nav>

        <!-- Redes sociales -->
        <div class="redes-sociales">
            <a href="https://instagram.com/ShopEasy" target="_blank">Instagram</a>
            <a href="https://twitter.com/ShopEasy" target="_blank">Twitter</a>
            <a href="https://facebook.com/ShopEasy" target="_blank">Facebook</a>
        </div>
    </div>

    <!-- Copyright -->
    <div class="copyright">
        <p>&copy; <?= date('Y') ?> ShopEasy. Todos los derechos reservados.</p>
    </div>
</footer>
