<?php
//session_start();

function createQR()
{
    $numced = $_SESSION['user'];
    require('../pdf/conexion.php');

    date_default_timezone_set("America/Mexico_City");
    $Date = date('Y-m-d');

    $sql1 = "SELECT FACTURA.ID_FACTURA, PELICULA.TITULO_PELICULA, DETALLE_PELICULA.COSTO_DETPEL, PELICULA.IDIOMA_PELICULA, FUNCION.FECHAPELI_FUNCION, FUNCION.HORA_FUNCION, DETALLE_PELICULA.NUMBOLETOS_DETPEL, DETALLE_PELICULA.COSTO_DETPEL, CLIENTE.NUMCED_CLI, CLIENTE.NOMBRE_CLI FROM `FUNCION`
    INNER JOIN `PELICULA` ON PELICULA.ID_PELICULA = FUNCION.ID_PELICULA
    INNER JOIN `DETALLE_PELICULA` ON DETALLE_PELICULA.ID_FUNCION = FUNCION.ID_FUNCION
    INNER JOIN `FACTURA`  ON FACTURA.ID_FACTURA = DETALLE_PELICULA.ID_FACTURA
    INNER JOIN `CLIENTE` ON CLIENTE.NUMCED_CLI = FACTURA.NUMCED_CLI
    WHERE CLIENTE.NUMCED_CLI = $numced AND FACTURA.ID_FACTURA = (SELECT MAX(FACTURA.ID_FACTURA) FROM FACTURA WHERE FACTURA.NUMCED_CLI = $numced)";
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
    FACTURA.NUMCED_CLI = $numced
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

    FACTURA.NUMCED_CLI = $numced;";

    $result = $pdo->query($sql2);
    $resultado2 = $result->fetchAll(PDO::FETCH_ASSOC);

    $salida1 = 'Titulo Pelicula: ' . $resultado1[0]['TITULO_PELICULA'] . ' Numero Boletos: ' . $resultado1[0]['NUMBOLETOS_DETPEL'] . ' Fecha: ' . $resultado1[0]['FECHAPELI_FUNCION'];
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
