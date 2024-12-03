<?php 
    session_start(); 
    $id_p = $_GET["id"];    
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
        <?php include "nav_hoteles.php" ?>
    </header>

        <div>
            <?php
                include "../conex_DB.php";

                $sql = "SELECT * FROM paquetes WHERE id_p='$id_p'";

                $resultado = mysqli_query($conn, $sql);

                if(mysqli_num_rows($resultado) === 1) {
                    $fila = mysqli_fetch_assoc($resultado);
                    $name = $fila['nom_paquete'];
                    ?>         
                    <div class = "col">
                        <img src="../../img/<?php echo $name?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg" style="width:400px;"class ="rounded"><br>
                    </div>
                    <?php
                    echo"Nombre del paquete: "; echo $fila['nom_paquete']; echo "<br>";
                    echo"Hospedaje 1: ";

                    $id_h=$fila['hospedaje_1'];
                    $sql = "SELECT * FROM hoteles WHERE id_h='$id_h'";
                    $resultado_p = mysqli_query($conn, $sql);
                    $fila_h = mysqli_fetch_assoc($resultado_p);
                    echo $fila_h['nombre_h'];echo "<br>";

                    if($fila['hospedaje_2'] != NULL){echo"Hospedaje 2: "; 
                        $id_h=$fila['hospedaje_2'];
                        $sql = "SELECT * FROM hoteles WHERE id_h='$id_h'";
                        $resultado_p = mysqli_query($conn, $sql);
                        $fila_h = mysqli_fetch_assoc($resultado_p);
                        echo $fila_h['nombre_h'];echo "<br>";
                    }
                    if(($fila['hospedaje_3'] != NULL)){echo"Hospedaje 3: "; 
                        $id_h=$fila['hospedaje_3'];
                        $sql = "SELECT * FROM hoteles WHERE id_h='$id_h'";
                        $resultado_p = mysqli_query($conn, $sql);
                        $fila_h = mysqli_fetch_assoc($resultado_p);
                        echo $fila_h['nombre_h'];echo "<br>";
                    }
                    echo"Ciudad 1: "; echo $fila['ciudad_1']; echo "<br>";
                    if(empty($fila['ciudad_2']) == false){echo"Ciudad 2: "; echo $fila['ciudad_2']; echo "<br>";}
                    if(empty($fila['ciudad_3']) == false){echo"Ciudad 3: "; echo $fila['ciudad_3']; echo "<br>";}
                    echo"Aerolinea de ida: "; echo $fila['aerolinea_ida']; echo "<br>";
                    echo"Aerolinea de vuelta: "; echo $fila['aerolinea_vuelta']; echo "<br>";
                    echo"Fecha de salida: "; echo $fila['f_salida']; echo "<br>";
                    echo"Fecha de llegada: "; echo $fila['f_llegada']; echo "<br>";
                    echo"Noches totales: "; echo $fila['noches_totales']; echo "<br>";
                    echo"Precio por persona: "; echo $fila['precio_pers']; echo "<br>";
                    echo"Paquetes totales: "; echo $fila['paq_totales']; echo "<br>";
                    echo"Paquetes disponibles: "; echo $fila['paq_disponibles']; echo "<br>";
                    echo"Máximo personas por paquete: "; echo $fila['max_pers_paq']; echo "<br>";
                    
                }
                else{
                    header("Location: ../index.php?error");
                }

            ?>
        </div>


        <!-- boton de anadir a carrito -->
        <form action="../carro/anadir_carrito_paquetes.php" method="post">

            <input type="hidden" name = "nombre" value="<?php echo $fila['nom_paquete']; ?> ">
            <input type="hidden" name = "id_p" value="<?php echo $fila['id_p']?>">

            <input class="btn btn-primary" type="submit" value="Añadir al carrito">

        </form><br>

        <form action="../perfil/wish_paquete.php" method="post">

            <input type="hidden" name = "nombre" value="<?php echo $fila['nom_paquete']; ?> ">
            <input type="hidden" name = "id" value="<?php echo $fila['id_p']; ?> ">
            <input class="btn btn-primary" type="submit" value="Añadir a la wishlist">

        </form><br>



        <?php
                $id = $_SESSION['id'];
                $name = $fila['nom_paquete']; 

                $sql = "SELECT * FROM carrito WHERE id_usuario='$id' AND nom_articulo = '$name' ";

                $resultado = mysqli_query($conn, $sql);

                if(mysqli_num_rows($resultado) >= 1) {
            ?>
                <a>Ya has comprado este paquete, calificalo para ayudar a los demas: <a><br><br>
                <form action="resena_p.php" method="post">
                    <input type="hidden" name = "id" value="<?php echo $fila['id_p']; ?> ">

                    <label for="calidad">Calidad de hoteles:</label>
                    <input type="number" id="calidad" name="calidad" min="1" max="5" required><br>
                    
                    <label for="trans">Transporte:</label>
                    <input type="number" id="trans" name="trans" min="1" max="5" required><br>
                    
                    <label for="servicio">Servicio:</label>
                    <input type="number" id="servicio" name="servicio" min="1" max="5" required><br>

                    <label for="rel_pc">Relacion calidad precio:</label>
                    <input type="number" id="rel_pc" name="rel_pc" min="1" max="5" required><br>

                    <label for="resena">Resena:</label>
                    <input type="text" id="resena" name="resena"><br>

                    <input class="btn btn-primary" type="submit" value="Enviar calificacion"><br><br>
                </form>
            <?php } ?>
        
        <a type = 'button' class='btn btn-outline-primary' href="../home.php">Volver</a>
    </body>
</html>