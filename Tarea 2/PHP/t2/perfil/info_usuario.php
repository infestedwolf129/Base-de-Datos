<?php 
    session_start();
    include "../conex_DB.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Informacion de usuario</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">       
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <!-- navbar-->
        <header>
            <?php include "nav_perfil.php" ?>
        </header>
        <div>
            <h2> esta es la informacion de tu cuenta: </h2>
            <a>nombre de usuario: <?php echo $_SESSION['nombre_usuario']; ?></a><br>
            <a>email: <?php echo $_SESSION['email']; ?></a><br>
            <a>fecha de nacimiento: <?php echo $_SESSION['fechB']; ?></a><br><br>
        </div>

        <div>
            <li>
                <a type = "button" class="btn btn-outline-primary" href="editar_p.php">Editar datos</a>
            </li>
            <li>
                <a type = "button" class="btn btn-outline-primary" href="eliminar_p.php">Eliminar cuenta</a>
            </li>

            <li>
                <h2> Reseñas hoteles: </h2>
                <table class = "table">
                    <thead class = "table-primary table-strip"> 
                        <tr>
                            <th>Hoteles:</th>
                            <th>Limpieza:</th>
                            <th>Servicio:</th>
                            <th>Decoracion:</th>
                            <th>Calidad de camas:</th>
                            <th>Reseña:</th>
                            <th>Eliminar reseña:</th>
                        </tr> 

                    </thead>
                    <tbody>
                        <?php
                            $id = $_SESSION['id'];
                            $sql = "SELECT * FROM calificaciones_h WHERE id_u='$id' ORDER BY id_ch DESC";
                            $resultado = mysqli_query($conn, $sql);

                            while ($fila = mysqli_fetch_assoc($resultado)){
                                $id_h = $fila['id_h'];
                                $sql2 = "SELECT nombre_h FROM hoteles WHERE id_h='$id_h'";
                                $resultadoname = mysqli_query($conn, $sql2);
                                $fila_h = mysqli_fetch_assoc($resultadoname);
                                ?>

                                <td><?php echo $fila_h['nombre_h']?></td>
                                <td><?php echo $fila['limpieza']?></td>
                                <td><?php echo $fila['servicio']?></td>
                                <td><?php echo $fila['decoracion']?></td>
                                <td><?php echo $fila['calidad_ca']?></td>
                                <td><?php echo $fila['resena']?></td>
                                <td><a type = "button" class="btn btn-outline-primary" href="eliminar_resh.php?id=<?php echo $fila['id_ch'] . "&id_h=" . $id_h?>">Eliminar</a></td>
                                </tbody>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            </li>
            <li>
            <h2> Reseñas paquetes: </h2>

                <table class="table">
                    <thead class="table-primary table-strip">
                        <tr>
                            <th>Paquetes:</th>
                            <th>Calidad hotel:</th>
                            <th>Calidad transporte:</th>
                            <th>Servicio:</th>
                            <th>Relacion precio-calidad:</th>
                            <th>Reseña:</th>
                            <th>Eliminar reseña:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM calificaciones_p WHERE id_u='$id'ORDER BY id_cpaq DESC";
                            $resultado = mysqli_query($conn, $sql);

                            while ($fila = mysqli_fetch_assoc($resultado)){
                                $id_p = $fila['id_p'];
                                $sql2 = "SELECT nom_paquete FROM paquetes WHERE id_p='$id_p'";
                                $resultadoname = mysqli_query($conn, $sql2);
                                $fila_p = mysqli_fetch_assoc($resultadoname);?>

                                <td><?php echo $fila_p['nom_paquete']?></td>
                                <td><?php echo $fila['calidad_h']?></td>
                                <td><?php echo $fila['transporte']?></td>
                                <td><?php echo $fila['servicio']?></td>
                                <td><?php echo $fila['relacion_pc']?></td>
                                <td><?php echo $fila['resena']?></td>
                                <td><a type = "button" class="btn btn-outline-primary" href="eliminar_resp.php?id=<?php echo $fila['id_cpaq'] . "&id_p=" . $id_p?>">Eliminar</a></td>
                                </tbody>




                            <?php
                            }
                        ?>
                </table>
            </li>

            <li> 
                <a type = "button" class="btn btn-outline-primary" href="../home.php">Volver</a>
            </li>
        </div>

    </body>
</html>