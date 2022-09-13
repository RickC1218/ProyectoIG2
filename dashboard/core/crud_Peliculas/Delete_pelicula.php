<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}

function eliminarPelicula($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("DELETE FROM PELICULA WHERE ID_PELICULA = ?");
    $sentencia->execute([$id]);
    setAutoIncrement($conexion, $id,'PELICULA','ID_PELICULA');
    return $sentencia;
}

$respuesta = eliminarPelicula($_GET["id"]);
echo json_encode($respuesta);