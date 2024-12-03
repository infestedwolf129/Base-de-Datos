<?php
session_start();
$id_w = $_GET["id"];  
include "../conex_DB.php";

$borrar = $_SESSION['nombre_usuario'];


$sql = "DELETE FROM wishlists WHERE id_wish='$id_w'";
mysqli_query($conn, $sql);

header("Location: wishlist.php");
?>