<?php session_start() ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Informacion de usuario</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">       
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <header>
            <?php include "nav_perfil.php" ?>
        </header>

        <h1> Datos actuales: </h1><br>
        <a>nombre de usuario: <?php echo $_SESSION['nombre_usuario']; ?></a><br>
        <a>email: <?php echo $_SESSION['email']; ?></a><br>
        <a>fecha de nacimiento: <?php echo $_SESSION['fechB']; ?></a><br><br>
        <h1> Que informacion deseas editar?: </h1><br>

        <form action="alterar_p.php" method="POST">
            <label for="nombre_a">Nombre de usuario:</label>
            <input type="text" id="nombre_a" name="nombre_a"><br><br>
            <label for="email_a">Correo electronico:</label>
            <input type="email" id="email_a" name="email_a"><br><br>
            <label for="contrasena_a">Contraseña:</label>
            <input type="password" id="contrasena_a" name="contrasena_a"><br><br>
            <label for="fecha_nacimiento_a">Fecha de nacimiento (YYYY-MM-DD):</label>
            <input type="fecha_nacimiento" id="fecha_nacimiento_a" name="fecha_nacimiento_a"><br><br>
            <input type="submit" value="Cambiar">
        </form>

        <br><a href="../home.php">Volver</a>
    </body>
</html>