<?php
function GuardarPelicula($Nombre_Pelicula,$Actores_Principales,$Actores_Secundarios,$Idioma,$Estreno,$Banner,$Duracion,$Sinopsis)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("INSERT INTO PELICULA (TITULO_PELICULA,ACTPRIN_PELICULA,ACTSECUN_PELICULA,IDIOMA_PELICULA,ESTRENO_PELICULA,IMAGEN_PELICULA, DURACION_PELICULA,SINOPSIS_PELICULA) VALUES(?, ?, ?, ?, ?, ?, ?, ?);");
    $prueba =  $sentencia->execute([$Nombre_Pelicula, $Actores_Principales, $Actores_Secundarios, $Idioma, $Estreno, $Banner, $Duracion, $Sinopsis]);
    return $prueba;
}



$cargaUtil = json_decode(file_get_contents("php://input"));
// Si no hay datos, salir inmediatamente indicando un error 500
if (!$cargaUtil) {
    http_response_code(500);
    exit;
}


$Nombre_Pelicula = $cargaUtil->Nombre_Pelicula;
$Actores_Principales = $cargaUtil->Actores_Principales;
$Actores_Secundarios = $cargaUtil->Actores_Secundarios;
$Idioma = $cargaUtil->Idioma;
$Estreno = $cargaUtil->Estreno;
$Banner = $cargaUtil->Banner_Pelicula;
$Duracion = $cargaUtil->Duracion;
$Sinopsis = $cargaUtil->Sinopsis;


$respuesta = GuardarPelicula($Nombre_Pelicula,$Actores_Principales,$Actores_Secundarios,$Idioma,$Estreno,$Banner,$Duracion,$Sinopsis);

echo json_encode($respuesta);


