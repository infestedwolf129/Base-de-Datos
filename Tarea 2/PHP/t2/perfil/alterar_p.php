<?php
session_start();
include "../conex_DB.php";

$nombre_a = $_POST['nombre_a'];
$contrasena_a = $_POST['contrasena_a'];
$email_a = $_POST['email_a'];
$fecha_nacimiento_a = $_POST['fecha_nacimiento_a'];

$reeamplazo = $_SESSION['nombre_usuario'];

if(empty($nombre_a) == false) {
    $sql = "UPDATE usuarios SET nombre_usuario = '$nombre_a' WHERE nombre_usuario='$reeamplazo'";
    mysqli_query($conn, $sql);
    $_SESSION['nombre_usuario'] = $nombre_a;
    $reeamplazo = $_SESSION['nombre_usuario'];
}

if(empty($contrasena_a) == false) {
    $sql = "UPDATE usuarios SET contrasena = '$contrasena_a' WHERE nombre_usuario='$reeamplazo'";
    mysqli_query($conn, $sql);
    $_SESSION['contrasena'] = $contrasena_a;
}

if(empty($email_a) == false) {
    $sql = "UPDATE usuarios SET email = '$email_a' WHERE nombre_usuario='$reeamplazo'";
    mysqli_query($conn, $sql);
    $_SESSION['email'] = $email_a;
}

if(empty($fecha_nacimiento_a) == false) {
    $sql = "UPDATE usuarios SET fecha_nacimiento = '$fecha_nacimiento_a' WHERE nombre_usuario='$reeamplazo'";
    mysqli_query($conn, $sql);
    $_SESSION['fechB'] = $fecha_nacimiento_a;
}

header("Location: ../home.php");