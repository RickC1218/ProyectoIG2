<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}
function obtenerSalabyID($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("SELECT *FROM SALA WHERE ID_SALA = ?");
    $sentencia->execute([$id]);
    return $sentencia->fetchObject();
}
$producto = obtenerSalabyID($_GET["id"]);
echo json_encode($producto);