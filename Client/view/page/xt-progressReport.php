<?php

require_once('../../../TCPDF-main/tcpdf.php');

class PDF extends TCPDF{
  public function Header(){
    $imageFile = '../../../Client/view/images/taruc-logo.jpg';
    $this->Image($imageFile, 15, 10, 60, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    $this->Ln(3);
    $this->SetFont('times', 'B', 12);
    $this->Cell(230, 5, 'Tunku Abdul Rahman University College', 0, 1, 'C');

    $this->Ln(2);
    $this->Cell(230, 5, 'Faculty of Computing and Information Technology', 0, 1, 'C');

    $this->Ln(2);
    $this->Cell(230, 5, 'Industrial Training Progress Report', 0, 1, 'C');
  }

  public function Footer(){
    $this->setY(-18);
    $this->Ln(5);

    $this->SetFont('helvetica', 'I', 8);
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $today = date("F j, Y g:i A", time());

    $this->Cell(189, 5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
                //portrait or landscape
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('XT');
$pdf->SetTitle('Progress Report Template');
$pdf->SetSubject('Progress Report Template');
$pdf->SetKeywords('Progress Report Template');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
  require_once(dirname(__FILE__).'/lang/eng.php');
  $pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('times', '', 14, '', true);

$pdf->AddPage();

$pdf->Ln(23);

$pdf->SetFont('times', '', 12);
$pdf->Cell(189, 3, 'Name of Trainee:     _________________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Name of Company:  _________________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Month/Year:             _________________________________________________________________', 0, 1, 'L');
$pdf->Ln(8);

$pdf->SetFillColor(224, 235, 255);
$pdf->Cell(39, 10, 'Week', 1, 0, 'C', 1);
$pdf->Cell(135, 10, 'Projects / Activities', 1, 0, 'C', 1);

$pdf->Ln(10);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(39, 25, '1', 1, 0, 'C', 1);
$pdf->Cell(135, 25, ' ', 1, 0, 'C', 1);

$pdf->Ln(25);
$pdf->Cell(39, 25, '2', 1, 0, 'C', 1);
$pdf->Cell(135, 25, ' ', 1, 0, 'C', 1);

$pdf->Ln(25);
$pdf->Cell(39, 25, '3', 1, 0, 'C', 1);
$pdf->Cell(135, 25, ' ', 1, 0, 'C', 1);

$pdf->Ln(25);
$pdf->Cell(39, 25, '4', 1, 0, 'C', 1);
$pdf->Cell(135, 25, ' ', 1, 0, 'C', 1);

$pdf->Ln(30);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(189, 3, 'Suggestions / Comments / Additional information (if any): ', 0, 1, 'L');

$pdf->Ln(1);
$pdf->Cell(174, 15, ' ', 1, 0, 'C', 1);

$pdf->Ln(20);
$pdf->Cell(189, 3, 'Leave Application / Leave Taken', 0, 1, 'L');

$pdf->Ln(2);
$pdf->SetFont('times', '', 11);
$pdf->Cell(189, 3, '1. From (dd/mm/yyyy):		____________________ to (dd/mm/yyyy) ____________________	(      day(s))', 0, 1, 'L');
$pdf->Cell(189, 3, '2. Reasons for taking leave:		_____________________________________________________________', 0, 1, 'L');
$pdf->Cell(189, 3, '3. Total number of days taken:		___________________________________________________________', 0, 1, 'L');

$pdf->Ln(5);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(189, 3, 'I hereby declare that the information given above is correct.', 0, 1, 'L');

$pdf->Ln(11);
$pdf->Cell(100, 5, 'Signature: ____________________ ', ' ', 0, 0);
$pdf->Cell(38, 5, 'Date (dd/mm/yyyy): ____________________', ' ', 0, 1);

$pdf->AddPage();

$pdf->Ln(23);

$pdf->SetFont('times', 'B', 12);
$pdf->Cell(189, 3, 'Endorsement by the Company Supervisor:', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'The above is a true record of activities taken by the trainee in the captioned week.', 0, 1, 'L');
$pdf->Ln(10);

$pdf->SetFont('times', '', 12);
$pdf->Cell(189, 3, 'Signature of Supervisor:          __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Name of Supervisor:                __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Date (dd/mm/yyyy):                __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Email:                                      __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Mobile / Office Contact No.:   __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(53, 5, 'Company Stamp: ', 0, 0);
$pdf->MultiCell(123, 5, ' 




', 1, 1);
$pdf->Ln(5);

$pdf->Output('progress-report.pdf', 'I');
