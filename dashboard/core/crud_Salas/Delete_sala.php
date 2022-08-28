<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}

function eliminarSala($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("DELETE FROM SALA WHERE ID_SALA = ?");
    $count = 1;
    $refresh = $conexion->prepare("ALTER TABLE SALA AUTO_INCREMENT = 1 AND TRUNCATE SALA");
    $refresh->execute();
    return $sentencia->execute([$id]);
}

$respuesta = eliminarSala($_GET["id"]);
echo json_encode($respuesta);