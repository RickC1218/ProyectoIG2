<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}
function obtenerPeliculabyID($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("SELECT *FROM PELICULA WHERE ID_PELICULA = ?");
    $sentencia->execute([$id]);
    return $sentencia->fetchObject();
}
$producto = obtenerPeliculabyID($_GET["id"]);
echo json_encode($producto);