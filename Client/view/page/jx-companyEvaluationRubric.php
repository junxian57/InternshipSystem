<?php

require_once('../../../TCPDF-main/tcpdf.php');
require_once("../../includes/db_connection.php");

class PDF extends TCPDF
{
    public function rubricCriteriaTable()
    {
        $db_handle1 = new DBController();
        $internshipBatchID = $_GET['internshipBatchID'];
        $query = "SELECT ra.Instructions,rcc.criterionID,rcc.Title ,rcc.CriteriaSession,rac.TotalWeight ,GROUP_CONCAT(rc.componentID ORDER BY rc.componentID)as componentID,
        GROUP_CONCAT(rc.valueName ORDER BY rc.componentID)as valueName,GROUP_CONCAT(rc.score ORDER BY rc.componentID) as score, GROUP_CONCAT(rc.description ORDER BY rc.componentID) as description 
        FROM RubricAssessmentCriteria rac JOIN RubricComponentCriteria rcc on rac.criterionID=rcc.criterionID JOIN RubricComponent rc on rac.criterionID = rc.criterionID 
        Join RubricAssessment ra on rac.assessmentID=ra.assessmentID
        where ra.internshipBatchID = '$internshipBatchID'  AND ra.RoleForMark='Company' group by rc.criterionID ASC;";
        $results = $db_handle1->runQuery($query);
        

        $this->SetFont('times', 'U', 12);
        $this->Cell(189, 3, 'Instructions:', 0, 1, 'L');
        $this->SetFont('times', '', 12);
        $this->MultiCell(189, 15, $results[0]['Instructions'], 0, 'L', 0, 1, '', '', true);
        $this->Ln(1);
        $this->Cell(189, 3, 'Name of Company:                               __________________________________________________________', 0, 1, 'L');
        $this->Ln(2);
        $this->Cell(189, 3, 'Name of Company Supervisor:            __________________________________________________________', 0, 1, 'L');
        $this->Ln(2);
        $this->Cell(189, 3, 'Name of Student Trainee:                     __________________________________________________________', 0, 1, 'L');
        $this->Ln(2);
        $this->SetFillColor(238, 237, 237);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(238, 237, 237);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 40, 40, 40, 40, 40, 20);
        if (!empty($results)) {
            $header = $results[0]['score'];
            $headerScore = explode(",", $header);
            $headerTitle = $results[0]['valueName'];
            $headerTitle = explode(",", $headerTitle);
            $this->Cell($w[0], 7, "Criteria",  1, 0, 'C', 1);
            $this->Cell($w[1], 7, $headerTitle[0] . " " . $headerScore[0],  1, 0, 'C', 1);
            $this->Cell($w[2], 7,  $headerTitle[1] . " " . $headerScore[1],  1, 0, 'C', 1);
            $this->Cell($w[3], 7, $headerTitle[2] . " " . $headerScore[2],  1, 0, 'C', 1);
            $this->Cell($w[4], 7,  $headerTitle[3] . " " . $headerScore[3],  1, 0, 'C', 1);
            $this->Cell($w[5], 7, $headerTitle[4] . " " . $headerScore[4],  1, 0, 'C', 1);
            $this->Cell($w[6], 7, "Score",  1, 0, 'C', 1);
            $this->Ln();
            // Color and font restoration
            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Data
            foreach ($results as $row) {
                $headerScore = explode(",", $header);
                $description = $row['description'];
                $description = explode(",", $description);
                $this->MultiCell($w[0], 15, $row['Title'], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                $this->MultiCell($w[1], 15, $description[0], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                $this->MultiCell($w[2], 15, $description[1], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                $this->MultiCell($w[3], 15, $description[2], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                $this->MultiCell($w[4], 15, $description[3], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                $this->MultiCell($w[5], 15, $description[4], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                $this->MultiCell($w[6], 15, "", 1, 'J', 0, 0, '', '', true, 0, false, true, 40);
                $this->Ln();
            }

            $this->MultiCell(240, 15, "Total Score", 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
            $this->MultiCell($w[6], 15, "", 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
            $this->Ln();
            $this->Cell(array_sum($w), 0, '', 'T');
        }
    }

    public function Header()
    {
        $imageFile = '../../../Client/view/images/taruc-logo.jpg';
        $this->Image($imageFile, 15, 10, 60, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Ln(3);
        $this->SetFont('times', 'B', 12);
        $this->Cell(230, 5, 'Tunku Abdul Rahman University College', 0, 1, 'C');

        $this->Ln(2);
        $this->Cell(230, 5, 'Faculty of Computing and Information Technology', 0, 1, 'C');

        $this->Ln(2);
        $this->Cell(230, 5, 'Company Supervisor’s Evaluation on Student Trainee', 0, 1, 'C');
    }

    public function Footer()
    {
        $this->setY(-18);
        $this->Ln(5);

        $this->SetFont('helvetica', 'I', 8);
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $today = date("F j, Y g:i A", time());

        $this->Cell(189, 5, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
//portrait or landscape
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ITP System');
$pdf->SetTitle('Company Evaluation Form');
$pdf->SetSubject('Company Evaluation Form');
$pdf->SetKeywords('Company Evaluation Form');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('times', '', 14, '', true);

$pdf->AddPage('L', 'A4');

$pdf->Ln(15);

$pdf->rubricCriteriaTable();

$pdf->AddPage('P', 'A4');

$pdf->Ln(23);

$pdf->SetFont('times', 'B', 12);
$pdf->Cell(189, 3, 'Student’s Attendance', 0, 1, 'L');
$pdf->Ln(5);

$pdf->SetFont('times', '', 12);
$pdf->Cell(189, 3, 'Number of days absent with permission:       _____________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Number of days absent without permission:      ___________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->SetFont('times', 'B', 12);
$pdf->MultiCell(175, 10, 'Other comments about this student trainee?', 0, 'L', 0, 1, '', '', true);
$pdf->MultiCell(175, 15, ' 


', 1, 1);
$pdf->Ln(5);

$pdf->MultiCell(165, 10, 'Please include a few words about the type of training the student trainee underwent. For e.g. nature of work, department attached to, duration of attachment, etc.', 0, 'L', 0, 1, '', '', true);
$pdf->MultiCell(175, 15, ' 


', 1, 1);
$pdf->Ln(5);

$pdf->SetFont('times', '', 12);
$pdf->Cell(189, 3, 'Signature of Supervisor:          __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Name of Supervisor:                __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Designation:                             __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Date (dd/mm/yyyy):                __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(53, 5, 'Company Stamp: ', 0, 0);
$pdf->MultiCell(123, 5, ' 




', 1, 1);


$pdf->Ln(1);
$pdf->SetFont('times', 'I', 10);
$pdf->MultiCell(175, 15, 'Thank you for taking your time to complete this evaluation form. The University College (UC) wishes to record its earnest appreciation to your organisation for participating in this training programme. We hope that your organisation will continue such collaboration in our next training programme. We would like to thank you in advance.', 0, 'J', 0, 1, '', '', true);

$pdf->Output('final-report.pdf', 'I');
