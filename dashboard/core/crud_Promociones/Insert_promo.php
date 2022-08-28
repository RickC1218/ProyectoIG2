<?php
function GuardarPromo($Descripcion_promo,$Categoria_Promo,$Banner_Promo)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("INSERT INTO PROMOCION (DESCRIPCION_PROMOCION,CATEGORIA_PROMOCION,IMG_PROMOCION) VALUES(?, ?, ?);");
    $prueba =  $sentencia->execute([$Descripcion_promo,$Categoria_Promo,$Banner_Promo]);
    return $prueba;
}



$cargaUtil = json_decode(file_get_contents("php://input"));
// Si no hay datos, salir inmediatamente indicando un error 500
if (!$cargaUtil) {
    http_response_code(500);
    exit;
}


$Descripcion_promo = $cargaUtil->Descripcion_promo;
$Categoria_Promo = $cargaUtil->Categoria_Promo;
$Banner_Promo = $cargaUtil->Banner_Promo;



$respuesta = GuardarPromo($Descripcion_promo,$Categoria_Promo,$Banner_Promo);

echo json_encode($respuesta);


