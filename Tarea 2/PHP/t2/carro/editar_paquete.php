<?php 
session_start();
include '../conex_DB.php';
$nom_usuario = $_SESSION['nombre_usuario'];
$id_usuario = $_SESSION['id'];
?>

<?php

// Obtener el id de compra y la cantidad

$nom_compra = $_POST['nom_compra'];
$cant = $_POST['cant_act'];
$new_cant = $_POST['new_cantidad'];

// Actualizar la cantidad de la compra y la cantidad de habitaciones disponibles


$conn -> query("UPDATE carrito SET cantidad = '$new_cant' WHERE nom_articulo = '$nom_compra' AND id_usuario = '$id_usuario'");
if ($new_cant > $cant){
    $conn -> query("UPDATE paquetes SET paq_disponibles = paq_disponibles - '$new_cant' WHERE nom_paquete = '$nom_compra'");
}else if ($new_cant < $cant){
    $conn -> query("UPDATE paquetes SET paq_disponibles = paq_disponibles + '$new_cant' WHERE nom_paquete = '$nom_compra'");
}
?>

<?php include 'diseño.php'; ?>
<?php
// Redirigir a otro archivo después de 5 segundos
header("Refresh: 30; url=carrito.php");

// Mostrar un mensaje antes de la redirección
echo "<h1 class = 'text-center'>Se ha actualizado tu carrito, si no has sido redirigido aun haz clic <a href='carrito.php'>aquí</a></h1>.";

// Cerrar la ejecución del script
exit();
?>