<?php
session_start();
require './mysql/conexion.php'; // Archivo de conexión a la base de datos

// Define variables y establece valores vacíos
$nombre = $contraseña = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitar los inputs
    $nombre = test_input($_POST["nombre"]);
    $contraseña = test_input($_POST["contraseña"]);

    // Preparar y ejecutar la consulta para verificar si el usuario existe
    $stmt = $conn->prepare("SELECT id_usuario, email, contraseña, tipo_usuario FROM usuarios WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $stmt->store_result();

    // Comprobar si el usuario existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $nombre, $hashed_contraseña, $tipo_usuario);
        $stmt->fetch();

        // Verificar si la contraseña es correcta
        var_dump($_POST);
        //var_dump($contraseña);
        //var_dump($hashed_contraseña);
        if (password_verify($contraseña, $hashed_contraseña)) {
        //if ($contraseña == $hashed_contraseña) {
            // Iniciar sesión y guardar información
            $_SESSION["login"] = true;
            $_SESSION["id_usuario"] = $id_usuario;
            $_SESSION["nombre"] = $nombre;

            // Redirigir dependiendo del tipo de usuario (cliente o admin)
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

    // Cerrar declaración y conexión
    $stmt->close();
    $conn->close();
}

// Función para sanitizar la entrada
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
