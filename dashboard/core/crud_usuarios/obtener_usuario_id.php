<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}
function obtenerUserbyID($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("SELECT *FROM CLIENTE WHERE NUMCED_CLI = ?");
    $sentencia->execute([$id]);
    return $sentencia->fetchObject();
}
$producto = obtenerUserbyID($_GET["id"]);
echo json_encode($producto);