<?php
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM PELICULA ORDER BY ESTRENO_PELICULA");
$consulta->execute();
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $key => $data) {
    echo "                
        <div id='cajaPelicula' class='col-xl-3 col-lg-3 col-md-4 col-sm-5 mx-1 border'>
            <div class='inicial'>
                <div id='tarjeta'>
                    <div id='posterPelicula'>
                        <img class='img-rounded' src='" . $data['IMAGEN_PELICULA'] . "'/>
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
                        </div>     
                        <button type='button' class='btn boton-cerrar' id='boton'>
                            <h5>Comprar boletos</h5>
                        </button>
                    </div>
                </div>              
            </div>
        </div>";
}
