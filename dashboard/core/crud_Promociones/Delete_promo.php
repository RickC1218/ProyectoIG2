<?
include '../autoIncrement.php';
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}

function eliminarPromo($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("DELETE FROM PROMOCION WHERE ID_PROMOCION = ?");
    $sentencia->execute([$id]);
    setAutoIncrement($conexion, $id,'PROMOCION','ID_PROMOCION');
    return $sentencia;
}

$respuesta = eliminarPromo($_GET["id"]);
echo json_encode($respuesta);