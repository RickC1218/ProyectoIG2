<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}

function eliminarCombo($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("DELETE FROM COMBOS WHERE ID_COMBO = ?");
    $count = 1;
    $refresh = $conexion->prepare("ALTER TABLE COMBOS AUTO_INCREMENT = 1 AND TRUNCATE COMBOS;");
    $refresh->execute();
    return $sentencia->execute([$id]);
}

$respuesta = eliminarCombo($_GET["id"]);
echo json_encode($respuesta);