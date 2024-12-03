<?php
// Redirigir a otro archivo después de 5 segundos
header("Refresh: 30; url='../home.php'");

// Mostrar un mensaje antes de la redirección
echo "<h2 class = 'text-center-success'>Se ha realizado tu compra con exito, si no has sido redirigido aun haz clic <a href='../home.php'>aquí</a></h2>.";

// Cerrar la ejecución del script
exit();
?>