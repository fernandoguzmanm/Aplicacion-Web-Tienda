<?php
require './mysql/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = uniqid();
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $tipo_usuario = "cliente";
    $puntos_fidelidad = 0;

    $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "El usuario ya existe. <a href='registro.php'>Intentar de nuevo</a>";
    } else {
        $stmt = $conn->prepare("INSERT INTO usuarios (id_usuario, nombre, email, contraseña, tipo_usuario, puntos_fidelidad) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $id_usuario, $nombre, $email, $password, $tipo_usuario, $puntos_fidelidad);

        if ($stmt->execute()) {
            echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
        } else {
            echo "Error al registrar.";
        }
    }
    $stmt->close();
    $conn->close();
}
?>

