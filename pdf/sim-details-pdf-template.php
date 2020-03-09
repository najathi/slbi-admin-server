<?php
include_once 'lib/pdf_fancyrow_order_copy.php';
//include_once 'pdf_mc_table_order.php';

class PDF extends PDF_FancyRow
{
    // Page header
    public function Header()
    {
        // Logo
        $this->Image('../assets/images/pdf/slbi.png', 10, 10, 45, 35);

        // text
        $this->SetFont('Arial', 'B', 17);
        $this->ln(3);
        $this->cell(50);
        $this->cell(10, 6, 'SUCCESS LANKAN BUSINESS IDEAS (PVT) LTD', 0, 1, 'L');
        $this->cell(50);
        $this->SetFont('Arial', 'B', 10);
        $this->cell(10, 6, 'NO.563/2, HAJIYAR ROAD, NINTHAVUR - 05', 0, 1, 'L');
        $this->cell(50);
        $this->cell(10, 6, 'TEL: 0777387723 / 0774788222 / 0772244608 / 0772333180', 0, 1, 'L');
        $this->cell(50);
        $this->cell(10, 6, 'Email : info@slbi.lk', 0, 1, 'L');
        $this->cell(50);
        $this->cell(10, 6, 'Web: www.slbi.lk', 0, 0, 'L');

        // Move to the right
        $this->Ln(20);
    }
    // Page footer
    public function Footer()
    {
        // Footer Text
        $this->SetFont('Arial', 'I', 9);
        $this->setY(-20);

        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
//        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}
