<?php
$page_title = basename($_SERVER['PHP_SELF'], ".php");
?>

<header>
    <h1> <?php echo ucfirst($page_title); ?> </h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="detalles.php">Detalles</a></li>
            <li><a href="bocetos.php">Bocetos</a></li>
            <li><a href="miembros.php">Miembros</a></li>
            <li><a href="planificacion.php">Planificación</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </nav>

    </nav>
    <div id="login-container">
        <p>Por favor, <a href='login.php'>inicia sesión</a> para ver el contenido exclusivo.</p>
    </div>
    
</header>

<style>
    header {
        background-color: #007BFF;
        color: white;
        padding: 10px 0;
        text-align: center;
    }
    nav ul {
        list-style: none;
        padding: 0;
    }
    nav ul li {
        display: inline;
        margin: 0 15px;
    }
    nav ul li a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
    nav ul li a:hover {
        text-decoration: underline;
    }
</style>
