<?php
//include_once('../../app/DTO/FileDTO.php');

if (isset($_POST['update'])) {
    $host = "sql444.main-hosting.eu";
    $user = "u928796707_group34";
    $password = "u1VF3KYO1r|";
    $database = "u928796707_internshipWeb";

    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn) {
        die("Error" . mysqli_connect_error());
    }

    //include('../../includes/db_connection.php');
    $id = $_POST['stdID'];
    $objective = $_POST['objectives'];
    $workExperience = $_POST['workExperience'];
    $skill = $_POST['skill'];
    $language = $_POST['Language'];
    $education = $_POST['education'];
    $school = $_POST['school'];
    $cgpa = $_POST['cgpa'];
    $extraActivities = $_POST['extraActivities'];
    $name = $_POST['stdName'];
    $phone = $_POST['stdContactNo'];
    $email = $_POST['stdEmail'];
    $gender = $_POST['gender'];
    //$oldpass = $_POST['Pass'];
    //$newpass = $_POST['conPass'];
    $address = $_POST['stdAddress'];
    $programme = $_POST['programmeID'];
    $lecturer = $_POST['lecturerID'];
    $internBatch = $_POST['internshipBatchID'];
    $tutorial = $_POST['tutorialGroup'];

    //$db = new DBController();

    $sql = "select * from Student WHERE studentID='$id'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $Id = $row['studentID'];
        $programme1 = $row['programmeID'];
        $lecturer1 = $row['lecturerID'];
        $internBatch1 = $row['internshipBatchID'];
        $username1 = $row['studName'];
        $gender1 = $row['studGender'];
        $email1 = $row['studEmail'];
        $phone1 = $row['studContactNumber'];
        $address1 = $row['studHomeAddress'];
        $dateJoined1 = $row['studDateJoined'];
        $applicationQuota1 = $row['studApplicationQuota'];
        $currentApplication1 = $row['studCurrentNoOfApp'];
        $status1 = $row['studAccountStatus'];
    }

    require_once('../../../TCPDF-main/tcpdf.php');

    class PDF extends TCPDF
    {
        public function Header()
        {
            $imageFile = '../images/resume-tittle.JPG';
            $this->Image($imageFile, 0, 0, 210, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }

        public function Footer()
        {
            $this->setY(-18);
            $this->Ln(5);

            $this->SetFont('helvetica', 'I', 8);
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $today = date("F j, Y g:i A", time());

            $this->Cell(25, 5, 'Generate Date/Time : ' . $today, 0, 0, 'L');
            $this->Cell(170, 5, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        }
    }

    // create new PDF document
    //portrait or landscape
    $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $today = date("F j, Y g:i A", time());

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('KY');
    $pdf->SetTitle('Company Details');
    $pdf->SetSubject('Company Details');
    $pdf->SetKeywords('Company Details');

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

    $pdf->AddPage();
    $pdf->Ln(12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', 'B', 17);
    $pdf->Cell(60, 6, 'Personal Details ', 0, 0, 'C');
    $pdf->SetFont('times', 'BU', 17);
    $pdf->Cell(66, 10, '_____________________________________________________________ ', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', '', 13);
    $pdf->Cell(39, 7, 'Name : ' . $username1 . ' ', 0, 1, 'L');
    $pdf->Cell(39, 7, 'Gender : ' . $gender . '', 0, 1, 'L');
    $pdf->Cell(39, 7, 'Email : ' . $email . '', 0, 1, 'L');
    $pdf->Cell(39, 7, 'Contact Number : ' . $phone . '', 0, 1, 'L');
    $pdf->Cell(39, 7, 'Address : ' . $address . '', 0, 1, 'L');

    $pdf->Ln(8);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', 'B', 17);
    $pdf->Cell(63, 6, 'Career Objectives', 0, 0, 'C');
    $pdf->SetFont('times', 'BU', 17);
    $pdf->Cell(60, 10, '_____________________________________________________________ ', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', '', 13);
    $pdf->Cell(39, 7, '' . $objective . '', 0, 1, 'L');

    $pdf->Ln(8);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', 'B', 17);
    $pdf->Cell(45, 6, 'Education', 0, 0, 'C');
    $pdf->SetFont('times', 'BU', 17);
    $pdf->Cell(96, 10, '_____________________________________________________________ ', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', '', 13);
    $pdf->Cell(39, 7, '1. ' . $education . '', 0, 1, 'L');

    $pdf->SetTextColor(0, 0, 255);
    $pdf->SetFont('times', '', 10);
    $pdf->Cell(39, 2, '' . $school . '', 0, 1, 'L');
    $pdf->Ln(1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', '', 13);
    $pdf->Cell(39, 8, '2. Overall CGPA : ' . $cgpa . '', 0, 1, 'L');

    $pdf->Ln(8);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', 'B', 17);
    $pdf->Cell(45, 6, 'Language', 0, 0, 'C');
    $pdf->SetFont('times', 'BU', 17);
    $pdf->Cell(96, 10, '_____________________________________________________________ ', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', '', 13);
    $pdf->Cell(39, 8, '' . $language . '', 0, 1, 'L');

    $pdf->Ln(8);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', 'B', 17);
    $pdf->Cell(33, 6, 'Skill', 0, 0, 'C');
    $pdf->SetFont('times', 'BU', 17);
    $pdf->Cell(120, 10, '_____________________________________________________________ ', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', '', 13);
    $pdf->Cell(39, 8, '' . $skill . '', 0, 1, 'L');

    $pdf->Ln(8);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', 'B', 17);
    $pdf->Cell(64, 6, 'Work Experience', 0, 0, 'C');
    $pdf->SetFont('times', 'BU', 17);
    $pdf->Cell(58, 10, '_____________________________________________________________ ', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', '', 13);
    $pdf->Cell(39, 8, '' . $workExperience . '', 0, 1, 'L');

    $pdf->Ln(8);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', 'B', 17);
    $pdf->Cell(83, 6, 'Extracurricular Activities', 0, 0, 'C');
    $pdf->SetFont('times', 'BU', 17);
    $pdf->Cell(20, 10, '_____________________________________________________________ ', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', '', 13);
    $pdf->Cell(39, 8, '' . $extraActivities . '', 0, 1, 'L');

    $imageFile = '../images/cv-1.JPG';
    $pdf->Image($imageFile, 16, 39, 7, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $imageFile = '../images/cv-2.JPG';
    $pdf->Image($imageFile, 16, 92, 7, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $imageFile = '../images/cv-3.JPG';
    $pdf->Image($imageFile, 17, 116, 6, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $imageFile = '../images/cv-4.JPG';
    $pdf->Image($imageFile, 16, 155, 7, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $imageFile = '../images/cv-5.JPG';
    $pdf->Image($imageFile, 16, 207, 7, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $imageFile = '../images/cv-6.JPG';
    $pdf->Image($imageFile, 16, 232, 7, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $imageFile = '../images/cv-7.JPG';
    $pdf->Image($imageFile, 16, 181, 7, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    //$pdf->Output('CV.pdf', 'I');
    $date = explode('-', Date('Y-m-d'));


    $directory = $_SERVER['DOCUMENT_ROOT'] . 'InternshipSystem/Client/view/document/StudentCV/';
    $fileName = $directory . $Id . ' - ' . $username1 . ".pdf";

    $content = $pdf->Output($fileName, "F");

    //$sql1="INSERT INTO pdf(pdf, timestamp) values('$fileName', NOW()) ";

    //if(empty($oldpass)){
    $query = "UPDATE Student SET programmeID='$programme', lecturerID='$lecturer', internshipBatchID='$internBatch',studName='$name',
        studGender='$gender', studEmail='$email', studContactNumber='$phone', studHomeAddress='$address', tutorialGroupNo ='$tutorial', studentCVdocument='$fileName' WHERE studentID='$id' ";
    $query_run = mysqli_query($conn, $query);

    $queryGetRubricAssessmentID = "SELECT assessmentID,RoleForMark FROM `RubricAssessment` ra , Programme p , Department d
        WHERE ra.facultyID=d.facultyID AND d.departmentID=p.departmentID
        AND ra.internshipBatchID='$internBatch' AND p.programmeID='$programme' AND ra.status='activate'";

    $result1 = mysqli_query($conn, $queryGetRubricAssessmentID);

    $sql = "SELECT * FROM StudentResult ORDER BY studResultID DESC";
    $result2 = mysqli_query($conn, $sql);
    $row = $result2->fetch_row();

    $resultID = $row[0];

    

    function generateResultID($resultID)
    {

        $prefix = 'RSLT';

        //Get the first ID 
        $lastID = $resultID;
        //SubString to last part of ID
        $numberPart = substr($lastID, 4, 6);

        if ((int) $numberPart < 9) {
            $prefix .= '00000' . ((int) $numberPart + 1);
        } else if ((int) $numberPart >= 9) {
            $prefix .= '0000' . ((int) $numberPart + 1);
        }

        return $prefix;
    }
    
    $resultID = generateResultID($resultID);
    
    while ($row = mysqli_fetch_assoc($result1)) {
        $assessmentID = $row['assessmentID'];
        $RoleForMark = $row['RoleForMark'];
        $queryInsertStudReslut = "INSERT INTO StudentResult (`studResultID`, `studentID`,`assessmentID` ,`RoleForMark`)
        VALUES (
          '" . $resultID . "',
          '" . $id . "',
          '" . $assessmentID . "',
          '" . $RoleForMark . "'
        )";
        $query_run1 = mysqli_query($conn, $queryInsertStudReslut);
        $resultID = generateResultID($resultID);
    }


    if ($query_run) {
        echo "
            <script>
                alert('Student details update successfully');
                document.location.href = 'ky-maintainStud.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Student details update failed, please try again.');
                document.location.href = 'ky-enterStudDetails.php';
            </script>
            ";
    }


    //}

    /* else{

            $sql="select * from Student where studentID='$id'";
            $result = mysqli_query($conn, $sql);
            
            $row=mysqli_fetch_assoc($result);
                    if (password_verify($oldpass, $row['studPassword'])){ 
                        if(empty($newpass)){
                            echo '<script>alert("New password is empty. Please enter new password");
                            window.history.back(1);
                            </script>';
                        }
                        else{
                            $hash = password_hash($newpass, PASSWORD_DEFAULT);
                           
                            $query2 = "UPDATE Student SET programmeID='$programme', lecturerID='$lecturer', internshipBatchID='$internBatch',studName='$name',
                            studGender='$gender', studEmail='$email', studContactNumber='$phone', studHomeAddress='$address', tutorialGroupNo ='$tutorial', studPassword = '$hash', studAccountStatus = 'Pending Map', studentCVdocument='$fileName' WHERE studentID='$id' ";
                            $result2 = mysqli_query($conn, $query2);
                            if($result2)
                            {
                                echo "
                                <script>
                                    alert('Student details update successfully');
                                    document.location.href = 'ky-enterStudDetails.php';
                                </script>
                                ";
                            }
                            else
                            {
                                echo "
                                <script>
                                    alert('Student details update failed, please try again.');
                                    document.location.href = 'ky-enterStudDetails.php';
                                </script>
                                ";
                            }
                        }
                    } 
                    else{
                        echo '<script>alert("Initial password is incorrect. Password update unsuccessful");
                            window.history.back(1);
                        </script>';
                    }
                
        }
     */
}
