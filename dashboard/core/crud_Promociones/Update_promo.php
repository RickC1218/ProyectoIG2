<?php

function actualizarPromo($Descripcion_promo,$Categoria_Promo,$Banner_Promo,$id_Promo)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("UPDATE PROMOCION SET DESCRIPCION_PROMOCION = ?, CATEGORIA_PROMOCION =?, IMG_PROMOCION =? WHERE ID_PROMOCION = ?");
    return $sentencia->execute([$Descripcion_promo,$Categoria_Promo,$Banner_Promo,$id_Promo]);
}
$cargaUtil = json_decode(file_get_contents("php://input"));

if (!$cargaUtil) {
    http_response_code(500);
    exit;
}
$id_Promo = $cargaUtil->N_Id_Promo;
$Descripcion_promo = $cargaUtil->N_Descripcion_promo;
$Categoria_Promo = $cargaUtil->N_Categoria_Promo;
$Banner_Promo = $cargaUtil->N_Banner_Promo;


$respuesta = actualizarPromo($Descripcion_promo,$Categoria_Promo,$Banner_Promo,$id_Promo);
echo json_encode($respuesta);