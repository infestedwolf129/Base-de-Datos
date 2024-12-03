<?php
    session_start();
    include "../conex_DB.php";

    
    $id_u = $_SESSION['id'];
    $id_ph = $_POST['id'];
    $name = $_POST['nombre'];
    
    $sqlrev = "SELECT * FROM wishlists WHERE id_ph='$id_ph' AND id_u ='$id_u' AND hotel = 1";
    $resultado = mysqli_query($conn, $sqlrev);
    if(mysqli_num_rows($resultado) >= 1) {
        header("Location: wishlist.php");
    } else{ 
        $sql = "SELECT * FROM calificaciones_h WHERE id_h='$id_ph'";
        $resultado = mysqli_query($conn, $sql);
        $punt = 0;
        $contador = 0;
        while ($fila = mysqli_fetch_assoc($resultado)){
            $punt = ($punt + $fila['promedio']);
            $contador = $contador + 1;
        }
        $punt = round(($punt/$contador),2);
        $sql = "INSERT INTO wishlists (id_u, id_ph, hotel, nombre_w, punt) VALUES ('$id_u', '$id_ph', 1, '$name', '$punt')";
        mysqli_query($conn, $sql);
        header("Location: wishlist.php");
    }
?>