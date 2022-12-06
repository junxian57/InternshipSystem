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
        where ra.internshipBatchID = '$internshipBatchID'  AND ra.RoleForMark='Supervisor' group by rc.criterionID ORDER BY rcc.CriteriaSession ASC;";
        $results = $db_handle1->runQuery($query);

        $this->setPrintHeader(false);
        $this->Ln(20);
        $this->SetFont('times', 'U', 12);
        $this->Cell(189, 3, 'Instructions:', 0, 1, 'L');
        $this->SetFont('times', '', 12);
        $this->MultiCell(189, 30, $results[0]['Instructions'], 0, 'L', 0, 1, '', '', true);
        $this->Ln(5);
        $this->Cell(189, 3, 'Student Name:          __________________________________________________________', 0, 1, 'L');
        $this->Ln(2);
        $this->Cell(189, 3, 'Student ID:                __________________________________________________________', 0, 1, 'L');
        $this->Ln(2);
        $this->Cell(189, 3, 'Programme:               __________________________________________________________', 0, 1, 'L');
        $this->Ln(2);
        $this->Cell(189, 3, 'Company Name:        __________________________________________________________', 0, 1, 'L');
        $this->Ln(2);
        $this->SetFillColor(238, 237, 237);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(238, 237, 237);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 40, 40, 40, 40, 40, 20);
        $this->AddPage('L', 'A4');
        $this->setPrintHeader(false);
        if (!empty($results)) {
            $this->Cell(189, 3, 'Section A. Progress Reports', 0, 1, 'L');
            $this->Ln(2);
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
            $currentScoreRange = $results[0]['score'];
            foreach ($results as $row) {
                if ($row['CriteriaSession'] == "Section A. Progress Reports") {
                    if ($currentScoreRange != $row['score']) {
                        $this->SetFillColor(238, 237, 237);
                        $this->SetTextColor(0, 0, 0);
                        $this->SetDrawColor(238, 237, 237);
                        $this->SetLineWidth(0.3);
                        $this->SetFont('', 'B');
                        $header = $row['score'];
                        $headerScore = explode(",", $header);
                        $headerTitle = $row['valueName'];
                        $headerTitle = explode(",", $headerTitle);
                        $this->Cell($w[0], 7, "Criteria",  1, 0, 'C', 1);
                        $this->Cell($w[1], 7, $headerTitle[0] . " " . $headerScore[0],  1, 0, 'C', 1);
                        $this->Cell($w[2], 7,  $headerTitle[1] . " " . $headerScore[1],  1, 0, 'C', 1);
                        $this->Cell($w[3], 7, $headerTitle[2] . " " . $headerScore[2],  1, 0, 'C', 1);
                        $this->Cell($w[4], 7,  $headerTitle[3] . " " . $headerScore[3],  1, 0, 'C', 1);
                        $this->Cell($w[5], 7, $headerTitle[4] . " " . $headerScore[4],  1, 0, 'C', 1);
                        $this->Cell($w[6], 7, "",  1, 0, 'C', 1);
                        $this->Ln();
                        $currentScoreRange = $row['score'];
                        $this->SetFillColor(224, 235, 255);
                        $this->SetTextColor(0);
                        $this->SetFont('');
                    }
                    $description = $row['description'];
                    $description = explode(",", $description);
                    $this->MultiCell($w[0], 35, $row['Title'], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[1], 35, $description[0], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[2], 35, $description[1], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[3], 35, $description[2], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[4], 35, $description[3], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[5], 35, $description[4], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[6], 35, "", 1, 'J', 0, 0, '', '', true, 0, false, true, 40);
                    $this->Ln();
                }
            }
            $this->Ln(5);
            $this->SetFont('times', 'B', 12);
            $this->Cell(189, 3, 'Section B. Final Reports', 0, 1, 'L');
            $this->Ln(5);
            foreach ($results as $row) {
                if ($row['CriteriaSession'] == "Section B. Final Reports") {
                    if ($currentScoreRange != $row['score']) {
                        $this->SetFillColor(238, 237, 237);
                        $this->SetTextColor(0, 0, 0);
                        $this->SetDrawColor(238, 237, 237);
                        $this->SetLineWidth(0.3);
                        $this->SetFont('', 'B');
                        $header = $row['score'];
                        $headerScore = explode(",", $header);
                        $headerTitle = $row['valueName'];
                        $headerTitle = explode(",", $headerTitle);
                        $this->Cell($w[0], 7, "Criteria",  1, 0, 'C', 1);
                        $this->Cell($w[1], 7, $headerTitle[0] . " " . $headerScore[0],  1, 0, 'C', 1);
                        $this->Cell($w[2], 7,  $headerTitle[1] . " " . $headerScore[1],  1, 0, 'C', 1);
                        $this->Cell($w[3], 7, $headerTitle[2] . " " . $headerScore[2],  1, 0, 'C', 1);
                        $this->Cell($w[4], 7,  $headerTitle[3] . " " . $headerScore[3],  1, 0, 'C', 1);
                        $this->Cell($w[5], 7, $headerTitle[4] . " " . $headerScore[4],  1, 0, 'C', 1);
                        $this->Cell($w[6], 7, "",  1, 0, 'C', 1);
                        $this->Ln();
                        $currentScoreRange = $row['score'];
                        $this->SetFillColor(224, 235, 255);
                        $this->SetTextColor(0);
                        $this->SetFont('');
                    }

                    $description = $row['description'];
                    $description = explode(",", $description);
                    $this->MultiCell($w[0], 40, $row['Title'], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[1], 40, $description[0], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[2], 40, $description[1], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[3], 40, $description[2], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[4], 40, $description[3], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[5], 40, $description[4], 1, 'C', 0, 0, '', '', true, 0, false, true, 40);
                    $this->MultiCell($w[6], 40, "", 1, 'J', 0, 0, '', '', true, 0, false, true, 40);
                    $this->Ln();
                    if ($this->checkPageBreak()) {
                        $this->Ln();
                    }
                }
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

        $this->Ln(15);
        $this->Cell(230, 3, 'INDUSTRIAL TRAINING SUPERVISOR’S EVALUATION ON STUDENT', 0, 1, 'L');
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

$pdf->AddPage('P', 'A4');

$pdf->rubricCriteriaTable();

$pdf->AddPage('P', 'A4');

$pdf->SetFont('times', 'B', 12);
$pdf->Cell(189, 3, 'Section C', 0, 1, 'L');
$pdf->Ln(1);

$pdf->SetFont('times', '', 12);
$pdf->MultiCell(189, 10, 'Comments (if any):', 0, 'L', 0, 1, '', '', true);
$pdf->MultiCell(189, 15, ' 


', 1, 1);

$pdf->Cell(189, 3, 'University College Supervisor Name:  __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Signature:                                              __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(189, 3, 'Date (dd/mm/yyyy):                              __________________________________________________________', 0, 1, 'L');
$pdf->Ln(5);

$pdf->Output('final-report.pdf', 'I');
