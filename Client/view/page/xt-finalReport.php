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
    $this->Cell(230, 5, 'Industrial Training Final Report', 0, 1, 'C');
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
$pdf->SetAuthor('ITP System');
$pdf->SetTitle('Final Report Template');
$pdf->SetSubject('Final Report Template');
$pdf->SetKeywords('Final Report Template');

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

$pdf->SetFont('times', 'B', 14);
$pdf->Cell(180, 3, 'At', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, '<Name of Company>', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, '<Address>', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'From <Start Date (dd/mm/yyyy)> To <End Date (dd/mm/yyyy)>', 0, 1, 'C');
$pdf->Ln(30);

$pdf->Cell(180, 3, 'Prepared By', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, '<Name of Student>', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, '<Programme>', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, '<Name of University College Supervisor>', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Faculty of Computing and Information Technology', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Tunku Abdul Rahman University of Management and Technology', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, '<Branch>', 0, 1, 'C');
$pdf->Ln(10);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Declaration', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(175, 15, 'The report submitted herewith is a result of my own work. All information that has been obtained from other sources had been fully acknowledged. I understand that plagiarism constitutes a breach of University College rules and regulations and would be subjected to disciplinary actions.', 0, 'J', 0, 1, '', '', true);

$pdf->Ln(5);
$pdf->Cell(189, 3, 'Signature', 0, 1, 'L');

$pdf->Ln(12);
$pdf->Cell(189, 3, '___________________', 0, 1, 'L');

$pdf->Ln(2);
$pdf->Cell(189, 3, '<Name of Student>', 0, 1, 'L');

$pdf->Ln(2);
$pdf->Cell(189, 3, 'Date (dd/mm/yyyy):', 0, 1, 'L');

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Acknowledgements', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', 'I', 12);
$pdf->Cell(189, 3, 'Expression of appreciation to the company, faculty, individuals, etc.', 0, 1, 'L');

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Abstract', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', 'I', 12);
$pdf->MultiCell(175, 15, 'Summary of report with 200 to 300 words. It is to be written in the past tense. The abstract description should include the organisation and department with which the student was attached to, the assigned tasks, the achievements, and the learning experience gained during the training period.', 0, 'J', 0, 1, '', '', true);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Chapter 1: Introduction', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', 'I', 12);
$pdf->MultiCell(175, 10, 'This section should include the following items:', 0, 'L', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->SetFillColor(224, 235, 255);
$pdf->Cell(55, 10, 'Items', 1, 0, 'C', 1);
$pdf->Cell(120, 10, 'Content', 1, 0, 'C', 1);

$pdf->Ln(10);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(55, 25, 'Industrial training scheme', 1, 0, 'C', 1);
$pdf->SetFont('times', 'I', 12);
$pdf->Cell(120, 25, '<A brief description on the course objectives, duration, etc.>', 1, 0, 'C', 1);

$pdf->Ln(25);
$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 25, 'Industrial training scopes', 1, 0, 'C', 1);
$pdf->SetFont('times', 'I', 12);
$pdf->Cell(120, 25, '<A summary of trainee’s job roles and responsibilities, etc.>', 1, 0, 'C', 1);

$pdf->Ln(25);
$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 25, 'Company background', 1, 0, 'C', 1);
$pdf->SetFont('times', 'I', 12);
$pdf->Cell(120, 25, '<Describe the background and details of the company.>', 1, 0, 'C', 1);

$pdf->Ln(25);
$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 25, 'Business operation', 1, 0, 'C', 1);
$pdf->SetFont('times', 'I', 12);
$pdf->Cell(120, 25, '<Describe the basic operation perform by the company.>', 1, 0, 'C', 1);

$pdf->Ln(25);
$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 25, 'Structures of project', 1, 0, 'C', 1);
$pdf->SetFont('times', 'I', 12);
$pdf->Cell(120, 25, '<Describe the structures of organisation/project.>', 1, 0, 'C', 1);

$pdf->Ln(25);
$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 25, 'Training department', 1, 0, 'C', 1);
$pdf->SetFont('times', 'I', 12);
$pdf->Cell(120, 25, '<Explain the structure your training department>', 1, 0, 'C', 1);

$pdf->Ln(25);
$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 25, 'Training personnel', 1, 0, 'C', 1);
$pdf->SetFont('times', 'I', 12);
$pdf->Cell(120, 25, '<Describe the personnel of training organisation and department.>', 1, 0, 'C', 1);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Chapter 2 to N: Relevant Topics', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', 'I', 12);
$pdf->MultiCell(175, 15, 'Describe the project background, job responsibilities, experiences, details of work undertaken, problems faced, technology exposure, whether you have become aware of business opportunities and gained entrepreneurial skills as well as describe how you plan practise entrepreneurship in the future.', 0, 'J', 0, 1, '', '', true);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Chapter N + 1: Conclusions & Recommendations', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', 'I', 12);
$pdf->MultiCell(175, 10, 'State your opinion regarding experiences in the industry and future expectation, etc.', 0, 'J', 0, 1, '', '', true);
$pdf->MultiCell(175, 15, 'Recommendations, if any, regarding the scheme of Industrial Training or on the training, etc.', 0, 'J', 0, 1, '', '', true);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'References', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', 'I', 12);
$pdf->MultiCell(175, 15, 'References are detailed descriptions of resources from which information or ideas were obtained in preparing this report. List of references (books, manuals, etc.) according to Harvard referencing system:', 0, 'J', 0, 1, '', '', true);
$pdf->Ln(5);
$pdf->MultiCell(175, 15, 'Author’s family name, Initial(s). Year, Title of book, Edition (if any), Publisher, Place of publication.', 0, 'J', 0, 1, '', '', true);

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

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Appendices', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', 'I', 12);
$pdf->MultiCell(175, 15, 'For your information, you may include photographs, tabulations, drawings, graphs, flowcharts, computer programmes, etc., which must be clearly annotated. You MUST include the first 2 months (for a 10-week or 12-week ITP) /5 months (for a 24-week ITP) progress reports here.', 0, 'J', 0, 1, '', '', true);

$pdf->Output('final-report.pdf', 'I');
