<?php
    require 'fpdf/fpdf.php';

    class PDF extends FPDF
    {
        function Header()
        {
            $this->Image('recursos/imagenes/logo-TopCine.png', 5, 5, 30);
            $this->SetFont('Arial', 'B',20);
            $this->Cell(30);
            $this->SetX(50);
            $this->Cell(100,10, 'TopCine', 0, 1, 'C');
            $this->SetX(50);
            $this->SetFont('Arial', 'B',18);
            $this->Cell(100,10, 'Anywhere, anytime, anyplace', 0, 1, 'C');
            $this->Cell(50, 25, 'Factura de compra', 0,0,'C');

            $this->Ln(20);
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I',8);
            $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,'C');
        }
    }

?>