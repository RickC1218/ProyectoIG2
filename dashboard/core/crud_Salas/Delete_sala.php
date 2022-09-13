<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}

function eliminarSala($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("DELETE FROM SALA WHERE ID_SALA = ?");
    $sentencia->execute([$id]);
    setAutoIncrement($conexion, $id,'COMBOS','ID_SALA');
    return $sentencia;
}

$respuesta = eliminarSala($_GET["id"]);
echo json_encode($respuesta);