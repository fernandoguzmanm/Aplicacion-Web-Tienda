<?php
session_start(); // Iniciar sesión para detectar si el usuario ha iniciado sesión
$page_title = basename($_SERVER['PHP_SELF'], ".php");
?>

<header>
    <div class="header-container">
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

        <div id="login-container">
            <?php
            if (isset($_SESSION['usuario'])) {
                echo "<p>Bienvenido, " . $_SESSION['usuario'] . " | <a href='logout.php'>Cerrar sesión</a></p>";
            } else {
                echo "<p><a href='login.php'>Iniciar sesión</a></p>";
            }
            ?>
        </div>
    </div>
</header>

<style>
    header {
        background-color: #007BFF;
        color: white;
        padding: 10px 20px;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    h1 {
        margin: 0;
    }

    nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
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

    #login-container {
        text-align: right;
    }

    #login-container a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    #login-container a:hover {
        text-decoration: underline;
    }
</style>
