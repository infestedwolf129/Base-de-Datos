<?php
session_start();
$id_cpaq = $_GET["id"];  
include "../conex_DB.php";

$id_p = $_GET["id_p"]; 


$sql = "DELETE FROM calificaciones_p WHERE id_cpaq='$id_cpaq' ";
mysqli_query($conn, $sql);

$sql = "SELECT * FROM calificaciones_p WHERE id_p='$id_p'";
$resultado = mysqli_query($conn, $sql);
$punt = 0;
$contador = 0;
while ($fila = mysqli_fetch_assoc($resultado)){
    $punt = ($punt + $fila['promedio']);
    $contador = $contador + 1;
}
$punt = round(($punt/$contador),2);
$sqlupdate = "UPDATE wishlists SET punt = '$punt' WHERE id_ph = '$id_p' AND paquete = 1";
mysqli_query($conn, $sqlupdate);

header("Location: info_usuario.php");
?>