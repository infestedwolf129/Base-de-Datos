<?php
$server= "localhost";
$username = "root";
$password = "";
$database = "t2";

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
}

$records = $conn->prepare('CREATE TABLE IF NOT EXISTS songs (id INT PRIMARY KEY, nombre VARCHAR(50), grupo VARCHAR(50));');
$records->execute();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Guayando</title>
    </head>

    <body>
        <h1>
            Popipo<br>
        </h1>
        
        <?php  
        echo "Mikudayo\n" ;
        echo "<br>";
        ?>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/DZiaXEIQgkE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        <h2> my way <br> estus <br> quanxi</h2>
    </body>
</html>