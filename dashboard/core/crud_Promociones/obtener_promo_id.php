<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}
function obtenerPromobyID($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("SELECT *FROM PROMOCION WHERE ID_PROMOCION = ?");
    $sentencia->execute([$id]);
    return $sentencia->fetchObject();
}
$producto = obtenerPromobyID($_GET["id"]);
echo json_encode($producto);