<?php session_start(); 
$id_usuario = $_SESSION['id'];
include "../conex_DB.php";
?> 


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">       
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php include "nav_carrito.php"; ?>

    <!-- carrito -->
    <div class = "panel-body">
        <h1><center>Carrito</center></h1>
        <div class = "container-fluid">
            <table class = "table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Personas</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead >
                <tbody>
                    
                    <?php $datos = $conn -> query("SELECT * FROM carrito WHERE id_usuario = '$id_usuario' ");
                    $total = 0;
                    $count = 0;
                    if ($datos->num_rows > 0){
                        while ($row = $datos->fetch_assoc()){
                            $count = $count + 1;
                            $nom_articulo = $row['nom_articulo'];
                            $hotel = $conn -> query("SELECT * FROM hoteles WHERE nombre_h = '$nom_articulo'");
                            $row_h = $hotel->fetch_assoc();
                            $paquete = $conn -> query("SELECT * FROM paquetes WHERE nom_paquete = '$nom_articulo'");
                            $row_p = $paquete->fetch_assoc();

                            //si es hotel
                            if ($row_h != null){
                                $datos_producto = $conn -> query("SELECT * FROM hoteles WHERE nombre_h = '$nom_articulo'");
                                $row_producto = $datos_producto->fetch_assoc();
                                $nombre_producto = $row_producto['nombre_h'];
                                $precio_producto = $row_producto['precio_h'];
                                $cantidad = $row['cantidad'];
                                $tipo = $row['tipo_compra'];
                                $total = $total + ($precio_producto * $cantidad);?>

                                <th scope = "row"><?php echo $count ?></th>
                                <td><?php echo $nombre_producto; ?></td>
                                <td>Precio: <?php echo $precio_producto; ?></td>
                                <td>
                                    <div class = "container input-group">
                                        <div class = "input-group-prepend">
                                            <form action = "editar_hotel.php" method = "POST">
                                            <input type="number" name= "new_cantidad" class = "form-control" value ="<?php echo $cantidad?>" min = "1">
                                        </div>
                                        <div class = "input-group-append">
                                                <input type = "hidden" name = "cant_act" value = "<?php echo $cantidad?>">
                                                <input type = "hidden" name = "nom_compra" value = "<?php echo $nombre_producto?>">
                                                <input type = "hidden" name = "tipo" value = "<?php echo $tipo?>">
                                                <button class = "btn btn-outline-primary" type = "submit">
                                                    <span data-component = "text">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" style="display: inline-block; vertical-align: text-bottom;">
                                                            <path d="M1.705 8.005a.75.75 0 0 1 .834.656 5.5 5.5 0 0 0 9.592 2.97l-1.204-1.204a.25.25 0 0 1 .177-.427h3.646a.25.25 0 0 1 .25.25v3.646a.25.25 0 0 1-.427.177l-1.38-1.38A7.002 7.002 0 0 1 1.05 8.84a.75.75 0 0 1 .656-.834ZM8 2.5a5.487 5.487 0 0 0-4.131 1.869l1.204 1.204A.25.25 0 0 1 4.896 6H1.25A.25.25 0 0 1 1 5.75V2.104a.25.25 0 0 1 .427-.177l1.38 1.38A7.002 7.002 0 0 1 14.95 7.16a.75.75 0 0 1-1.49.178A5.5 5.5 0 0 0 8 2.5Z"></path>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td><!--PERSONAS--></td>
                                <td>Precio: <?php echo $precio_producto * $cantidad; ?></td>
                                <td><a href="eliminar_carrito.php?nom_articulo=<?php echo $nombre_producto; ?>" class = "btn btn-danger"><img src = "../../img/trash.png" style="width:30px;"></a><td>

                            <?php
                            }
                            //si es paquete
                            if ($row_p != null){
                                $datos_producto = $conn -> query("SELECT * FROM paquetes WHERE nom_paquete = '$nom_articulo'");
                                $row_producto = $datos_producto->fetch_assoc();
                                $nombre_producto = $row_producto['nom_paquete'];
                                $precio_producto = $row_producto['precio_pers'];
                                $cantidad = $row['cantidad'];
                                $personas = $row['personas'];
                                $max_personas = $row_producto['max_pers_paq'];
                                $total = $total + ($precio_producto * $cantidad);?>

                                <th scope = "row"><?php echo $count; ?></th>
                                <td><?php echo $nombre_producto; ?></td>
                                <td>Precio: <?php echo $precio_producto; ?></td>
                                <td>
                                    <div class = "container input-group">
                                        <div class = "input-group-prepend">
                                            <form action = "editar_paquete.php" method = "POST"> 
                                            <input type="number" name="new_cantidad" class = "form-control" value ="<?php echo $cantidad?>" min = "1">
                                        </div>
                                        <div class = "input-group-append">
                                            <input type = "hidden" name = "cant_act" value = "<?php echo $cantidad?>">
                                            <input type = "hidden" name = "nom_compra" value = "<?php echo $nombre_producto?>">
                                            <button class = "btn btn-outline-primary" type="submit">
                                                <span data-component = "text">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" style="display: inline-block; vertical-align: text-bottom;">
                                                        <path d="M1.705 8.005a.75.75 0 0 1 .834.656 5.5 5.5 0 0 0 9.592 2.97l-1.204-1.204a.25.25 0 0 1 .177-.427h3.646a.25.25 0 0 1 .25.25v3.646a.25.25 0 0 1-.427.177l-1.38-1.38A7.002 7.002 0 0 1 1.05 8.84a.75.75 0 0 1 .656-.834ZM8 2.5a5.487 5.487 0 0 0-4.131 1.869l1.204 1.204A.25.25 0 0 1 4.896 6H1.25A.25.25 0 0 1 1 5.75V2.104a.25.25 0 0 1 .427-.177l1.38 1.38A7.002 7.002 0 0 1 14.95 7.16a.75.75 0 0 1-1.49.178A5.5 5.5 0 0 0 8 2.5Z"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                            </form>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class = "container input-group">
                                        <div class = "input-group-prepend"> 
                                            <form action = "editar_personas.php" method = "POST">
                                            <input type="number" name = "new_personas" class = "form-control" value ="<?php echo $personas?>" min = "1">
                                        </div>
                                        <div class = "input-group-append">
                                            <input type = "hidden" name = "personas_act" value = "<?php echo $personas?>">
                                            <input type = "hidden" name = "nom_compra" value = "<?php echo $nombre_producto?>">
                                            <input type = "hidden" name = "cantidad" value = "<?php echo $cantidad?>">
                                            <input type = "hidden" name = "max_personas" value = "<?php echo $max_personas?>">
                                            <button  class = "btn btn-outline-primary" type="submit">
                                                <span data-component = "text">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" style="display: inline-block; vertical-align: text-bottom;">
                                                        <path d="M1.705 8.005a.75.75 0 0 1 .834.656 5.5 5.5 0 0 0 9.592 2.97l-1.204-1.204a.25.25 0 0 1 .177-.427h3.646a.25.25 0 0 1 .25.25v3.646a.25.25 0 0 1-.427.177l-1.38-1.38A7.002 7.002 0 0 1 1.05 8.84a.75.75 0 0 1 .656-.834ZM8 2.5a5.487 5.487 0 0 0-4.131 1.869l1.204 1.204A.25.25 0 0 1 4.896 6H1.25A.25.25 0 0 1 1 5.75V2.104a.25.25 0 0 1 .427-.177l1.38 1.38A7.002 7.002 0 0 1 14.95 7.16a.75.75 0 0 1-1.49.178A5.5 5.5 0 0 0 8 2.5Z"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td>Precio: <?php echo $precio_producto * $cantidad * $personas; ?></td>
                                <td><a href="eliminar_carrito.php?nom_articulo=<?php echo $nombre_producto; ?>" class = "btn btn-danger"><img src = "../../img/trash.png" style="width:30px;"></a><td>
                            <?php
                            }
                            ?>
                            
                            </tbody>
                            <?php
                        }?>
                    
                    
                    <?php } else {
                        echo "
                        <tr>
                            <td colspan = '5'>No hay productos en el carrito</td>
                        </tr>
                        ";
                        }
                    ?>
                
                <tfoot>
                    <div class = "container-fluid " >
                        <tr>
                            <td colspan = "5">
                                <a href="../home.php" class = "btn btn-success">Seguir comprando</a>
                            </td>
                            <td><b>Total: <?php echo $total; ?></b></td>
                            
                            <td>
                                <a href="compra.php" class="btn btn-success">Comprar</a>
                            </td>
                            
                        </tr>
                    </div>
            
            </table>
        </div>
    </div>
</body>
</html>