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
$pdf->SetAuthor('ITP System');
$pdf->SetTitle('Progress Report Sample');
$pdf->SetSubject('Progress Report Sample');
$pdf->SetKeywords('Progress Report Sample');

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
$pdf->Cell(189, 3, 'Name of Trainee:     Wong Hao Jie', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Name of Company:  Guidewire Software Sdn Bhd', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Month/Year:             December 2022', 0, 1, 'L');
$pdf->Ln(8);

$pdf->SetFillColor(224, 235, 255);
$pdf->Cell(39, 10, 'Week', 1, 0, 'C', 1);
$pdf->Cell(135, 10, 'Projects / Activities', 1, 0, 'C', 1);

$pdf->Ln(10);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(39, 75, '1', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 11.5);
$pdf->MultiCell(135, 25, 'First, colleagues lead each intern to visit the working environment. Besides, they also did a simply briefing of the company and introduce themselves to us. After that, the company supervisor assigned the work tasks to me. I currently work as a web designer in the Information Technology department and attached with Guidewire Software Sdn Bhd. In this week, I have handled few tasks allocated. The first task I handle is plan website’s layout which aim to beautify and improve the previous website design. I need to draw a sketch of the appearance of a new website on my computer. Second task I handle is set up the boilerplate code. What I want to do is create a new folder for the website on my computer and create an empty style.css file. Meanwhile, I have applied what I learnt in Web Design and Development in Diploma Year 1 Sem 2, which the shortcut ways of Visual Studio Code so that I can redefine the layout within the short period.', 1, 'J', 0, 1, '', '', true);

$pdf->Ln(0);
$pdf->Cell(39, 58, '2', 1, 0, 'C', 1);
$pdf->MultiCell(135, 25, 'During this week, my main task is to choose a suitable layout theme. First, I do a list of the features such as event calendar, custom menu, and editor style. Before choosing a theme, it is important to determine which features are essential and which features may not exist. Therefore, this is the most important task for me, because if I choose the wrong theme in this section, I will need to redefine the website. In addition, I also need to keep in touch with the theme author and theme experts to explore other features of the theme. I must find the author’s most useful and quality templates. Thence, it is time for me to learn the correct way to contact experts. Furthermore, I went through the whole process from choosing a theme to paying. In this task was related with Mobile Commerce and Marketing where the method of payment and how to make a secure payment.', 1, 'J', 0, 1, '', '', true);

$pdf->Ln(0);
$pdf->Cell(39, 51, '3', 1, 0, 'C', 1);
$pdf->MultiCell(135, 25, 'I need to concentrate on finding the right hosting company and hosting plan this week. First, what I need to do is to find the most praised companies and compare them. For example, Hostinger and FastComet is the most recommended hosting company. After comparing the functions of these three companies, I need to contact a hosting expert to study which hosting plan is more suitable for use on the company’s existing website. After getting advice from a hosting expert, I need to make a report to summarize what is included in the hosting plan and what is not. In this task was related with Electronic Commerce, which the shortcut ways of Google Trends so that I can find out the most praised hosting companies.   ', 1, 'J', 0, 1, '', '', true);

$pdf->AddPage();

$pdf->Ln(20);
$pdf->Cell(39, 41, '4', 1, 0, 'C', 1);
$pdf->MultiCell(135, 25, 'The first task I handle in this week is preparing several reports for the discussion purposes. For example, hosting plan overview report, hosting experts report, template overview report etc. After finishing all the reports, we use Zoom to have a meeting with all colleagues to discuss which design and which hosting plan is feasible to use. Second task I handle is create the element for the layout. I do this is by using semantic elements such as <header>, <footer> and <main>. Meanwhile, I have applied what I learnt in Web Design and Development in Diploma Year 1 Sem 2, about what to code before start fill up the HTML content.', 1, 'J', 0, 1, '', '', true);

$pdf->Ln(8);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(189, 3, 'Problems Faced / Comments / Additional information (if any): ', 0, 1, 'L');

$pdf->Ln(1);
$pdf->SetFont('times', '', 11);
$pdf->MultiCell(174, 15, 'My supervisor gives me a project, but the directions do not quite make sense to me, and I am having trouble seeing the bigger picture. ', 1, 0, 'J', 1);

$pdf->Ln(8);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(189, 3, 'Leave Application / Leave Taken', 0, 1, 'L');

$pdf->Ln(2);
$pdf->SetFont('times', '', 11);
$pdf->Cell(189, 3, '1. From (dd/mm/yyyy):		____________________ to (dd/mm/yyyy) ____________________	(   0  day(s))', 0, 1, 'L');
$pdf->Cell(189, 3, '2. Reasons for taking leave:		_____________________________________________________________', 0, 1, 'L');
$pdf->Cell(189, 3, '3. Total number of days taken:		0 days(s)', 0, 1, 'L');

$pdf->Ln(5);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(189, 3, 'I hereby declare that the information given above is correct.', 0, 1, 'L');

$pdf->Ln(11);
$pdf->Cell(100, 5, 'Signature: [Digital Signature] ', ' ', 0, 0);
$pdf->Cell(38, 5, 'Date (dd/mm/yyyy): 27 December 2022', ' ', 0, 1);

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
