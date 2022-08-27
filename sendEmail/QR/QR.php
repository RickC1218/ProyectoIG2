<?php
function createQR(){
        
    require ('../pdf/conexion.php');

    date_default_timezone_set("America/Mexico_City");
    $Date = date('Y-m-d');

    $numced= 1726639410;

    $sql2 = "SELECT NOMBRE_CLI, titulo_pelicula, NUMBOLETOS_DETPEL, FECHCOMP_FACTURA, VALTOTAL_FACTURA
    from CLIENTE, FACTURA, DETALLE_PELICULA, PELICULA
    where CLIENTE.NUMCED_CLI=  $numced
        and FACTURA.NUMCED_CLI = $numced
        and FECHCOMP_FACTURA = '$Date'
        and FACTURA.ID_FACTURA = DETALLE_PELICULA.ID_FACTURA
        and DETALLE_PELICULA.ID_DETPEL = PELICULA .ID_PELICULA;";
    $result = $pdo->query($sql2);
    $resultado2 = $result->fetchAll(PDO::FETCH_ASSOC);

    $salida = 'Titulo Pelicula: '.$resultado2[0]['titulo_pelicula'].' Numero Boletos: '.$resultado2[0]['NUMBOLETOS_DETPEL'].' Fecha: '.$resultado2[0]['FECHCOMP_FACTURA'].' Valor: '.$resultado2[0]['VALTOTAL_FACTURA'];

    // include QR_BarCode class
    include "QR_BarCode.php";

    // QR_BarCode object
    $qr = new QR_BarCode();

    // create text QR code
    $qr->text($salida);

    // save QR code

    $name = $resultado2[0]['NOMBRE_CLI'];
    $path = '../QR/QRs/'.$name.'.png';

    $qr->qrCode(350,$path);

    // show QR code
    //$qr->qrCode();

    //delete QR code
    //unlink('../recursos/QR/name.png');

}
?>