<?php session_start();?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">       
</head>


<body>

<!-- navbar-->
<header>
    <?php include "nav.php" ?>
</header>



<!-- busqueda-->

<div class="container">
    <h2>Búsqueda de productos: </h2>
    <form method="post" action="hoteles/resultados.php" class = "row g-3">
        <div class="col-auto">
            <label for="busqueda">Término de búsqueda:</label>
            <input type="text" id="busqueda" name="busqueda"><br>
        </div>

        <div class = "col-auto">
            <label for="fecha_sal">Fecha de salida:</label>
            <input type="date" id="fecha_sal" name="fecha_sal"><br>
        </div>

        <div class = "col-auto">
            <label for="fecha_ll">Fecha de llegada:</label>
            <input type="date" id="fecha_ll" name="fecha_ll"><br><br>
        </div>
        <center>
            <input class = "btn btn-outline-primary" type="submit" value="Buscar">
        </center>
    </form>
</div>

<!-- busqueda avanzada-->

<div class="container-fluid container-sm ">
    <h2>Búsqueda de productos avanzada: </h2><br>
    <form method="post" action="hoteles/resultados_avanzados.php" class ="row g-3">
        <div class = "row">
            <div class="col-auto">
                <label for="busqueda">Término de búsqueda:</label>
                <input type="text" id="busqueda" name="busqueda"><br><br>
            </div>
        </div>

        <div class = "row">
            <label for="fecha_sal">Fecha de salida:</label>
            <input type="date" id="fecha_sal" name="fecha_sal"><br><br>
        </div>

            <div class = "row ">
            <label for="fecha_ll">Fecha de llegada:</label>
            <input type="date" id="fecha_ll" name="fecha_ll"><br><br>

            <label for="call">Calificación mínima:</label>
            <input type="number" id="call" name="call" min="1" max="5"><br><br>

            <label for="cota_sup">Precio menor a:</label>
            <input type="number" id="cota_sup" name="cota_sup"><br><br>

            <label for="cota_inf">Precio mayor a:</label>
            <input type="number" id="cota_inf" name="cota_inf"><br><br>

            <label for="hotel">Solo hoteles:</label>
            <input type="checkbox" name="hotel" id="hotel">

            <label for="paquete">Solo paquetes:</label>
            <input type="checkbox" name="paquete"  id="paquete">

            <label for="city">Solo buscar por ciudad:</label>
            <input type="checkbox" name="city"  id="city">

        </div>

        <input class = "btn btn-outline-primary" type="submit" value="Buscar">
    </form>
</div>

<!--4 hoteles y paquetes con mayor cantidad de reservas-->
<div class = "container-fluid container-sm text-center">
    <?php

        echo"<br><h2>Opciones con mayor disponibilidad: </h2><br>";

        include "conex_DB.php";

        $sql = "SELECT * FROM hoteles ORDER BY habitaciones_d DESC LIMIT 4";
        $resultado = mysqli_query($conn, $sql);

        $sql2 = "SELECT * FROM paquetes ORDER BY paq_disponibles DESC LIMIT 4";
        $resultado2 = mysqli_query($conn, $sql2);

        $contador = 0;

        
        
        while($contador != 4){
            if($contador == 0){
                $row1 = $resultado->fetch_assoc();

                $row2 = $resultado2->fetch_assoc();
            }
            if($row1['habitaciones_d'] >= $row2['paq_disponibles']){
                $name= $row1['nombre_h'];
                ?> <img src="../img/<?php echo rtrim($name)?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg" style="width:400px;"class ="rounded"><br> <?php
                echo "Hotel: "; echo $name; echo"<br>";
                echo "Precio por noche"; echo $row1['precio_h'];echo"<br>";
                echo"<a type = 'button' class='btn btn-outline-primary' href='hoteles/hotel.php?id=";echo $row1['id_h']; echo "'>Ver pagina</a><br><br>";

                $row1 = $resultado->fetch_assoc();
                
            } else{
                $name= $row2['nom_paquete'];
                ?> <img src="../img/<?php echo rtrim($name)?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg" style="width:400px;"class ="rounded"><br> <?php
                echo "Paquete: "; echo $name; echo"<br>";
                echo "Precio por noche: "; echo $row2['precio_pers'];echo"<br>";
                echo"<a type = 'button' class='btn btn-outline-primary' href='hoteles/paquete.php?id="; echo $row2['id_p']; echo"'>Ver pagina</a><br><br>";

                $row2 = $resultado2->fetch_assoc();
            }
            $contador = $contador + 1;
        }
    ?>
</div>

<!--10 mejores hoteles-->
<div class = "container-fluid container-sm text-center">
    <h2>10 mejores hoteles: </h2><br>
    <table class = "table">
        <thead>
            <tr>
                <th scope = "col">Nombre</th>
                <th scope = "col">Calificación</th>
                <th scope = "col"></th>
                <th scope = "col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                include "conex_DB.php";

                $sql = "SELECT DISTINCT id_ph, punt FROM wishlists WHERE hotel = 1 ORDER BY punt DESC LIMIT 10";
                $resultado = mysqli_query($conn, $sql);

                $sql2 = "SELECT DISTINCT id_ph, punt FROM wishlists WHERE paquete = 1 ORDER BY punt DESC LIMIT 10";
                $resultado2 = mysqli_query($conn, $sql2);

                while ($fila = mysqli_fetch_assoc($resultado)){
                    $id_h = $fila['id_ph'];
                    $sqlextra = "SELECT nombre_h FROM hoteles WHERE id_h='$id_h'";
                    $resultadoname = mysqli_query($conn, $sqlextra);
                    $fila_h = mysqli_fetch_assoc($resultadoname);
                    $name = $fila_h['nombre_h'];

                    ?>
                    
                    <td><?php echo $name?></td>
                    <td><?php echo $fila['punt']?></td>
                    <td><img src="../img/<?php echo rtrim($name)?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg" style="width:400px;"class ="rounded"></td>
                    <td><a type = "button" class="btn btn-outline-primary" href="hoteles/hotel.php?id=<?php echo $id_h?>">Ver pagina</a></td>
                    </tbody>
                    
                <?php
                }?>
    </table>
</div>

<!--10 mejores paquetes-->
<div class = "container-fluid container-sm text-center">
    <h2>10 mejores paquetes: </h2><br>
    <table class = "table">
        <thead>
            <tr>
                <th scope = "col">Nombre</th>
                <th scope = "col">Calificación</th>
                <th scope = "col"></th>
                <th scope = "col"></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($fila = mysqli_fetch_assoc($resultado2)){
            $id_p = $fila['id_ph'];
            $sqlextra = "SELECT nom_paquete FROM paquetes WHERE id_p='$id_p'";
            $resultadoname = mysqli_query($conn, $sqlextra);
            $fila_h = mysqli_fetch_assoc($resultadoname);
            $name = $fila_h['nom_paquete'];

            ?>
            <td><?php echo $name?></td>
            <td><?php echo $fila['punt']?></td>
            <td><img src="../img/<?php echo rtrim($name)?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg" style="width:400px;"class ="rounded"></td>
            <td><a type = "button" class="btn btn-outline-primary" href="hoteles/paquete.php?id=<?php echo $id_p?>">Ver pagina</a></td>
            </tbody>
                

            
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>





