<!DOCTYPE html>
<html>
    <head>
        <title>Registrarse</title>
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
        .container input[type="password"],
        .container input[type="email"],
        .container input[type="date"]{
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

        .login-link {
            display: block;
            margin-top: 20px;
            color: #4caf50;
            text-decoration: none;
        }
    </style>
    </head>
    <body>
        <div class="container">
        <h2>Formulario de Registro</h2>
        <form action="pro_regis.php" method="POST">
            <input type="text" id="nombre" name="nombre" placeholder="Nombre de usuario" required><br><br>
            <input type="email" id="email" name="email" placeholder="Correo electronico" required><br><br>
            <input type="password" id="contrasena" name="contrasena" placeholder="Contrasena" required><br><br>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha de nacimiento formato YYYY-MM-DD" required><br><br>
            <input type="submit" value="Registrarse">
        </form>
        <a href="index.php" class = "login-link">¿Ya tienes cuenta? Inicia Sesion</a>
        </div>
        <a href="intro.php" class = "back-button">Volver</a>
    </body>

</html>