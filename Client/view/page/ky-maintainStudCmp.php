<?php
    $host = "sql444.main-hosting.eu";
    $user = "u928796707_group34";
    $password = "u1VF3KYO1r|";
    $database = "u928796707_internshipWeb";
    
    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn){
        die("Error". mysqli_connect_error());
    }

    if(isset($_GET['companyID']) && isset($_GET['cmpContactNo']) && isset($_GET['cmpEmail']) && isset($_GET['cmpContactPerson']) && isset($_GET['cmpAddress']) && isset($_GET['cmpState']) && isset($_GET['cmpPostcode']) && isset($_GET['cmpCity']) && isset($_GET['cmpSize']) && isset($_GET['cmpHiddenFieldsArea']) && isset($_GET['cmpAverageAllowanceGiven']) && isset($_GET['submit'])){

        try{
            $cmpID = $_GET['companyID'];
            $cmpContactNo = trim($_GET['cmpContactNo']);
            $cmpEmail = $_GET['cmpEmail'];
            $cmpContactPerson = trim($_GET['cmpContactPerson']);
            $cmpAddress = trim($_GET['cmpAddress']);
            $cmpState = $_GET['cmpState'];
            $cmpPostCode = $_GET['cmpPostcode'];
            $cmpCity = trim($_GET['cmpCity']);
            $cmpSize = $_GET['cmpSize'];
            $cmpFieldsArea = trim($_GET['cmpHiddenFieldsArea']);
            $allowance = $_GET['cmpAverageAllowanceGiven'];
            $oldPass = $_GET['iniPass'];
            $newPass = $_GET['newPass'];
    
            if($cmpSize == 'Micro'){
                $cmpNumberOfInternshipPlacements = 2;
            }else if($cmpSize == 'Small'){
                $cmpNumberOfInternshipPlacements = 8;
            }else if($cmpSize == 'Medium'){
                $cmpNumberOfInternshipPlacements = 20;
            }else if($cmpSize == 'Large'){
                $cmpNumberOfInternshipPlacements = 50;
            }
            
            if(empty($oldPass)){
                $query = "UPDATE Company SET cmpEmail='$cmpEmail', cmpContactNumber='$cmpContactNo', cmpContactPerson='$cmpContactPerson', 
                cmpCompanySize='$cmpSize', cmpAddress='$cmpAddress', cmpFieldsArea='$cmpFieldsArea', cmpNumberOfInternshipPlacements='$cmpNumberOfInternshipPlacements', 
                cmpState='$cmpState', cmpPostCode='$cmpPostCode', cmpCity='$cmpCity', cmpAverageAllowanceGiven='$allowance' WHERE companyID='$cmpID'  ";
                $query_run = mysqli_query($conn, $query);
    
                if($query_run)
                {
                    echo "
                    <script>
                        alert('Student details update successfully');
                        document.location.href = 'ky-maintainCmp.php';
                    </script>
                    ";
                }
                else
                {
                    echo "
                    <script>
                        alert('Student details update failed, please try again.');
                        document.location.href = 'ky-maintainCmp.php';
                    </script>
                    ";
                }
            }
            else{
                $sql="select * from Company where companyID='$cmpID'";
                $result = mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($result);
                if (password_verify($oldPass, $row['cmpPassword'])){
                    if(empty($newPass)){
                        echo '<script>alert("New password is empty. Please enter new password");
                        window.history.back(1);
                        </script>';
                    }
                    else{
                        $hash = password_hash($newPass, PASSWORD_DEFAULT);
                        $query1 = "UPDATE Company SET cmpEmail='$cmpEmail', cmpContactNumber='$cmpContactNo', cmpContactPerson='$cmpContactPerson', 
                        cmpCompanySize='$cmpSize', cmpAddress='$cmpAddress', cmpFieldsArea='$cmpFieldsArea', cmpNumberOfInternshipPlacements='$cmpNumberOfInternshipPlacements', 
                        cmpState='$cmpState', cmpPostCode='$cmpPostCode', cmpCity='$cmpCity', cmpAverageAllowanceGiven='$allowance', cmpPassword='$hash' WHERE companyID='$cmpID'  ";
                        //cmpAverageAllowanceGiven='$allowance'  ;
                        $query_run1 = mysqli_query($conn, $query1);
    
                        if($query_run1)
                        {
                            echo '<script>alert("Company details update and comfirm successful."); 
                                    </script>';
                            header("Location: ../../view/page/ky-maintainCmp.php?update=1&success=1");
                        }
                        else
                        {
                            echo '<script>alert("Company details update and comfirm failed."); 
                                    </script>';
                            header("Location: ../../view/page/ky-maintainCmp.php?update=0&failed=1");
                        }
                    }
                }
                else{
                    echo '<script>alert("Old password is incorrect. Password update unsuccessful");
                                    window.history.back(1);
                                </script>';
                }
            
            }
            
            exit(0);
        }catch(PDOException $e){
            echo '<script>alert("Company details update and comfirm failed."); 
                            </script>';
            header("Location: ../../view/page/ky-maintainCmp.php?failed=1");
        }
    } 

    if(isset($_GET['Export'])){

        $id = $_GET['companyID'];
                                        
        $sql1 = "select * from Company WHERE companyID='$id'"; 
        $result1 = mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);

        $Id = $row1['companyID'];
        $name = $row1['cmpName'];
        $dateJoined = $row1['cmpDateJoined'];
                            
        $email = $row1['cmpEmail'];
        $phone = $row1['cmpContactNumber'];
        $cmpUsername = $row1['cmpContactPerson'];
        $size = $row1['cmpCompanySize'];
        $address = $row1['cmpAddress'];
        $fieldArea = $row1['cmpFieldsArea'];
        $cmpInternshipPlacement = $row1['cmpNumberOfInternshipPlacements'];
        $allowance = $row1['cmpAverageAllowanceGiven'];
        $status = $row1['cmpAccountStatus'];
        $rating= $row1['cmpRating'];
        $cmpState = $row1['cmpState'];
        $cmpCity = $row1['cmpCity'];
        $cmpPostCode = $row1['cmpPostCode'];
    
        require_once('../../../TCPDF-main/tcpdf.php');

        class PDF extends TCPDF{
            public function Header(){
            $imageFile = '../../../admin/view/images/company-tittle.JPG';
            $this->Image($imageFile, 0, 0, 210, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
            }
        
            public function Footer(){
            $this->setY(-18);
            $this->Ln(5);
        
            $this->SetFont('helvetica', 'I', 8);
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $today = date("F j, Y g:i A", time());
        
            $this->Cell(25,5,'Generate Date/Time : '.$today,0,0,'L');
            $this->Cell(170, 5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
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
        
        $pdf->Ln(4);

        $pdf->SetTextColor(0,0,255);
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(50, 3, 'Company Name & Contact', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Cell(48, 3, 'Company ID : '.$Id, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(52, 3, 'Company Name : '.$name, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Cell(78, 3, 'Email : '.$email, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(39, 3, 'Phone : '.$phone, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(42, 3, 'Contact Person : '.$cmpUsername, 0, 1, 'L');

        $pdf->Ln(8);
        $pdf->SetTextColor(0,0,255);
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(8, 3, 'Address', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Cell(175, 3, 'Company Address : '.$address, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(116, 3, 'City                          : '.$cmpCity, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(104, 3, 'Post Code                : '.$cmpPostCode, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(119, 3, 'State                         : '.$cmpState, 0, 1, 'L');

        $pdf->Ln(8);
        $pdf->SetTextColor(0,0,255);
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(28, 3, 'Company Details', 0, 1, 'C');

        $pdf->Ln(5);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Cell(41, 3, 'Company Size : '.$size, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(68, 3, 'Company Fields : '.$fieldArea, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(47, 3, 'Internship Placement : '.$cmpInternshipPlacement, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(47, 3, 'Allowance : RM'.$allowance, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(47, 3, 'Date Joined : '.$dateJoined, 0, 1, 'L');

        
        $pdf->Ln(8);
        $pdf->SetTextColor(0,0,255);
        $pdf->SetFont('times', 'B', 16);
        $pdf->Ln(1);
        $pdf->Cell(5, 3, 'Rating', 0, 1, 'C');

        $pdf->Ln(6);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('times', 'B', 25);
        $pdf->Cell(10, 3, ''.$rating,0, 0);
        $pdf->Ln(6);
        $pdf->SetTextColor(105,105,105);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(40, 3, 'out of 5', 0, 1,'C');
        $imageFile = '../images/ratingStar.png';
        $pdf->Image($imageFile, 44,198, 9, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $pdf->Output(''.$name.'.pdf', 'I');
        
    }

?>
