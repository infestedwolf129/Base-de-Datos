<?php 
    session_start();    
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo "Wishlist"?></title>

        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">       
        <link rel="stylesheet" href="styles.css">

    </head>

    <body>

    <header>
        <?php include "nav_perfil.php" ?>
    </header>

        <div>
            <?php
                include "../conex_DB.php";
                $usuario=$_SESSION['id'];

                $sql = "SELECT * FROM wishlists WHERE id_u ='$usuario'";
                $resultado = mysqli_query($conn, $sql);

                if(mysqli_num_rows($resultado) === 0) {
                    echo"Aun no tienes artículos en tu wishlist";
                }
                else{
                    $sql = "SELECT * FROM wishlists WHERE id_u ='$usuario' AND hotel = 1";
                    $resultado = mysqli_query($conn, $sql);
                    echo "<h3>Hoteles en la wishlist:</h3>";
                    if(mysqli_num_rows($resultado) === 0) {
                        echo"Aun no tienes hoteles en tu wishlist";
                    }
                    else{
                        while ($fila = mysqli_fetch_assoc($resultado)){
                            $name = $fila['nombre_w'];
                            ?>
                            <img src="../../img/<?php echo rtrim($name)?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg" style="width:444px;"class ="rounded"><br>
                            <?php
                            echo"Nombre del hotel: "; echo $fila['nombre_w']; echo "<br>";
                            echo"Puntuación: "; echo $fila['punt']; echo "<br>";
                            echo"<a href='../hoteles/hotel.php?id=";echo $fila['id_ph']; echo "'>Ver pagina</a><br>";
                            echo"<a href='eliminar_wish.php?id=";echo $fila['id_wish']; echo "'>Eliminar de la wishlist</a><br><br>";
                        }
                    }
                    
                    $sql = "SELECT * FROM wishlists WHERE id_u ='$usuario' AND paquete = 1";
                    $resultado = mysqli_query($conn, $sql);
                    echo "<h3>Paquetes en la wishlist:</h3>";
                    if(mysqli_num_rows($resultado) === 0) {
                        echo"Aun no tienes hoteles en tu wishlist";
                    }
                    else{
                        while ($fila = mysqli_fetch_assoc($resultado)){
                            $name = $fila['nombre_w'];
                            ?>
                            <img src="../../img/<?php echo rtrim($name)?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg" style="width:444px;"class ="rounded"><br>
                            <?php
                            echo"Nombre del Paquete: "; echo $fila['nombre_w']; echo "<br>";
                            echo"Puntuación: "; echo $fila['punt']; echo "<br>";
                            echo"<a href='../hoteles/paquete.php?id=";echo $fila['id_ph']; echo "'>Ver pagina</a><br>";
                            echo"<a href='eliminar_wish.php?id=";echo $fila['id_wish']; echo "'>Eliminar de la wishlist</a><br><br>";
                        }
                    }

                }
            ?>
        </div>
        <br><a href="../home.php">Volver</a>
    </body>
</html>
