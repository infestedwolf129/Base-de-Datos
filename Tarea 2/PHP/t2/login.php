<?php
session_start();
include "conex_DB.php";

if(isset($_POST['nomusuario']) && isset($_POST['contra'])){
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$nomusuario = validate($_POST['nomusuario']);
$contra = validate($_POST['contra']);

$sql = "SELECT * FROM usuarios WHERE nombre_usuario='$nomusuario' AND contrasena='$contra'";

$resultado = mysqli_query($conn, $sql);

if(mysqli_num_rows($resultado) === 1) {
    $fila = mysqli_fetch_assoc($resultado);
    if($fila['nombre_usuario'] === $nomusuario && $fila['contrasena'] === $contra){
        echo "Sesion iniciada con exito";
        $_SESSION['nombre_usuario'] = $fila['nombre_usuario'];
        $_SESSION['contrasena'] = $fila['contrasena'];
        $_SESSION['fechB'] = $fila['fecha_nacimiento'];
        $_SESSION['email'] = $fila['email'];
        $_SESSION['id'] = $fila['id'];
        header("Location: home.php");
        exit();
    }
    else{
        header("Location: index.php?error=Contrasena o Nombre de usuario incorrecta");
        exit();
    }
}
else{
    header("Location: index.php?error=Contrasena o Nombre de usuario incorrecta");
    exit();
}
?>