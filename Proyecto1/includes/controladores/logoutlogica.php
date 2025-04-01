<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$sesionIniciada = isset($_SESSION["login"]);

session_destroy();

header("Location: /AW/Proyecto1/logout.php?sesion=" . ($sesionIniciada ? "true" : "false"));
exit();
