<?php
session_start();
require './mysql/conexion.php';

$nombre = $contraseña = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = test_input($_POST["nombre"]);
    $contraseña = test_input($_POST["contraseña"]);
    
    $stmt = $conn->prepare("SELECT id_usuario, nombre, contraseña, tipo_usuario FROM usuarios WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $nombre, $hashed_contraseña, $tipo_usuario);
        $stmt->fetch();

        if (password_verify($contraseña, $hashed_contraseña)) {
            $_SESSION["login"] = true;
            $_SESSION["id_usuario"] = $id_usuario;
            $_SESSION["nombre"] = $nombre;//aqui pilla el email y ns por q
            
            if ($tipo_usuario == "admin") {
                $_SESSION["esAdmin"] = true;
                header("Location: admin.php");
                exit();
            } else {
                $_SESSION["usuario"] = true;
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION["login"] = false;
            echo "<p>Error: contraseña incorrecta.</p>";
            echo "<a href='login.php'>Volver a intentar</a>";
        }
    } else {
        $_SESSION["login"] = false;
        echo "<p>Error: El usuario no existe.</p>";
        echo "<a href='login.php'>Volver a intentar</a>";
    }

    $stmt->close();
    $conn->close();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
