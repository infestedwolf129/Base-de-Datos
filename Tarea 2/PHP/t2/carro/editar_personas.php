<?php 
session_start();
include '../conex_DB.php';
$nom_usuario = $_SESSION['nombre_usuario'];
$id_usuario = $_SESSION['id'];
?>
<?php include 'diseño.php'; ?>
<?php

// Obtener el id de compra y la cantidad

$nom_compra = $_POST['nom_compra'];
$personas = $_POST['personas_act'];
$new_pers = $_POST['new_personas'];
$cantidad = $_POST['cantidad'];
$personas_max = $_POST['max_personas'];

// Actualizar la cantidad de la compra y la cantidad de habitaciones disponibles

if($new_pers > ($personas_max* $cantidad)){
    echo "Ha intentado agregar más personas de las que dispone, usted puede agregar " . $personas_max*$cantidad . " personas como maximo.";

    // Redirigir a otro archivo después de 5 segundos
    header("Refresh: 30; url=carrito.php");

    // Mostrar un mensaje antes de la redirección
    echo "<br>Si no has sido redirigido aun haz clic <a href='carrito.php'>aquí</a>.</br>";

    // Cerrar la ejecución del script
    exit();

}else{
    $conn -> query("UPDATE carrito SET personas = '$new_pers' WHERE nom_articulo = '$nom_compra' AND id_usuario = '$id_usuario'");
    // Redirigir a otro archivo después de 5 segundos
    header("Refresh: 30; url=carrito.php");

    // Mostrar un mensaje antes de la redirección
    echo "Se ha actualizado tu carrito, si no has sido redirigido aun haz clic <a href='carrito.php'>aquí</a>.";

    // Cerrar la ejecución del script
    exit();

}
?>

