<?php

if (isset($_REQUEST['id'])) {
    include_once '../includes/connection/dbh.inc.php';
    $id = $_REQUEST['id'];

    $queryPdf = "SELECT * FROM employees WHERE employees.id = '" . $id . "' ORDER BY updated_at";
    $resultPdf = mysqli_query($conn, $queryPdf) or die(mysqli_error($conn));
    $rowPdf = mysqli_fetch_array($resultPdf);

    $id = $rowPdf['id'];
    $namee = $rowPdf['namee'];
    $address_l_one = $rowPdf['address_l_one'];
    $address_l_two = $rowPdf['address_l_two'];
    $nic_no = $rowPdf['nic_no'];
    $nic_f_img = $rowPdf['nic_f_img'];
    $nic_b_img = $rowPdf['nic_b_img'];
    $m_no = $rowPdf['m_no'];
    $designation = $rowPdf['designation'];
    $gn_div = $rowPdf['gn_div'];
    $ds_div = $rowPdf['ds_div'];
    $district = $rowPdf['district'];
    $sim_no = $rowPdf['sim_no'];
    $sim_s_no = $rowPdf['sim_s_no'];
    $user_id = $rowPdf['user_id'];
    $updated_at = $rowPdf['updated_at'];


    // PDF Class
    include_once 'sim-details-pdf-template.php';

    // PDF Creaion
    $pdf = new PDF();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(10);
    $pdf->SetAligns(array('C'));
    $pdf->FancyRow(array('Employee Form'), array(''), array('C'), ['UB']);
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 12);
    $pdf->SetWidths(array(70, 100));
    $pdf->SetLineHeight(10);
    $pdf->SetAligns(array('L'));
    $lineSpace = 3;
    $pdf->FancyRow(array('Name: ', $namee), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->Ln($lineSpace);
    $pdf->FancyRow(array('Address: ', $address_l_one), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->FancyRow(array('', $address_l_two), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->Ln($lineSpace);
    $pdf->FancyRow(array('NIC No. ', $nic_no), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->Ln($lineSpace);
    $pdf->FancyRow(array('Mobile No. ', $m_no), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->Ln($lineSpace);
    $pdf->FancyRow(array('Designation: ', $designation), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->Ln($lineSpace);
    $pdf->FancyRow(array('GN Division: ', $gn_div), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->Ln($lineSpace);
    $pdf->FancyRow(array('DS Division: ', $ds_div), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->Ln($lineSpace);
    $pdf->FancyRow(array('District: ', $district), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->Ln($lineSpace);
    $pdf->FancyRow(array('Provided Sim number: ', $sim_no), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->Ln($lineSpace);
    $pdf->FancyRow(array('Provided Sim Serial number:  ', $sim_s_no), array('', ''), array('', 'L'), ['', 'B']);

    // Signature Part
    $pdf->Ln(20);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 5, '-----------------------------------------------', 0, 0);
    $pdf->Cell(40, 5, '', 0, 0);
    $pdf->Cell(30, 5, '', 0, 0);
    $pdf->Cell(40, 5, '', 0, 0);
    $pdf->Cell(30, 5, '-----------------------------------------------', 0, 1);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(30, 5, 'Date', 0, 0, '');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, '', 0, 0);
    $pdf->Cell(30, 5, '', 0, 0, 'C');
    $pdf->Cell(45, 5, '', 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(30, 5, 'Signature of Employee', 0, 1, 'C');
    $pdf->Ln(15);

    // office use
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(10);
    $pdf->SetAligns(array('C'));
    $pdf->FancyRow(array('For Office use Only'), array(''), array('C'), ['UB']);
    $pdf->Ln(15);

    $pdf->SetFont('Arial', '', 12);
    $pdf->SetWidths(array(60, 100));
    $pdf->SetLineHeight(10);
    $pdf->SetAligns(array('L'));
    $lineSpace = 3;
    $pdf->FancyRow(array('SLBI Membership No: ', '---------------------------------------------------------------'), array('', ''), array('', 'L'), ['', 'B']);
    $pdf->Ln($lineSpace);

    // Signature Part
    $pdf->Ln(20);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 10, '', 0, 0);
    $pdf->Cell(40, 10, '', 0, 0);
    $pdf->Cell(30, 10, '', 0, 0);
    $pdf->Cell(40, 10, '', 0, 0);
    $pdf->Cell(30, 10, '-----------------------------------------------', 0, 1);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(30, 10, '', 0, 0, '');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 10, '', 0, 0);
    $pdf->Cell(30, 10, '', 0, 0, 'C');
    $pdf->Cell(45, 10, '', 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(30, 10, 'Authorised Signatory', 0, 1, 'C');

    $pdf->Output();
}
