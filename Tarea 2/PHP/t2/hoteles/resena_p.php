<?php 
    session_start();
    include "../conex_DB.php";

    $id_u = $_SESSION['id'];
    $id_p = $_POST['id'];
    $cali = $_POST['calidad'];
    $trans = $_POST['trans'];
    $serv = $_POST['servicio'];
    $rel = $_POST['rel_pc'];
    $res = $_POST['resena'];
    $promedio = ($cali + $trans + $serv + $rel)/4;

    $sqlentry = "INSERT INTO calificaciones_p (id_u, id_p, calidad_h, transporte, servicio, relacion_pc, resena, promedio) VALUES ('$id_u', '$id_p', '$cali', '$trans', '$serv', '$rel', '$res', '$promedio')";

    $sql = "SELECT * FROM calificaciones_p WHERE id_u='$id_u' AND id_p ='$id_p'";
    $resultado = mysqli_query($conn, $sql);

    if(mysqli_num_rows($resultado) >= 1) {
        $sql = "DELETE FROM calificaciones_p WHERE id_u='$id_u' AND id_p ='$id_p'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sqlentry);

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

    } else{ 
        mysqli_query($conn, $sqlentry);

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
    <?php echo "<a type = 'button' class='btn btn-outline-primary' href='paquete.php?id=$id_p'>Volver al paquete</a><br>'"; ?>