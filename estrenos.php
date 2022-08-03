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
    <link rel="stylesheet" href="recursos/fuentes/font-awesome-4.7.0/css/font-awesome.min.css">
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
                <h2><strong>Hola,</strong> bienvenido a una experiencia entre estrellas...</h2>
                <?php 
                    $sql = "SELECT * from pelicula";
                    $result = mysqli_query($conexion, $sql);
                    while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                <div id="cajaPelicula">
                    <div id="tarjeta" class="card">
                        <div id="posterPelicula">
                            <img src=<?php echo $mostrar['IMAGEN_PELICULA']; ?> class="img-rounded" alt="peli1">
                        </div>
                        <div id="trailerPelicula">
                            <!--trailer-->
                        </div>
                    </div>
                    <div class="category">
                        <h5><strong><?php echo $mostrar['TITULO_PELICULA'] ?></strong></h5>
                        <h6><?php echo $mostrar['ESTRENO_PELICULA'] ?></h6>
                    </div>
                    <div id="infoPelicula">
                        <h6><strong>Estrellas principales: </strong></h6>
                        <p><?php echo $mostrar['ACTPRIN_PELICULA'] ?></p>
                        
                        <h6><strong>Estrellas secundarios: </strong></h6>
                        <p><?php echo $mostrar['ACTSECUN_PELICULA'] ?></p>
                        <p><strong>SINÓPSIS: </strong><?php echo $mostrar['SINOPSIS_PELICULA'] ?></p>
                        <h6><strong>Idioma disponible: </strong></h6>
                        <p><?php echo $mostrar['IDIOMA_PELICULA'] ?></p>
                        <button id="boton" type="btn">
                            <h5> Comprar boletos </h5>
                        </button>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <script type="text/javascript" src="/backend/contador.js"></script>
        </section>
    </div>
    <!--footer-->
    <div class="clearfix"></div>
    <!--Inicio Footer-->
    <footer class="bg-dark text-center text-white">
        <!-- Grid container -->
        <div class="container p-4">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>
                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>

                <!-- Youtube -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fa fa-youtube-play fa-2x" aria-hidden="true"></i></a>
            </section>
            <!-- Section: Social media -->

            <!-- Section: Text -->
            <section class="mb-4">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt distinctio earum
                    repellat quaerat voluptatibus placeat nam, commodi optio pariatur est quia magnam
                    eum harum corrupti dicta, aliquam sequi voluptate quas.
                </p>
            </section>
            <!-- Section: Text -->

            <!-- Section: Links -->
            <section class="">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <img src="recursos/imagenes/logo-TopCine.png" alt="Logo TopCine" title="Logo TopCine"
                                    class="img-fluid ">
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Sobre nosotros</h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#!" class="text-white">Link 1</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Link 2</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Link 3</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Link 4</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Legales</h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#!" class="text-white">Link 1</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Link 2</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Link 3</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Link 4</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </section>
            <!-- Section: Links -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            TopCine © 2022. Todos los derechos reservados:
            <a class="text-white" href="https://mdbootstrap.com/">Grupo 5</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>