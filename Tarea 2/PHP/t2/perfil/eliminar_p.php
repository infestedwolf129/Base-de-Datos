<?php
session_start();
include "../conex_DB.php";

$borrar = $_SESSION['nombre_usuario'];


$sql = "DELETE FROM usuarios WHERE nombre_usuario='$borrar'";
mysqli_query($conn, $sql);

header("Location: ../intro.php");