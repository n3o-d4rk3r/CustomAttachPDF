<?php
require('fpdf/fpdf.php');
/*******************************************************************************
* CustomAttachPDF                                                                          *
*                                                                              *
* Version: 1.0                                                                 *
* Date:    2024-03-17                                                          *
* Author:  Md Kabir Hassan                                                     *
* Linkedin: https://www.linkedin.com/in/ictd-kabir                             *
*******************************************************************************/
class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', '', 12);
        $this->Ln(10);
        $imagePath = $upload_dir['basedir'] . "/2024/03/logo.jpg";
        $this->Image($imagePath, 55, 10, 100);
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
    }
}

$pdf = new PDF();
$pdf->AddPage();

$upload_dir = wp_upload_dir();
$imageWidth = 80; 
$imageHeight = 0;
$pdf->Image($imagePath, ($pdf->GetPageWidth() - $imageWidth) / 2, $pdf->GetY(), $imageWidth);
    

$pdf->SetFont('Arial', '', 18);
$pdf->Cell(95, 8, 'Wedding Dress Cleaners', 0, 0);
$pdf->SetFont('Arial', '', 18); // Change font size
$pdf->Cell(95, 8, 'Invoice No: WDC-24-' . $invoice_number, 0, 1, 'R');

$pdf->Ln(1);
$pdf->Ln(1);

$pdf->SetFont('Arial', '', 18);
$company_info = "1/R3 Gopalpur\nNatore\nRajshahi\n6623\n";
$pdf->MultiCell(0, 8, $company_info, 0, 'L');



$pdf->Ln(20);
$pdf->SetLineWidth(0.5);
$pdf->Cell(190, 0, '', 'T');

$pdf->Ln(0); // Move to the next line
$pdf->SetFont('Arial', '', 13);
$customer_address = str_replace("<br/>", "\n", $customer_address);
$pdf->MultiCell(0, 8,'Sender: ' . $customer_address . "\nPhone Number: " . $phone_number, 0, 'L');

$pdf_path = $upload_dir['basedir'] . '/' . $filename;
$pdf->Output($pdf_path, 'F');

return $pdf_path;
?>
