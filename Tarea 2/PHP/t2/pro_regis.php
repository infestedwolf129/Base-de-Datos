<!DOCTYPE html>
<html>
<?php
    session_start();
    include "conex_DB.php";

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    $sqlrevision = "SELECT * FROM usuarios WHERE nombre_usuario='$nombre'";
    $resultado = mysqli_query($conn, $sqlrevision);

    if(mysqli_num_rows($resultado) >= 1) {
        header("Location: registro.php?=Nombre_de_usuario_ya_ocupado");
    } else{ 
        $sql = "INSERT INTO usuarios (nombre_usuario, email, contrasena, fecha_nacimiento) VALUES ('$nombre', '$email', '$contrasena', '$fecha_nacimiento')";
        if ($conn->query($sql) === TRUE) {
            echo '<p>Registro exitoso. Bienvenido, ';echo $nombre ;echo '!</p>';
        } else {
            echo "Error al registrar el usuario: ";
        }
    }
?>
<a href="index.php">Iniciar sesion <br></a>
</html>
