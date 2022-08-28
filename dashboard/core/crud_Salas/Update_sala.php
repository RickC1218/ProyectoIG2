<?php

function actualizarSala($N_Aforo,$N_Estado_Sala,$N_Id_Sala)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("UPDATE SALA SET TOTALASIENTOS_SALA = ?, ESTADO_SALA = ? WHERE ID_SALA = ?");
    return $sentencia->execute([$N_Aforo,$N_Estado_Sala,$N_Id_Sala]);
}
$cargaUtil = json_decode(file_get_contents("php://input"));

if (!$cargaUtil) {
    http_response_code(500);
    exit;
}
$N_Aforo = $cargaUtil->N_Aforo;
$N_Estado_Sala = $cargaUtil->N_Estado_Sala;
$N_Id_Sala = $cargaUtil->Id_Sala;


$respuesta = actualizarSala($N_Aforo,$N_Estado_Sala,$N_Id_Sala);
echo json_encode($respuesta);