<?php
function createQR()
{

    require('../pdf/conexion.php');

    date_default_timezone_set("America/Mexico_City");
    $Date = date('Y-m-d');

    $numced = 1726639410; // cookie

    $sql1 = "SELECT NOMBRE_CLI, titulo_pelicula, NUMBOLETOS_DETPEL, FECHCOMP_FACTURA, VALTOTAL_FACTURA
    from CLIENTE, FACTURA, DETALLE_PELICULA, PELICULA
    where CLIENTE.NUMCED_CLI=  $numced
        and FACTURA.NUMCED_CLI = $numced
        and FECHCOMP_FACTURA = '$Date'
        and FACTURA.ID_FACTURA = DETALLE_PELICULA.ID_FACTURA
        and DETALLE_PELICULA.ID_DETPEL = PELICULA .ID_PELICULA;";
    $result = $pdo->query($sql1);
    $resultado1 = $result->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = "SELECT

    COMBOS.NOMB_COMBO AS 'NOMB_PROD',
    COMBOS.DESCRIP_COMBO AS 'DESCRIP_PROD',
    DETALLE_DULCERIA.CANTIDAD_DETDUL

FROM COMBOS

    INNER JOIN DETALLE_DULCERIA ON DETALLE_DULCERIA.ID_COMBO = COMBOS.ID_COMBO
    INNER JOIN FACTURA ON DETALLE_DULCERIA.ID_FACTURA = FACTURA.ID_FACTURA

WHERE
    FACTURA.NUMCED_CLI = 1726639410
    /*Filtra COMBOS o SNACKs comprados según el usuario AND FECHA*/

UNION

SELECT
    SNACK.NOMBRE_SNACK AS 'NOMB_PROD',
    SNACK.NOMBRE_SNACK AS 'DESCRIP_PROD',
    DETALLE_DULCERIA.CANTIDAD_DETDUL

FROM DETALLE_DULCERIA

    INNER JOIN SNACK ON DETALLE_DULCERIA.ID_SNACK = SNACK.ID_SNACK
    INNER JOIN FACTURA ON DETALLE_DULCERIA.ID_FACTURA = FACTURA.ID_FACTURA

WHERE

    FACTURA.NUMCED_CLI = 1726639410;";

    $result = $pdo->query($sql2);
    $resultado2 = $result->fetchAll(PDO::FETCH_ASSOC);

    $salida1 = 'Titulo Pelicula: ' . $resultado1[0]['titulo_pelicula'] . ' Numero Boletos: ' . $resultado1[0]['NUMBOLETOS_DETPEL'] . ' Fecha: ' . $resultado1[0]['FECHCOMP_FACTURA'];
    $salida2 = nl2br("\n");
    foreach ($resultado2 as $row) {
        $salida2 .= nl2br('Dulce: ' . $row['NOMB_PROD'] . '  Cantidad: ' . $row['CANTIDAD_DETDUL'] . "\n");
    }

    $salida = $salida1 . $salida2;
    $salida = str_replace("<br />", "", $salida);
    // include QR_BarCode class
    include "QR_BarCode.php";

    // QR_BarCode object
    $qr = new QR_BarCode();

    // create text QR code
    $qr->text($salida);

    // save QR code

    $name = $resultado1[0]['NOMBRE_CLI'];
    $path = '../QR/QRs/' . $name . '.png';

    $qr->qrCode(350, $path);

    // show QR code
    //$qr->qrCode();

    //delete QR code
    //unlink('../recursos/QR/name.png');

}