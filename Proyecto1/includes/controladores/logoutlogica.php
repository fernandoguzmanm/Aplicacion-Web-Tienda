<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$sesionIniciada = isset($_SESSION["login"]);

session_destroy();

header("Location: " . RUTA_APP . "logout.php?sesion=" . ($sesionIniciada ? "true" : "false"));
exit();