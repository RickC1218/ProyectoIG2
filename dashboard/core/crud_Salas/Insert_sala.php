<?php
function GuardarSala($Aforo,$Estado_Sala)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("INSERT INTO SALA (TOTALASIENTOS_SALA, ESTADO_SALA) VALUES(?, ?);");
    $prueba =  $sentencia->execute([$Aforo,$Estado_Sala]);
    return $prueba;
}



$cargaUtil = json_decode(file_get_contents("php://input"));
// Si no hay datos, salir inmediatamente indicando un error 500
if (!$cargaUtil) {
    http_response_code(500);
    exit;
}

$Aforo = $cargaUtil->Aforo;
$Estado_Sala = $cargaUtil->Estado_Sala;



$respuesta = GuardarSala($Aforo,$Estado_Sala);

echo json_encode($respuesta);


