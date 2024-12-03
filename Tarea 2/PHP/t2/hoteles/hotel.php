<?php 
    session_start(); 
    $id_h = $_GET["id"];    
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

        <div class = "container-fluid">

            <h1 class = "text-center">Informacion del hotel</h1>
            <?php
                include "../conex_DB.php";

                $sql = "SELECT * FROM hoteles WHERE id_h='$id_h'";

                $resultado = mysqli_query($conn, $sql);

                if(mysqli_num_rows($resultado) === 1) {
                    $fila = mysqli_fetch_assoc($resultado);
                    $name = $fila['nombre_h'];?>
                    <div class = "container text-justify">
                        <div class = "row">
                            <div class = "col" >
                                Nombre del hotel:<?php echo $fila['nombre_h']?><br>
                                Estrellas : <?php echo $fila['estrellas_h']?><br>
                                Ciudad: <?php echo $fila['ciudad']?><br>
                                Precio por noche: <?php echo $fila['precio_h']?><br>
                                Habitaciones totales: <?php echo $fila['habitaciones_t']?><br>
                                Habitaciones disponibles: <?php echo $fila['habitaciones_t']?><br>
                                Estacionamiento?: <?php echo $fila['estacionamiento']?><br>
                                Piscina?: <?php echo $fila['piscina']?><br>
                                Lavanderia?: <?php echo $fila['lavanderia']?><br>
                                Pet friendly?: <?php echo $fila['pet']?><br>
                                Desayuno?: <?php echo $fila['desayuno']?><br>
                                
                                <ul class="list-group list-group-horizontal">
                                    <!-- boton de anadir a carrito -->
                                    <li class="list-group-item">
                                        <form action="../carro/anadir_carrito.php" method="POST">
                                            <input type="hidden" name = "id" value="<?php echo $id_h; ?> ">
                                            <input class="btn btn-primary" type="submit" value="Añadir al carrito">
                                        </form>
                                    </li>

                                    <!-- boton de anadir a wishlist -->
                                    <li  class="list-group-item">
                                        <form action="../perfil/wish_hotel.php" method="post">
                                            <input type="hidden" name = "nombre" value="<?php echo $fila['nombre_h']; ?> ">
                                            <input type="hidden" name = "id" value="<?php echo $fila['id_h']; ?> ">
                                            <input type="hidden" name = "punt" value="<?php echo $fila['estrellas_h']; ?> ">
                                            <input class="btn btn-primary" type="submit" value="Añadir a la wishlist">
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            <div class = "col">
                                <img src="../../img/<?php echo $name?>.jpg" class="img-fluid rounded" alt="<?php echo $name?>.jpg"><br>
                            </div>
                        </div>                        
                    </div>
                    
                <?php
                }
                else{
                    header("Location: ../index.php?error");
                }
            ?>

            <!-- Calificacion -->
            <div class = "container-fluid text-center">
                <?php
                    $id = $_SESSION['id'];
                    $name = $fila['nombre_h'];

                    $sql = "SELECT * FROM carrito WHERE id_usuario='$id' AND nom_articulo = '$name' ";

                    $resultado = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($resultado) >= 1) {
                ?>
                    <a>Ya has comprado este hotel, calificalo para ayudar a los demas: <a><br><br>
                    <form action="resena_h.php" method="post">
                        <input type="hidden" name = "id" value="<?php echo $fila['id_h']; ?> ">

                        <label for="limpieza">Limpieza:</label>
                        <input type="number" id="limpieza" name="limpieza" min="1" max="5" required><br>

                        <label for="servicio">Servicio:</label>
                        <input type="number" id="servicio" name="servicio" min="1" max="5" required><br>

                        <label for="decoracion">Decoracion:</label>
                        <input type="number" id="decoracion" name="decoracion" min="1" max="5" required><br>

                        <label for="calidad_ca">Calidad de las camas:</label>
                        <input type="number" id="calidad_ca" name="calidad_ca" min="1" max="5" required><br>

                        <label for="resena">Resena:</label>
                        <input type="text" id="resena" name="resena"><br>

                        <input class="btn btn-primary" type="submit" value="Enviar calificacion"><br><br>
                    </form>
                <?php } ?>
            </div>

        </div>
    <a type = 'button' class='btn btn-outline-primary' href="../home.php">Volver</a>
    </body>
</html>

