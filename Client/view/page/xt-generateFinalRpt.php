<?php
  require_once('../../../TCPDF-main/tcpdf.php');

	include('../../includes/db_connection.php');

  if(session_status() != PHP_SESSION_ACTIVE) session_start();

	if (isset($_SESSION['studentChangePass'])) {
		header('Location: clientChangePassword.php?requireChangePass&notAllowed');
	}
    
	if (!isset($_SESSION['studentID'])) {
    echo "<script>
        window.location.href = 'clientLogin.php';
    </script>";
	} else {
    $studID = $_SESSION['studentID'];
  }

  if(isset($_GET['finalRptID'])){
    $finalReportID = $_GET['finalRptID'];
  }
  
  extract($_POST);

  if(isset($_POST['submitRpt'])){
    $host = "sql444.main-hosting.eu";
    $user = "u928796707_group34";
    $password = "u1VF3KYO1r|";
    $database = "u928796707_internshipWeb";
                                  
    $conn = mysqli_connect($host, $user, $password, $database); 

    $get_stud = "SELECT * FROM Student WHERE studentID = '$studID'";
    $run_stud = mysqli_query($conn, $get_stud);
    $row_stud = mysqli_fetch_array($run_stud);
    $studName = $row_stud['studName'];
    $programmeID = $row_stud['programmeID'];
    $lecturerID = $row_stud['lecturerID'];

    $get_programme = "SELECT * FROM Programme WHERE programmeID = '$programmeID'";
    $run_programme = mysqli_query($conn, $get_programme);
    $row_programme = mysqli_fetch_array($run_programme);
    $programmeName = $row_programme['programmeName'];
    $departmentID = $row_programme['departmentID'];

    $get_lecturer = "SELECT * FROM Lecturer WHERE lecturerID = '$lecturerID'";
    $run_lecturer = mysqli_query($conn, $get_lecturer);
    $row_lecturer = mysqli_fetch_array($run_lecturer);
    $lecName = $row_lecturer['lecName'];

    $get_dept = "SELECT * FROM Department WHERE departmentID = '$departmentID'";
    $run_dept = mysqli_query($conn, $get_dept);
    $row_dept = mysqli_fetch_array($run_dept);
    $facultyID = $row_dept['facultyID'];

    $get_fac = "SELECT * FROM Faculty WHERE facultyID = '$facultyID'";
    $run_fac = mysqli_query($conn, $get_fac);
    $row_fac = mysqli_fetch_array($run_fac);
    $facName = $row_fac['facName'];
    $facCampusLocation = $row_fac['facCampusLocation'];

    $get_final = "SELECT * FROM finalReport WHERE finalReportID = '$finalReportID'";
    $run_final = mysqli_query($conn, $get_final);
    $row_final = mysqli_fetch_array($run_final);

    $internAppID = $row_final['internAppID'];
    $acknowledgements = $row_final['acknowledgements'];
    $abstract = $row_final['abstract'];
    $trainingScheme = $row_final['trainingScheme'];
    $trainingScope = $row_final['trainingScope'];
    $cmpBackground = $row_final['cmpBackground'];
    $businessOperation = $row_final['businessOperation'];
    $projectStructure = $row_final['projectStructure'];
    $trainingDept = $row_final['trainingDept'];
    $trainingPersonnel = $row_final['trainingPersonnel'];
    $projectBackground = $row_final['projectBackground'];
    $conclusion = $row_final['recommendation'];

    $getInternApp = "SELECT * FROM InternApplicationMap WHERE internAppID = '$internAppID'";
    $runInternApp = mysqli_query($conn, $getInternApp);
 	  $rowInternApp = mysqli_fetch_array($runInternApp);
    $internJobID = $rowInternApp['internJobID'];
	  $appInternStartDate = $rowInternApp['appInternStartDate'];
	  $appInternEndDate = $rowInternApp['appInternEndDate'];

    $getCmpInfo = "SELECT * FROM InternJob WHERE internJobID = '$internJobID'";
    $runCmpInfo = mysqli_query($conn, $getCmpInfo);
    $rowCmpInfo = mysqli_fetch_array($runCmpInfo);
    $cmpID = $rowCmpInfo['companyID'];

	  $get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
    $run_cmp = mysqli_query($conn, $get_cmp);
	  $row_cmp = mysqli_fetch_array($run_cmp);
	  $cmpName = $row_cmp['cmpName'];
    $cmpAddress = $row_cmp['cmpAddress'];

    $status = "Submitted";
    $signature = $_POST['signature'];
    $signatureFileName = $studName.'.jpg';
    $signature = str_replace('data:image/png;base64,', '', $signature);
    $signature = str_replace(' ', '+', $signature);
    $data = base64_decode($signature);
    $file = '../../../Client/view/signature/'.$signatureFileName;
    file_put_contents($file, $data);
    $sign = '../../../Client/view/signature/'.$studName.'.jpg';
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date('Y/m/d h:i:s', time());
    $boolean = 1;
  
    if($acknowledgements == '' || $abstract == '' || $trainingScheme == '' || $trainingScope == '' || $cmpBackground == '' || $businessOperation == '' || $projectStructure == '' || $trainingDept == '' || $trainingPersonnel == '' || $projectBackground == '' || $conclusion == ''){
      echo "<script>alert('Failed to submit! Some field is empty!')</script>";    
      echo "<script>window.open('xt-editFinalReport.php?finalReportID=$finalReportID','_self')</script>"; 
    }else{
      $sql = "UPDATE finalReport SET acknowledgements='$acknowledgements', abstract='$abstract', trainingScheme='$trainingScheme', trainingScope='$trainingScope', cmpBackground='$cmpBackground', businessOperation='$businessOperation', projectStructure='$projectStructure', trainingDept='$trainingDept', trainingPersonnel='$trainingPersonnel', projectBackground='$projectBackground', recommendation='$conclusion', submitDateTime='$date', submitOnTime = '$boolean', reportStatus = '$status' WHERE finalReportID='$finalReportID'";
    
      if (mysqli_query($conn, $sql)) {
        $today = date("j F Y");
      }else{
        echo "Error: " . $sql . mysqli_error($conn);
      }
    }
  }

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
    $today = date("j F Y");

    $this->Cell(189, 5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
                //portrait or landscape
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ITP System');
$pdf->SetTitle('Final Report');
$pdf->SetSubject('Final Report');
$pdf->SetKeywords('Final Report');

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

$pdf->Cell(180, 3, ''.$cmpName, 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, ''.$cmpAddress, 0, 1, 'C');
$pdf->Cell(180, 3, 'Jalan Kerinchi, Bangsar South', 0, 1, 'C'); 
$pdf->Cell(180, 3, '59200 Kuala Lumpur', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'From '.$appInternStartDate. ' To ' .$appInternEndDate, 0, 1, 'C');
$pdf->Ln(30);

$pdf->Cell(180, 3, 'Prepared By', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, ''.$studName, 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, ''.$programmeName, 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Ms/Mr '.$lecName, 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, ''.$facName, 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Tunku Abdul Rahman University of Management and Technology', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, ''.$facCampusLocation, 0, 1, 'C');
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
$pdf->Cell(189, 5, '___________________', 0, 1, 'L');
$pdf->Image($sign, 18, 93, 80, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->Ln(20);
$pdf->Cell(189, 3, ''.$studName, 0, 1, 'L');

$pdf->Ln(2);
$pdf->Cell(189, 3, 'Date (dd/mm/yyyy): '.$today, 0, 1, 'L');

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Acknowledgements', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(175, 15, ''.$acknowledgements, 0, 'J', 0, 1, '', '', true);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Abstract', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(175, 15, ''.$abstract, 0, 'J', 0, 1, '', '', true);

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
$pdf->Cell(55, 35, 'Industrial training scheme', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 35, ''.$trainingScheme, 1, 'J', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 38, 'Industrial training scopes', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 37, ''.$trainingScope, 1, 'J', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 37, 'Company background', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 37, ''.$cmpBackground, 1, 'J', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 40, 'Business operation', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 40, ''.$businessOperation, 1, 'J', 0, 1, '', '', true);

$pdf->AddPage();
$pdf->Ln(20);
$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 35, 'Structures of project', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 35, ''.$projectStructure, 1, 'J', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 35, 'Training department', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 35, ''.$trainingDept, 1, 'J', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 35, 'Training personnel', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 35, ''.$trainingPersonnel, 1, 'J', 0, 1, '', '', true);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Chapter 2: Project Background and Responsibilities', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(175, 15, ''.$projectBackground, 0, 'J', 0, 1, '', '', true);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Chapter 3: Conclusions & Recommendations', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(175, 10, ''.$conclusion, 0, 'J', 0, 1, '', '', true);

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

$pdf->Output('final-report.pdf', 'I');
unlink($sign);
?>