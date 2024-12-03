<!DOCTYPE html>
<html>
    <head>
        <title> LOGIN </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            width: 300px;
            margin: 0 auto;
            margin-top: 150px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        }

        .container h2 {
            margin-bottom: 20px;
        }

        .container input[type="text"],
        .container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button {
            position: fixed;
            bottom: 10px;
            left: 10px;
            padding: 5px 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-button {
            position: fixed;
            bottom: 10px;
            right: 10px;
            padding: 5px 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    </head>

    <body class = "container">
        <h2> Iniciar Sesion </h2>
        <form action="login.php" method="post">
            <input type="text" name="nomusuario" placeholder="Nombre de Usuario" required><br>
            <input type="password" name="contra" placeholder = "Contraseña" required><br>

            <input type="submit" value ="Iniciar Sesion"></input>
        <form>
        <a href="intro.php" class = "back-button">Volver</a>
        <a href="registro.php" class="register-button">Crea una cuenta</a>
    </body>
</html>