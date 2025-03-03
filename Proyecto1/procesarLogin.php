<?php
session_start();

// Define variables and set to empty values
$user = $pwd = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = test_input($_POST["user"]);
    $pwd = test_input($_POST["pwd"]);

    if ($user == "user" && $pwd == "userpass") {
        $_SESSION["login"] = true;
        $_SESSION["nombre"] = "Usuario";
        header("Location: contenido.php");
        exit();
    } elseif ($user == "admin" && $pwd == "adminpass") {
        $_SESSION["login"] = true;
        $_SESSION["nombre"] = "Administrador";
        $_SESSION["esAdmin"] = true;
        header("Location: admin.php");
        exit();
    } else {
        $_SESSION["login"] = false;
        echo "<p>Error: Usuario o contraseña incorrectos.</p>";
        echo "<a href='login.php'>Volver a intentar</a>";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>