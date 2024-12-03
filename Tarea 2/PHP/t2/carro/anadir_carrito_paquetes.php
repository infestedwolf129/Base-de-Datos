<?php 
session_start();
include '../conex_DB.php';
$id_p = $_POST['id_p'];
$nom_usuario = $_SESSION['nombre_usuario'];
$id_usuario = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">
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

    <!-- verificamos disponibilidad -->
    <div class="container text-center">
        <?php
        #Recuperamos todos los datos del paquete para añadir al carrito
        $paquete = $conn -> query("SELECT * FROM paquetes WHERE id_p = '$id_p'");
        $resultado = mysqli_fetch_array($paquete);
        $carrito = $conn -> query("SELECT * FROM carrito WHERE id_usuario = '$id_usuario' AND nom_articulo = '$resultado[nom_paquete]'");
        $resultado2 = mysqli_fetch_array($carrito);

        if ( $resultado['paq_disponibles'] > 0){
            if($resultado2 != null){
                $cantidad = $row2['cantidad'] + 1;
                $conn->query("UPDATE carrito SET cantidad = '$cantidad' WHERE id_usuario = '$id_usuario' AND nom_articulo = '$resultado[nom_paquete]'");
                echo "Se ha añadido al carrito";
            }
            else{
                echo "Se ha añadido al carrito";
                $conn->query("INSERT INTO carrito (id_usuario, nom_articulo , precio, cantidad, personas, tipo_compra) VALUES ('$id_usuario', '$resultado[nom_paquete]', '$resultado[precio_pers]', 1, 1, 'paquete')");
            }
        }
        else{
            echo "No hay disponibilidad por el momento, por favor intente mas tarde o escoja otro paquete";
        }

        ?>
    </div>
    <?php echo "<a type = 'button' class='btn btn-outline-primary' href='../hoteles/paquete.php?id=$id_p'>Volver al paquete</a><br>'"; ?>
</body>
</html>