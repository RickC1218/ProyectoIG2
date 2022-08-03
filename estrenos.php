<?php
$conexion = mysqli_connect('localhost', 'root', 'admin', 'proyecto_cine');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopCine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/estilos.css">
</head>

<body>
    <header>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid" id="cabecera">
                    <div class="col align-self-center col-1 logo">
                        <a class="navbar-brand" href="/index.html">
                            <span><img src="/recursos/imagenes/logo-TopCine.png" alt="logo" style="width: 100%;"></span>
                        </a>
                    </div>
                    <div class="col-4">
                        <button id="menu" class="col align-self-end navbar-toggler barra navbar-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse col align-self-end barra" id="navbarContent">
                            <ul class="navbar-nav m-auto col-12">
                                <li class="nav-item">
                                    <a class="nav-link" id="boton" href="/index.php">Ingresar</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/estrenos.php">Estrenos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/dulceria.php">Dulcería</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/perfil.php">Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/carrito.php" id="boton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart4 " viewBox="0 0 16 16">
                                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="wrap container-fluid">
        <section id="peliculas" class="col-12">
            <div class="clearfix"></div>
            <div id="pelicula">
                <h2><strong>Hola,</strong> bienvenido a nuestra cartelera...</h2>
                <?php
                $sql = "SELECT * from pelicula";
                $result = mysqli_query($conexion, $sql);
                while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                    <div class="cuadro">
                        <div class="card">
                            <img src=<?php echo $mostrar['IMG_PELICULA']; ?> class="img-rounded" alt="peli1">
                        </div>
                        <div class="category">
                            <h5><strong><?php echo $mostrar['TITULO_PELICULA'] ?></strong></h5>
                            <h6><?php echo $mostrar['DURACION_PELICULA'] ?></h6>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
    </div>
</body>

</html>