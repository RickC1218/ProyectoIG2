<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}

function eliminarPromo($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("DELETE FROM PROMOCION WHERE ID_PROMOCION = ?");
    $count = 1;
    $refresh = $conexion->prepare("ALTER TABLE PROMOCION AUTO_INCREMENT = 1 AND TRUNCATE PROMOCION;");
    $refresh->execute();
    return $sentencia->execute([$id]);
}

$respuesta = eliminarPromo($_GET["id"]);
echo json_encode($respuesta);