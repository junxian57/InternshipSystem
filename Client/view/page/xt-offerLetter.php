<?php
	if(isset($_GET['internAppID'])){
    $internAppID = $_GET['internAppID'];
  }
?>

<?php

require_once('../../../TCPDF-main/tcpdf.php');

function numberTowords($num){
  $ones = array(
    0 =>"ZERO",
    1 => "ONE",
    2 => "TWO",
    3 => "THREE",
    4 => "FOUR",
    5 => "FIVE",
    6 => "SIX",
    7 => "SEVEN",
    8 => "EIGHT",
    9 => "NINE",
    10 => "TEN",
    11 => "ELEVEN",
    12 => "TWELVE",
    13 => "THIRTEEN",
    14 => "FOURTEEN",
    15 => "FIFTEEN",
    16 => "SIXTEEN",
    17 => "SEVENTEEN",
    18 => "EIGHTEEN",
    19 => "NINETEEN",
    "014" => "FOURTEEN"
  );

  $tens = array( 
    0 => "ZERO",
    1 => "TEN",
    2 => "TWENTY",
    3 => "THIRTY", 
    4 => "FORTY", 
    5 => "FIFTY", 
    6 => "SIXTY", 
    7 => "SEVENTY", 
    8 => "EIGHTY", 
    9 => "NINETY" 
  ); 

  $hundreds = array( 
    "HUNDRED", 
    "THOUSAND", 
    "MILLION", 
    "BILLION", 
    "TRILLION", 
    "QUARDRILLION" 
  );

  $num = number_format($num,2,".",","); 
  $num_arr = explode(".",$num); 
  $wholenum = $num_arr[0]; 
  $decnum = $num_arr[1]; 
  $whole_arr = array_reverse(explode(",",$wholenum)); 
  krsort($whole_arr,1); 
  $rettxt = ""; 

  foreach($whole_arr as $key => $i){
    while(substr($i,0,1)=="0")
    $i=substr($i,1,5);
    if($i < 20){ 
      $rettxt .= $ones[$i]; 
    }
    elseif($i < 100){ 
      if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
      if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
    }
    else{ 
      if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
      if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
      if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    
    if($key > 0){ 
      $rettxt .= " ".$hundreds[$key]." "; 
    }
  } 
  
  if($decnum > 0){
    $rettxt .= " and ";
    if($decnum < 20){
      $rettxt .= $ones[$decnum];
    }
    elseif($decnum < 100){
      $rettxt .= $tens[substr($decnum,0,1)];
      $rettxt .= " ".$ones[substr($decnum,1,1)];
    }
  }
  return $rettxt;
}

extract($_POST);

if(isset($_POST['create'])){
  $studName = $_POST['studName'];
  $studID = $_POST['studID'];
  $allowance = $_POST['allowance'];
  $location = $_POST['location'];
  $period = $_POST['period'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $supName = $_POST['supName'];
  $internJobID = $_POST['internJobID'];
  $position = $_POST['position'];
  $supContact = $_POST['supContact'];
  $supEmail = $_POST['supEmail'];
  $generateDate = date("Y/m/d", time());
  $allowanceInWord = numberTowords($allowance);
  $date1 = date_create("$start");
  $date2 = date_create("$end");
  $newStartDate = date_format($date1,"j F Y");
  $newEndDate = date_format($date2,"j F Y");  

  $date1 = $start;
  $date2 = $end;
  $d1=new DateTime($date2); 
  $d2=new DateTime($date1);                                  
  $months = $d2->diff($d1); 
  $monthDuration = (($months->y) * 12) + ($months->m);
  $periodInWord = numberTowords($monthDuration);

  require '../../../config/email.php';
  $mailConfig = new EmailConfig();
  $subject = "Internship Application Approval";

  $host = "sql444.main-hosting.eu";
  $user = "u928796707_group34";
  $password = "u1VF3KYO1r|";
  $database = "u928796707_internshipWeb";
                                              
  $conn = mysqli_connect($host, $user, $password, $database); 

  $getStud = "SELECT * FROM Student WHERE studentID = '$studID'";
	$runStud = mysqli_query($conn, $getStud);
	$rowStud = mysqli_fetch_array($runStud);
  $studEmail = $rowStud['studEmail'];

  $get_intern = "SELECT * FROM InternJob WHERE internJobID = '$internJobID'";
	$run_intern = mysqli_query($conn, $get_intern);
	$row_intern = mysqli_fetch_array($run_intern);
  $jobMaxNumberQuota = $row_intern['jobMaxNumberQuota'];
}

class PDF extends TCPDF{
  public function Header(){
    $imageFile = '../../../Client/view/images/taruc-logo.jpg';
    $this->Image($imageFile, 20, 10, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    $this->Ln(7);
    $this->SetFont('courier', 'B', 15);
    $this->Cell(220, 5, 'Tunku Abdul Rahman University College', 0, 1, 'C');
  }

  public function Footer(){
    $this->setY(-138);
    $this->Ln(5);
    $this->SetFont('Times', 'B', 10);
    $this->MultiCell(189, 15, 'I …………………………………… (NRIC No …………………………………), hereby accepts this INTERN Training 
Offer and I will agree to respect the confidential of the contents in this letter.', 0, 'L', 0, 1, '', '', true);
    $this->MultiCell(189, 15, 'I shall report to work on __________________________________.', 0, 'L', 0, 1, '', '', true);
    $this->Ln(20);
    $this->Cell(20, 1, '…………………………………………', 0, 0);
    $this->Ln(8);
    $this->Cell(20, 5, 'Name/NRIC: ', 0, 0);
    $this->Ln(8);
    $this->Cell(20, 5, 'Date: ', 0, 0);
    $this->Ln(50);

    $this->SetFont('helvetica', 'I', 8);
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $today = date("F j, Y g:i A", time());

    $this->Cell(25, 5, 'Generation Date/Time: '.$today, 0, 0, 'L');
    $this->Cell(164, 5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
                //portrait or landscape
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ITP System');
$pdf->SetTitle('Offer Letter');
$pdf->SetSubject('Offer Letter');
$pdf->SetKeywords('Offer Letter');

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

$pdf->Ln(15);

$pdf->SetFont('times', '', 11);
$pdf->Cell(189, 3, 'Date: '.$generateDate, 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(130, 5, 'Name: '.$studName, ' ', 0, 0);
$pdf->Cell(59, 5, 'NRIC: '.$studID, ' ', 0, 1);
$pdf->Ln(5);

$pdf->Cell(20, 5, 'Address: '.$location, 0, 1);
$pdf->Ln(5);

$pdf->SetFont('times', 'U', 11);
$pdf->Cell(189, 3, 'Ref: INTERN OFFER LETTER FOR THE POSITION OF '.strtoupper($position), 0, 1, 'L');
$pdf->Ln(5);

$pdf->SetFont('times', '', 11);
$pdf->MultiCell(180, 15, 'We are pleased to offer you the position as a '.$position. ' with our company on an Intern Employee Training for a period of '.$periodInWord.' ('.$monthDuration.') months and at the monthly allowance fees of RINGGIT '.$allowanceInWord. ' (RM'.$allowance.') only, with effective from '.$newStartDate.' till '.$newEndDate.'.', 0, 'L', 0, 1, '', '', true);
$pdf->Ln(3);

$pdf->Cell(189, 3, 'We look forward to see you contribute to our corporation.', 0, 1, 'L');
$pdf->Ln(3);

$pdf->Cell(189, 3, 'Thank you.', 0, 1, 'L');
$pdf->Ln(3);

$pdf->Cell(189, 3, 'Yours faithfully', 0, 1, 'L');
$pdf->Ln(10);

$pdf->Cell(20, 1, '………………………………', 0, 0);
$pdf->Ln(5);

$pdf->SetFont('Times', '', 11);
$pdf->Cell(189, 3, ''.strtoupper($supName), 0, 1, 'L');
$pdf->Cell(189, 3, 'HR DEPARTMENT', 0, 1, 'L');
$pdf->Cell(189, 3, 'Email: '.$supEmail, 0, 1, 'L');
$pdf->Cell(189, 3, 'Tel: '.$supContact, 0, 1, 'L');

$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(180, 1, '__________________________________________________________________________________________', 0, 0);

$pdf->Output(__DIR__ . '/offerLetter/offerLetter_'.$studName.'.pdf', 'FI');

$sql = "UPDATE InternApplicationMap SET appStatus='Accepted', appStudentCV='offerLetter_$studName.pdf' WHERE internAppID='$internAppID'";
$maxNumQuota = $jobMaxNumberQuota - 1;
if($maxNumQuota >= 1){
  $query = "UPDATE InternJob SET jobMaxNumberQuota='$maxNumQuota' WHERE internJobID = '$internJobID'";
}
else{
  $query = "UPDATE InternJob SET jobMaxNumberQuota='$maxNumQuota', jobStatus = 'Full' WHERE internJobID = '$internJobID'";
}

  if ((mysqli_query($conn, $sql)) && (mysqli_query($conn, $query))){
    $success = $mailConfig->singleEmail(
      $studEmail, 
      $subject, 
      acceptApp($studName, $internAppID, $position, $allowance),
      'offerLetter/offerLetter_'.$studName.'.pdf'
    );
  }

function acceptApp($studName, $internAppID, $position, $allowance){
  $html = "
  <html>
    <head>
      <title>Internship Application Approval</title>
    </head>
    <body>
      <p>Dear $studName,</p>
      <p>Congratulations! Your intern job application <span style='font-weight: bold; color: blue;'>[$internAppID]</span> has been <span style='color:green; font-weight: bold; text-decoration:underline;'>accepted</span>.</p>
      <br>
      <p>After consideration, we would like to offer you the internship for the position of $position with monthly allowance of RM $allowance. Please let us know are you interested to take this offer.</p>
      <br>
      <p>I am looking forward to hearing from you soon.</p>
      <br>
      <p>Thank you.</p>
      <br>
    </body>
  </html>";

  return $html;
}

?>