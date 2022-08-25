<?php
// include QR_BarCode class
include "QR_BarCode.php";

// QR_BarCode object
$qr = new QR_BarCode();

// create text QR code
$qr->text('Prueba 1');

// save QR code

$qr->qrCode(350,'../recursos/QR/name.png');

// show QR code
$qr->qrCode();

//delete QR code
//unlink('../recursos/QR/name.png');

?>