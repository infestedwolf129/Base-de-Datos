<nav class="navbar navbar-expand-md navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand" href="../home.php">
            <img src = "../../img/logo.png" style="width:40px;"class ="rounded">
            <strong>PrestigeTravels</strong>
        </a>

        <div class="user text-light">

        <a>Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?></a>

        </div>

        <div class="navbar-nav mr-auto">
            <li class = "nav-item">
                <a href="../perfil/info_usuario.php" class="nav-link active" aria-current="page">Mi cuenta</a>
            </li>
            <li class = "nav-item">
                <a href="../logout.php" class="nav-link active" aria-current="page">Cerrar Sesion</a>
            </li>
            <li class = "nav-item">
                <a href="../carro/carrito.php" class="nav-link active" aria-current="page">Carrito</a>
            </li>
            <li class = "nav-item">
                <a href="../perfil/wishlist.php" class="nav-link active" aria-current="page">Wishlist</a>
            </li>
        </div>
    </div>
</nav>