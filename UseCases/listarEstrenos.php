<?php
session_start();

require "../Entities/conexion.php";
$consulta = $conexion->prepare("SELECT * FROM PELICULA ORDER BY ESTRENO_PELICULA");
$consulta->execute();
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $key => $data) {
    echo "                
        <div id='cajaPelicula' class='col-xl-3 col-lg-3 col-md-4 col-sm-5 mx-1 border'>
            <div class='inicial'>
                <div id='tarjeta'>
                    <div id='posterPelicula'>
                        <img class='img-rounded' src='../" . $data['IMAGEN_PELICULA'] . "'/>
                    </div>
                    <div class='category'>
                        <h5><strong>" . $data['TITULO_PELICULA'] . "</strong></h5>
                        <h6>" . $data['ESTRENO_PELICULA'] . "</h6>
                    </div>
                </div>
                <div id='infoPelicula' class='info'>
                    <div class='row'>
                        <div class='col-12'>
                            <h6><strong>Duración: </strong></h6>
                            <p>" . $data['DURACION_PELICULA'] . " min</p>
                        </div>
                        <div class='col-12'>
                            <h6><strong>Estrellas principales: </strong></h6>
                            <p>" . $data['ACTPRIN_PELICULA'] . "</p>
                            <h6><strong>Estrellas secundarios: </strong></h6>
                            <p>" . $data['ACTSECUN_PELICULA'] . "</p>
                        </div>
                        <div class='col-12'>
                            <p><strong>SINÓPSIS: </strong>" . $data['SINOPSIS_PELICULA'] . "</p>
                        </div>
                        <div class='col-12'>
                            <h6><strong>Idioma disponible: </strong></h6>
                            <p>" . $data['IDIOMA_PELICULA'] . "</p>
                        </div>";
                        if (isset($_SESSION['user'])) {
                            echo"<a style='text-decoration:none; pading: 30px; border-radius:30px color:white;' href='../Controller/Estrenos.php?ID=${data['ID_PELICULA']}'>
                            <button type='button' class='btn boton-cerrar' id='boton'>Comprar Boletos</button>
                            </a>";
                        }else{
                            echo"<a style='text-decoration:none; pading: 30px; border-radius:30px color:white;' href='../UI/login.html'>
                            <button type='button' class='btn boton-cerrar' id='boton'>Inicia Sesion para comprar</button>
                            </a>";
                        }
                        
                        
                    echo"
                    </div>
                </div>              
            </div>
        </div>";
}
