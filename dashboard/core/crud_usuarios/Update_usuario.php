<?php

function actualizarUsuario($N_Nombre_Cli,$N_Apellidos_Cli,$N_Fecha_cli,$N_email_Cli,$N_pass_Cli,$N_Ci_Cli)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("UPDATE CLIENTE SET NOMBRE_CLI = ?, APELLIDO_CLI = ?, FECHANACIMIENTO_CLI = ?, EMAIL_CLI = ?, CONTRASENA_CLI = ? WHERE NUMCED_CLI = ?");
    return $sentencia->execute([$N_Nombre_Cli,$N_Apellidos_Cli,$N_Fecha_cli,$N_email_Cli,$N_pass_Cli,$N_Ci_Cli]);
}
$cargaUtil = json_decode(file_get_contents("php://input"));

if (!$cargaUtil) {
    http_response_code(500);
    exit;
}
$N_Ci_Cli = $cargaUtil->N_Ci_Cli;
$N_Nombre_Cli = $cargaUtil->N_Nombre_Cli;
$N_Apellidos_Cli = $cargaUtil->N_Apellidos_Cli;
$N_Fecha_Cli = $cargaUtil->N_Fecha_Cli;
$N_email_Cli = $cargaUtil->N_email_Cli;
$N_pass_Cli = $cargaUtil->N_pass_Cli;

$respuesta = actualizarUsuario($N_Nombre_Cli,$N_Apellidos_Cli,$N_Fecha_Cli,$N_email_Cli,$N_pass_Cli,$N_Ci_Cli);
echo json_encode($respuesta);