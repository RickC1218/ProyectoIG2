<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}
function obtenerCombobyID($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("SELECT *FROM COMBOS WHERE ID_COMBO = ?");
    $sentencia->execute([$id]);
    return $sentencia->fetchObject();
}
$producto = obtenerCombobyID($_GET["id"]);
echo json_encode($producto);