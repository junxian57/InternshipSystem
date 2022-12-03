<?php
include('../../includes/db_connection.php');
    if(isset($_POST['Exportpdf'])){

        $id = $_POST['update_id'];

        $db = new DBController();
                                        
        $sql = "select * from Company WHERE companyID='$id'"; 
        $result = $db->runQuery($sql);

        if(count($result) > 0){
            foreach ($result as $company) {
                $Id = $company['companyID'];
                $name = $company['cmpName'];
                $dateJoined = $company['cmpDateJoined'];
                                    
                $email = $company['cmpEmail'];
                $phone = $company['cmpContactNumber'];
                $cmpUsername = $company['cmpContactPerson'];
                $size = $company['cmpCompanySize'];
                $address = $company['cmpAddress'];
                $fieldArea = $company['cmpFieldsArea'];
                $cmpInternshipPlacement = $company['cmpNumberOfInternshipPlacements'];
                $allowance = $company['cmpAverageAllowanceGiven'];
                $status = $company['cmpAccountStatus'];
                $rating= $company['cmpRating'];
            }
        }

        require_once('../../../TCPDF-main/tcpdf.php');

        class PDF extends TCPDF{
            public function Header(){
            $imageFile = '../images/company-tittle.JPG';
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
        $pdf->Cell(55, 3, 'General Company Information', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Cell(48, 3, 'Company ID : '.$Id, 0, 1, 'L');
        $pdf->Cell(52, 3, 'Company Name : '.$name, 0, 1, 'L');
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(175, 3, 'Company Address : '.$address, 0, 1, 'L');
        $pdf->SetFont('times', 'B', 13);
        $pdf->Cell(41, 3, 'Company Size : '.$size, 0, 1, 'L');
        $pdf->Cell(68, 3, 'Company Fields : '.$fieldArea, 0, 1, 'L');
        $pdf->Cell(47, 3, 'Date Joined : '.$dateJoined, 0, 1, 'L');

        $pdf->Ln(8);
        $pdf->SetTextColor(0,0,255);
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(55, 3, 'Company contact information', 0, 1, 'C');

        $pdf->Ln(6);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Cell(78, 3, 'Email : '.$email, 0, 1, 'L');
        $pdf->Cell(39, 3, 'Phone : '.$phone, 0, 1, 'L');
        $pdf->Cell(42, 3, 'Contact Person : '.$cmpUsername, 0, 1, 'L');

        $pdf->Ln(10);
        $pdf->SetTextColor(0,0,255);
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(62, 3, 'Company Internship information', 0, 1, 'C');

        $pdf->Ln(6);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Cell(47, 3, 'Internship Placement : '.$cmpInternshipPlacement, 0, 1, 'L');
        $pdf->Cell(47, 3, 'Allowance : RM'.$allowance, 0, 1, 'L');
        
        $pdf->Ln(12);
        $pdf->SetTextColor(0,0,255);
        $pdf->SetFont('times', 'B', 16);
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
        $pdf->Image($imageFile, 44,176, 9, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $pdf->Output(''.$name.'.pdf', 'I');
        
    }

?>