<?php
session_start();
include 'plantilla.php';
require 'conexion.php';
require '../email/correoFactura.php';
include '../QR/QR.php';
//require '../css/base';

date_default_timezone_set("America/Mexico_City");
$Date = date('Y-m-d');

$numced = $_SESSION['user'];
//Consulta cliente
$consulta1 = $pdo->prepare("SELECT NUMCED_CLI, NOMBRE_CLI, APELLIDO_CLI FROM CLIENTE where NUMCED_CLI = $numced;");
$consulta1->execute();
$resultado1 = $consulta1->fetchAll(PDO::FETCH_ASSOC);

//Consulta pelicula
$consulta2 = $pdo->prepare("SELECT FACTURA.ID_FACTURA, PELICULA.TITULO_PELICULA, DETALLE_PELICULA.COSTO_DETPEL, PELICULA.IDIOMA_PELICULA, FUNCION.FECHAPELI_FUNCION, FUNCION.HORA_FUNCION, DETALLE_PELICULA.NUMBOLETOS_DETPEL, DETALLE_PELICULA.COSTO_DETPEL, CLIENTE.NUMCED_CLI FROM `FUNCION`
INNER JOIN `PELICULA` ON PELICULA.ID_PELICULA = FUNCION.ID_PELICULA
INNER JOIN `DETALLE_PELICULA` ON DETALLE_PELICULA.ID_FUNCION = FUNCION.ID_FUNCION
INNER JOIN `FACTURA`  ON FACTURA.ID_FACTURA = DETALLE_PELICULA.ID_FACTURA
INNER JOIN `CLIENTE` ON CLIENTE.NUMCED_CLI = FACTURA.NUMCED_CLI
WHERE CLIENTE.NUMCED_CLI = $numced AND FACTURA.ID_FACTURA = (SELECT MAX(FACTURA.ID_FACTURA) FROM FACTURA WHERE FACTURA.NUMCED_CLI = $numced);");
$consulta2->execute();
$resultado2 = $consulta2->fetchAll(PDO::FETCH_ASSOC);

//Consulta snacks
$consulta3 = $pdo->prepare("SELECT

    COMBOS.NOMB_COMBO AS 'NOMB_PROD',
    COMBOS.DESCRIP_COMBO AS 'DESCRIP_PROD',
    DETALLE_DULCERIA.CANTIDAD_DETDUL,
    DETALLE_DULCERIA.PRECIO_DETDUL

FROM COMBOS

    INNER JOIN DETALLE_DULCERIA ON DETALLE_DULCERIA.ID_COMBO = COMBOS.ID_COMBO
    INNER JOIN FACTURA ON DETALLE_DULCERIA.ID_FACTURA = FACTURA.ID_FACTURA

WHERE
    FACTURA.NUMCED_CLI = $numced
    /*Filtra COMBOS o SNACKs comprados según el usuario*/

UNION

SELECT
    SNACK.NOMBRE_SNACK AS 'NOMB_PROD',
    SNACK.NOMBRE_SNACK AS 'DESCRIP_PROD',
    DETALLE_DULCERIA.CANTIDAD_DETDUL,
    DETALLE_DULCERIA.PRECIO_DETDUL

FROM DETALLE_DULCERIA

    INNER JOIN SNACK ON DETALLE_DULCERIA.ID_SNACK = SNACK.ID_SNACK
    INNER JOIN FACTURA ON DETALLE_DULCERIA.ID_FACTURA = FACTURA.ID_FACTURA

WHERE

    FACTURA.NUMCED_CLI = $numced;");
$consulta3->execute();
$resultado3 = $consulta3->fetchAll(PDO::FETCH_ASSOC);

//Consulta total
$consulta4 = $pdo->prepare("SELECT VALTOTAL_FACTURA FROM FACTURA where NUMCED_CLI = $numced;");
$consulta4->execute();
$resultado4 = $consulta4->fetchAll(PDO::FETCH_ASSOC);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//consulta 1
$pdf->SetFont('Arial', 'B', 13);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(190, 10, utf8_decode('Gracias ' . $resultado1[0]['NOMBRE_CLI'] . ' ' . $resultado1[0]['APELLIDO_CLI'] . ', por preferirnos. Disfrute su compra...'), 0, 1, 'L', 1);
$pdf->Cell(190, 10, '', 0, 1, 'C', 1);

//consulta 2
$pdf->SetFillColor(6, 70, 99);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 8, utf8_decode('Boletos'), 1, 0, 'C', 1);
$pdf->Cell(25, 8, utf8_decode('Fecha'), 1, 0, 'C', 1);
$pdf->Cell(25, 8, utf8_decode('Cantidad'), 1, 0, 'C', 1);
$pdf->Cell(50, 8, 'Precio', 1, 1, 'C', 1);

$pdf->SetFillColor(204, 204, 204);
$pdf->SetTextColor(0, 0, 0);
foreach ($resultado2 as $key => $data) {
    $pdf->Cell(90, 8, utf8_decode($data['TITULO_PELICULA']), 1, 0, 'C', 1);
    $pdf->Cell(25, 8, $data['FECHAPELI_FUNCION'], 1, 0, 'C', 1);
    $pdf->Cell(25, 8, $data['NUMBOLETOS_DETPEL'], 1, 0, 'C', 1);
    $pdf->Cell(50, 8, '$ ' . $data['COSTO_DETPEL'], 1, 1, 'C', 1);
}

//consulta 3
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(190, 8, '', 0, 1, 'C', 1);
$pdf->SetFillColor(6, 70, 99);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, utf8_decode('Dulcería'), 1, 0, 'C', 1);
$pdf->Cell(40, 8, 'Cantidad', 1, 0, 'C', 1);
$pdf->Cell(50, 8, 'Precio', 1, 1, 'C', 1);

$pdf->SetFillColor(204, 204, 204);
$pdf->SetTextColor(0, 0, 0);
foreach ($resultado3 as $key => $data) {
    $pdf->Cell(100, 8, utf8_decode($data['NOMB_PROD']), 1, 0, 'C', 1);
    $pdf->Cell(40, 8, $data['CANTIDAD_DETDUL'], 1, 0, 'C', 1);
    $pdf->Cell(50, 8, '$ ' . $data['PRECIO_DETDUL'], 1, 1, 'C', 1);
}
//consulta 4
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(190, 8, '', 0, 1, 'C', 1);
$pdf->SetFillColor(6, 70, 99);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(110);
$pdf->Cell(30, 8, 'Total', 1, 0, 'C', 1);
$pdf->SetFillColor(204, 204, 204);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50, 8, '$ ' . $resultado4[0]['VALTOTAL_FACTURA'], 1, 1, 'C', 1);

//$pdf->Output();
$pdf->Output('F', '../email/docs/factura' . $resultado1[0]["NUMCED_CLI"] . '.pdf');
createQR();
sleep(5);
sendEmail();
unlink('../email/docs/factura' . $resultado1[0]["NUMCED_CLI"] . '.pdf'); // elimina el archivo factura.pdf
unlink('../QR/QRs/' . $resultado1[0]["NOMBRE_CLI"] . '.png');
