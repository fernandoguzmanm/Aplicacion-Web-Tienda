<?php
    $servername = "localhost";
    $username = "rishi";
    $password = "contrasenarishi";
    $db = "tienda";
    // Crear conexion
    $conn = new mysqli($servername, $username, $password, $db);
    // Comprobar conexion
    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
?>