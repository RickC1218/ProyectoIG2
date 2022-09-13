<?php
function actualizarPelicula($Nombre_Pelicula, $Actores_Principales, $Actores_Secundarios, $Idioma, $Estreno, $Banner, $Duracion, $Sinopsis,$id_Pelicula)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("UPDATE PELICULA SET TITULO_PELICULA = ?, ACTPRIN_PELICULA =?, ACTSECUN_PELICULA =?, IDIOMA_PELICULA =?,
    ESTRENO_PELICULA =?, IMAGEN_PELICULA =?, DURACION_PELICULA=?, SINOPSIS_PELICULA=? WHERE ID_PELICULA = ?");
    return $sentencia->execute([$Nombre_Pelicula, $Actores_Principales, $Actores_Secundarios, $Idioma, $Estreno, $Banner, $Duracion, $Sinopsis,$id_Pelicula]);
}
$cargaUtil = json_decode(file_get_contents("php://input"));

if (!$cargaUtil) {
    http_response_code(500);
    exit;
}
$id_Pelicula = $cargaUtil->N_Id_Pelicula;
$Nombre_Pelicula = $cargaUtil->N_Nombre_Pelicula;
$Actores_Principales = $cargaUtil->N_Actores_Principales;
$Actores_Secundarios = $cargaUtil->N_Actores_Secundarios;
$Idioma = $cargaUtil->N_Idioma;
$Estreno = $cargaUtil->N_Estreno;
$Banner = $cargaUtil->N_Banner_Pelicula;
$Duracion = $cargaUtil->N_Duracion;
$Sinopsis = $cargaUtil->N_Sinopsis;


$respuesta = actualizarPelicula($Nombre_Pelicula,$Actores_Principales,$Actores_Secundarios,$Idioma,$Estreno,$Banner,$Duracion,$Sinopsis,$id_Pelicula);

echo json_encode($respuesta);
?>
