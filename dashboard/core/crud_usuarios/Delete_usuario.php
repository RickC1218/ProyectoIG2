<?php
include '../autoIncrement.php';
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}

function eliminarUsuario($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("DELETE FROM CLIENTE WHERE NUMCED_CLI = ?");
    setAutoIncrement($conexion, $id,'CLIENTE','NUMCED_CLI');
    return $sentencia->execute([$id]);
}

$respuesta = eliminarUsuario($_GET["id"]);
echo json_encode($respuesta);