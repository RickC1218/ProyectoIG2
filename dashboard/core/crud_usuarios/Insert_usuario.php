<?php
function GuardarUser($Ci_Cli,$Nombre_Cli,$Apellidos_Cli,$Fecha_cli,$email_Cli,$pass_Cli)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("INSERT INTO CLIENTE (NUMCED_CLI, NOMBRE_CLI, APELLIDO_CLI, FECHANACIMIENTO_CLI, EMAIL_CLI, CONTRASENA_CLI) VALUES(?, ?, ?, ?, ?, ?);");
    $prueba =  $sentencia->execute([$Ci_Cli,$Nombre_Cli,$Apellidos_Cli,$Fecha_cli,$email_Cli,$pass_Cli]);
    return $prueba;
}



$cargaUtil = json_decode(file_get_contents("php://input"));
// Si no hay datos, salir inmediatamente indicando un error 500
if (!$cargaUtil) {
    http_response_code(500);
    exit;
}

$Ci_Cli = $cargaUtil->Ci_Cli;
$Nombre_Cli = $cargaUtil->Nombre_Cli;
$Apellidos_Cli = $cargaUtil->Apellidos_Cli;
$Fecha_Cli = $cargaUtil->Fecha_Cli;
$email_Cli = $cargaUtil->email_Cli;
$pass_Cli = $cargaUtil->pass_Cli;



$respuesta = GuardarUser($Ci_Cli,$Nombre_Cli,$Apellidos_Cli,$Fecha_Cli,$email_Cli,$pass_Cli);

echo json_encode($respuesta);


