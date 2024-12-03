<?php
    $server= "localhost";
    $username = "root";
    $password = "";
    $database = "prestigetravels";

    try {
        $conn = mysqli_connect($server, $username, $password, $database);
    } catch (PDOException $e) {
        die('Connection Failed: ' . $e->getMessage());
    }

    $records = $conn->prepare('CREATE TABLE IF NOT EXISTS usuarios (id INT AUTO_INCREMENT PRIMARY KEY , nombre_usuario VARCHAR(50), email VARCHAR(50), contrasena VARCHAR(50), fecha_nacimiento date);');
    $records->execute();
?>