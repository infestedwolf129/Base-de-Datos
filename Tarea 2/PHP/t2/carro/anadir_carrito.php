<?php 
session_start();
include '../conex_DB.php';
$id_h = $_POST['id'];
$nom_usuario = $_SESSION['nombre_usuario'];
$id_usuario = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir al carrito</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">       
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include "nav_carrito.php"; ?>

    <!-- verificacion disponibilidad -->
    <div class = "container text-center">
        <?php
        $query = $conn -> query("SELECT * FROM hoteles WHERE id_h = '$id_h'");
        $row = $query->fetch_assoc();
        $query2 = $conn -> query("SELECT * FROM carrito WHERE id_usuario = '$id_usuario' AND nom_articulo = '$row[nombre_h]'");
        $row2 = $query2->fetch_assoc();
            if ( $row['habitaciones_d'] > 0){
                if($row2 != null){
                    $cantidad = $row2['cantidad'] + 1;
                    $conn->query("UPDATE carrito SET cantidad = '$cantidad' WHERE id_usuario = '$id_usuario' AND nom_articulo = '$row[nombre_h]'");
                    echo "Se ha añadido al carrito";
                }
                else{
                    echo "Se ha añadido al carrito";
                    $conn->query("INSERT INTO carrito (id_usuario, nom_articulo , precio, cantidad, tipo_compra) VALUES ('$id_usuario', '$row[nombre_h]', '$row[precio_h]', 1, 'hotel')");
                }
            }
            else{
                echo "No hay disponibilidad por el momento, por favor intente mas tarde o escoja otro hotel";
            }
        ?>
    </div>
    <a type = "button" class="btn btn-outline-primary" href="../carro/carrito.php" >Ver Carrito</a>
    <?php echo "<a type = 'button' class='btn btn-outline-primary' href='../hoteles/hotel.php?id=$id_h'>Volver al hotel</a><br>'"; ?>
</body>
</html>