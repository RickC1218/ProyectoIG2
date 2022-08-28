<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}

function eliminarUsuario($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("DELETE FROM CLIENTE WHERE NUMCED_CLI = ?");
    $count = 1;
    $refresh = $conexion->prepare("ALTER TABLE CLIENTE AUTO_INCREMENT = 1 AND TRUNCATE CLIENTE");
    $refresh->execute();
    return $sentencia->execute([$id]);
}

$respuesta = eliminarUsuario($_GET["id"]);
echo json_encode($respuesta);