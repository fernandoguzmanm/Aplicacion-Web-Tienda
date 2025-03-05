<?php
require './mysql/conexion.php'; // Archivo de conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = uniqid(); // Generar un ID único
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    //$password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Cifrar contraseña
    $password = trim($_POST["password"]);
    $tipo_usuario = "cliente"; // Por defecto, el usuario es cliente
    $puntis_fidelidad = 0; // Inicia con 0 puntos de fidelidad

    // Verificar si el usuario ya existe
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
        // Insertar usuario en la BD
        $stmt = $conn->prepare("INSERT INTO usuarios (id_usuario, nombre, email, contraseña, tipo_usuario, puntis_fidelidad) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $id_usuario, $nombre, $email, $password, $tipo_usuario, $puntis_fidelidad);

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

