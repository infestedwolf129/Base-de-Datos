<?php
session_start();

include "../conex_DB.php";

$busqueda = $_POST["busqueda"];
$fecha_sal = $_POST["fecha_sal"];
$fecha_ll = $_POST["fecha_ll"];

# busqueda

if(empty($busqueda) or (empty($fecha_sal) == false) or (empty($fecha_ll) == false)){
    $sql = "SELECT * FROM hoteles WHERE id_h = '-1'";
    $resultado = mysqli_query($conn, $sql);
}
else{
    $sql = "SELECT * FROM hoteles WHERE nombre_h LIKE '%$busqueda%' OR ciudad LIKE '%$busqueda%'";
    $resultado = mysqli_query($conn, $sql);
}

if(empty($busqueda)){
    $sql = "SELECT * FROM paquetes WHERE f_salida = '$fecha_sal' OR f_llegada = '$fecha_ll'";
    $resultado2 = mysqli_query($conn, $sql);
}else {
    $sql = "SELECT * FROM paquetes WHERE nom_paquete LIKE '%$busqueda%' OR ciudad_1 LIKE '%$busqueda%' OR ciudad_2 LIKE '%$busqueda%' OR ciudad_3 LIKE '%$busqueda%' AND f_salida = '$fecha_sal' OR f_llegada = '$fecha_ll'";
    $resultado2 = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Búsqueda de productos</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">       
        <link rel="stylesheet" href="styles.css">
    </head>


    <body>
        <!-- navbar-->
        <header>
            <?php include "nav_hoteles.php" ?>
        </header>

        <!-- Resultados -->
        <table class = "table">
            <thead class = "table-success table-striped">
                <tr>
                    <th>Nombre hotel</th>
                    <th>Estrellas</th>
                    <th>Ciudad</th>
                    <th>Precio por noche</th>
                    <th>Habitaciones totales</th>
                    <th>Habitaciones disponibles</th>
                    <th>Imagen</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php 
            if(mysqli_num_rows($resultado) == 0) {
                echo "No se encontraron resultados de hoteles :(<br>";
            }
            else{
                echo "<h3>Hoteles encontrados:</h3>";
                while ($fila = mysqli_fetch_assoc($resultado)){
                    $name = $fila['nombre_h']
                ?>
                    <td><?php echo $fila['nombre_h']?></td>
                    <td><?php echo $fila['estrellas_h']?></td>
                    <td><?php echo $fila['ciudad']?></td>
                    <td><?php echo $fila['precio_h']?></td>
                    <td><?php echo $fila['habitaciones_t']?></td>
                    <td><?php echo $fila['habitaciones_d']?></td>
                    <td><img src="../../img/<?php echo $name?>.jpg" style="width:400px;"class ="rounded"></td>
                    <td><a type = "button" class="btn btn-outline-primary" href="hotel.php?id=<?php echo $fila['id_h']; ?>">Ver pagina</a></td>
                    </tbody>
        
        
                <?php
                }}?>
        </table>

        <table class = "table">
            <thead class = "table-success table-striped">
                <tr>
                    <th>Nombre paquete</th>
                    <th>Fecha salida</th>
                    <th>Fecha llegada</th>
                    <th>Ciudades</th>
                    <th>Paquetes totales</th>
                    <th>Paquetes disponibles</th>
                    <th>Precio por persona</th>
                    <th>Imagen</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php


            if(mysqli_num_rows($resultado2) == 0) {
                echo "No se encontraron resultados de paquetes :(";
            }
            else{
                echo "<h3>Paquetes encontrados:</h3>";
                while ($fila = mysqli_fetch_assoc($resultado2)){
                    $name = $fila['nom_paquete'];?>
                    <td><?php echo $fila['nom_paquete']?></td>
                    <td><?php echo $fila['f_salida']?></td>
                    <td><?php echo $fila['f_llegada']?></td>
                    <td><ul>
                            <li><?php echo $fila['ciudad_1']?></li>
                            <?php if($fila['ciudad_2'] != NULL){
                                echo "<li>".$fila['ciudad_2']."</li>";
                            }?>
                            <?php if($fila['ciudad_3'] != NULL) if($fila['ciudad_3']){
                                echo "<li>".$fila['ciudad_3']."</li>";
                            } ?>
                        </ul>
                    </td>
                    <td><?php echo $fila['paq_totales']?></td>
                    <td><?php echo $fila['paq_disponibles']?></td>
                    <td><?php echo $fila['precio_pers']?></td>
                    <td><img src="../../img/<?php echo $name?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg" style="width:400px;"class ="rounded"></td>
                    <td><a type = "button" class="btn btn-outline-primary" href="paquete.php?id=<?php echo $fila['id_p']; ?>">Ver pagina</a></td>
                    </tbody>
                    
                    <?php
                }?>
        </table>
        <?php
            }

            ?>

            
        
        <br><br><a type = "button" class="btn btn-outline-primary" href="../home.php" >Volver</a>
    </body>
</html>