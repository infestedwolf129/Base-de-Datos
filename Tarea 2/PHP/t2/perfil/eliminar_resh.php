<?php
session_start();
$id_ch = $_GET["id"];  
include "../conex_DB.php";

$id_h = $_GET["id_h"]; 


$sql = "DELETE FROM calificaciones_h WHERE id_ch='$id_ch' ";
mysqli_query($conn, $sql);

$sql = "SELECT * FROM calificaciones_h WHERE id_h='$id_h'";
$resultado = mysqli_query($conn, $sql);
$punt = 0;
$contador = 0;
while ($fila = mysqli_fetch_assoc($resultado)){
    $punt = ($punt + $fila['promedio']);
    $contador = $contador + 1;
}
$punt = round(($punt/$contador),2);
$sqlupdate = "UPDATE wishlists SET punt = '$punt' WHERE id_ph = '$id_h' AND hotel = 1";
mysqli_query($conn, $sqlupdate);

header("Location: info_usuario.php");
?>