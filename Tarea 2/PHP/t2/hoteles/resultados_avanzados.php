<?php
session_start();

include "../conex_DB.php";

$busqueda = $_POST["busqueda"];
$fecha_sal = $_POST["fecha_sal"];
$fecha_ll = $_POST["fecha_ll"];
$cali = $_POST['call'];
if(empty($_POST['cota_sup'])){
    $cota_sup =100000000;
} else{
    $cota_sup =$_POST['cota_sup']; 
}

if(empty($_POST['cota_inf'])){
    $cota_inf =0;
} else{
    $cota_inf =$_POST['cota_inf']; 
}


if(empty($cali)){
    $cali = 0;
}

if((empty($fecha_sal) == false) or (empty($fecha_ll) == false)){
    $sql = "SELECT * FROM hoteles WHERE id_h = '-1'";
    $resultado = mysqli_query($conn, $sql);
}
else if (empty($_REQUEST['city'])) {
    $sql = "SELECT * FROM hoteles WHERE nombre_h LIKE '%$busqueda%' OR ciudad LIKE '%$busqueda%'";
    $resultado = mysqli_query($conn, $sql);
} else {
    $sql = "SELECT * FROM hoteles WHERE ciudad LIKE '%$busqueda%'";
    $resultado = mysqli_query($conn, $sql);
}

if(empty($busqueda)){
    $sql = "SELECT * FROM paquetes WHERE f_salida LIKE '%$fecha_sal%' OR f_llegada LIKE'%$fecha_ll%'";
    $resultado2 = mysqli_query($conn, $sql);
}else if (empty($_REQUEST['city'])) {
    $sql = "SELECT * FROM paquetes WHERE nom_paquete LIKE '%$busqueda%' OR ciudad_1 LIKE '%$busqueda%' OR ciudad_2 LIKE '%$busqueda%' OR ciudad_3 LIKE '%$busqueda%' AND f_salida = '$fecha_sal' OR f_llegada = '$fecha_ll'";
    $resultado2 = mysqli_query($conn, $sql);
} else{
    $sql = "SELECT * FROM paquetes WHERE ciudad_1 LIKE '%$busqueda%' OR ciudad_2 LIKE '%$busqueda%' OR ciudad_3 LIKE '%$busqueda%' AND f_salida = '$fecha_sal' OR f_llegada = '$fecha_ll'";
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
    <h3>Resultados de la búsqueda:</h3>
    <?php 
    if (empty($_REQUEST['paquete'])){
        if(mysqli_num_rows($resultado) == 0) {
            echo "No se encontraron resultados de hoteles :(<br>";
        }
        else{
            echo "<h3>Hoteles encontrados:</h3>";
            while ($fila = mysqli_fetch_assoc($resultado)){
                $name = $fila['nombre_h'];
                $id = $fila['id_h'];

                $sql = "SELECT punt FROM wishlists WHERE nombre_w ='$name' AND id_ph = '$id'LIMIT 1";
                $resultadocomp = mysqli_query($conn, $sql);
                $filacomp = mysqli_fetch_assoc($resultadocomp);
                if($filacomp['punt'] >= $cali and ($fila['precio_h'] <= $cota_sup) and ($fila['precio_h'] >= $cota_inf)){
                    ?> <img src="../../img/<?php echo rtrim($name)?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg" style="width:444px;"class ="rounded"><br>
                    <?php
                    echo"Nombre del hotel: "; echo $name; echo "<br>";
                    echo"estrellas: "; echo $fila['estrellas_h']; echo "<br>";
                    echo"Ciudad: "; echo $fila['ciudad']; echo "<br>";
                    echo"Precio por noche: "; echo $fila['precio_h']; echo "<br>";
                    echo"Habitaciones totales: "; echo $fila['habitaciones_t']; echo "<br>";
                    echo"Habitaciones disponibles: "; echo $fila['habitaciones_d']; echo "<br>";
                    echo"<a href='hotel.php?id=";echo $fila['id_h']; echo "'>Ver pagina</a><br><br>";
                }
            }
        }
    }

    if (empty($_REQUEST['hotel'])){
        if(mysqli_num_rows($resultado2) == 0) {
            echo "No se encontraron resultados de paquetes :(";
        }
        else{
            echo "<h3>Paquetes encontrados:</h3>";
            while ($fila = mysqli_fetch_assoc($resultado2)){
                $name = $fila['nom_paquete'];
                $id = $fila['id_p'];

                $sql = "SELECT punt FROM wishlists WHERE nombre_w ='$name' AND id_ph = '$id'LIMIT 1";
                $resultadocomp = mysqli_query($conn, $sql);
                $filacomp = mysqli_fetch_assoc($resultadocomp);
                if($filacomp['punt'] >= $cali and ($fila['precio_pers'] <= $cota_sup) and ($fila['precio_pers'] >= $cota_inf)){
                    ?><img src="../../img/<?php echo $name?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg" style="width:400px;"class ="rounded"><br><?php
                    echo"Nombre del Paquete: "; echo $fila['nom_paquete']; echo "<br>";
                    echo"Fecha salida: "; echo $fila['f_salida']; echo "<br>";
                    echo"Fecha llegada: "; echo $fila['f_llegada']; echo "<br>";
                    echo"Ciudades: "; echo $fila['ciudad_1']; echo"-"; echo $fila['ciudad_2']; echo"-"; echo $fila['ciudad_3']; echo "<br>";
                    echo"Precio por persona: "; echo $fila['precio_pers']; echo "<br>";
                    echo"<a href='paquete.php?id=";echo $fila['id_p']; echo "'>Ver pagina</a><br><br>";
                }
            }
        }
    }
    ?>

    <br><br><a href="../home.php">Volver</a>
</body>
</html>