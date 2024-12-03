<?php 
    session_start();
    include "../conex_DB.php";

    $id_u = $_SESSION['id'];
    $id_h = $_POST['id'];
    $limp = $_POST['limpieza'];
    $serv = $_POST['servicio'];
    $dec = $_POST['decoracion'];
    $cam = $_POST['calidad_ca'];
    $res = $_POST['resena'];
    $promedio = ($limp + $serv + $dec + $cam)/4;

    $sqlentry = "INSERT INTO calificaciones_h (id_u, id_h, limpieza, servicio, decoracion, calidad_ca, resena, promedio) VALUES ('$id_u', '$id_h', '$limp', '$serv', '$dec', '$cam', '$res', '$promedio')";

    $sql = "SELECT * FROM calificaciones_h WHERE id_u='$id_u' AND id_h ='$id_h'";
    $resultado = mysqli_query($conn, $sql);

    if(mysqli_num_rows($resultado) >= 1) {
        $sql = "DELETE FROM calificaciones_h WHERE id_u='$id_u' AND id_h ='$id_h'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sqlentry);

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


    } else{ 
        mysqli_query($conn, $sqlentry);

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
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo "Vista de hoteles"?></title>

        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">       
        <link rel="stylesheet" href="styles.css">

    </head>

    <body>

    <header>
        <!-- navbar-->
        <?php include "nav_hoteles.php" ?>
    </header>

    <h3>Resena completa!</h3>

    <a type = 'button' class='btn btn-outline-primary' href="../home.php">Volver al inicio</a>
    <?php echo "<a type = 'button' class='btn btn-outline-primary' href='hotel.php?id=$id_h'>Volver al hotel</a><br>'"; ?>
    