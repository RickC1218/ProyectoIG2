<?php

function actualizarCombo($Nombre_Combo,$Descripcion_Combo,$Precio_Combo,$Banner_Combo,$id_Combo)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("UPDATE COMBOS SET NOMB_COMBO = ?, DESCRIP_COMBO =?, PRECIO_COMBO =?, IMG_COMBO=? WHERE ID_COMBO = ?");
    return $sentencia->execute([$Nombre_Combo,$Descripcion_Combo,$Precio_Combo,$Banner_Combo,$id_Combo]);
}
$cargaUtil = json_decode(file_get_contents("php://input"));

if (!$cargaUtil) {
    http_response_code(500);
    exit;
}
$id_Combo = $cargaUtil->N_Id_Combo;
$Nombre_Combo = $cargaUtil->N_Nombre_Combo;
$Descripcion_Combo = $cargaUtil->N_Descripcion_Combo;
$Precio_Combo = $cargaUtil->N_Precio_Combo;
$Banner_Combo = $cargaUtil->N_Banner_Combo;


$respuesta = actualizarCombo($Nombre_Combo,$Descripcion_Combo,$Precio_Combo,$Banner_Combo,$id_Combo);
echo json_encode($respuesta);