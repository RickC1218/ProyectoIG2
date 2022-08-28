<?php
function GuardarCombo($Nombre_Combo,$Descripcion_Combo,$Precio_Combo,$Banner_Combo)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("INSERT INTO COMBOS (NOMB_COMBO,DESCRIP_COMBO,PRECIO_COMBO,IMG_COMBO) VALUES(?, ?, ?, ?);");
    $prueba =  $sentencia->execute([$Nombre_Combo,$Descripcion_Combo,$Precio_Combo,$Banner_Combo]);
    return $prueba;
}



$cargaUtil = json_decode(file_get_contents("php://input"));
// Si no hay datos, salir inmediatamente indicando un error 500
if (!$cargaUtil) {
    http_response_code(500);
    exit;
}

$Nombre_Combo = $cargaUtil->Nombre_Combo;
$Descripcion_Combo = $cargaUtil->Descripcion_Combo;
$Precio_Combo = $cargaUtil->Precio_Combo;
$Banner_Combo = $cargaUtil->Banner_Combo;



$respuesta = GuardarCombo($Nombre_Combo,$Descripcion_Combo,$Precio_Combo,$Banner_Combo);

echo json_encode($respuesta);


