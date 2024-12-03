<?php session_start(); 
include "../conex_DB.php";
$id_u = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar del carrito</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">       
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'nav_carrito.php';?>

    <div>
        <?php
            $nom_articulo = $_GET["nom_articulo"];
            $sql = "DELETE FROM carrito WHERE nom_articulo='$nom_articulo' AND id_usuario='$id_u'";
            $result = mysqli_query($conn,$sql);
            if($result){?>
                <h1>Producto eliminado del carrito</h1>
                <a type = "button" class="btn btn-outline-primary" href="carrito.php" >Volver</a>
            <?php }else{?>
                <h1>Hubo un error</h1>
                <a type = "button" class="btn btn-outline-primary" href="carrito.php">Volver</a>
            <?php
            }
        ?>
    </div>    


    
</body>
</html>