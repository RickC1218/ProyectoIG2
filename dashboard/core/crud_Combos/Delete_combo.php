<?php
    include '../autoIncrement.php';

if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}

function eliminarCombo($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("DELETE FROM COMBOS WHERE ID_COMBO = ?");
    $sentencia->execute([$id]);
    setAutoIncrement($conexion, $id,'COMBOS','ID_COMBO');
    return $sentencia;
}

$respuesta = eliminarCombo($_GET["id"]);
echo json_encode($respuesta);