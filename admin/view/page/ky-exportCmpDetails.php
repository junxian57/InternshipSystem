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
                $cmpState = $company['cmpState'];
                $cmpCity = $company['cmpCity'];
                $cmpPostCode = $company['cmpPostCode'];

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

    //use PhpOffice\PhpSpreadsheet\Spreadsheet;
    //use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    //use PhpOffice\PhpSpreadsheet\Writer\Xls;
    //use PhpOffice\PhpSpreadsheet\Writer\Csv;

    if(isset($_POST['ExportAllcmp'])){

        $date = Date('Y-m-d');
        $filename = "Companies details - $date";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; Filename = $filename.xls");
        require 'ky-cmpData.php';
    }


        /*if(count($result1) > 0){

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'ID');
            $sheet->setCellValue('B1', 'Name');
            $sheet->setCellValue('C1', 'Date Added');
            $sheet->setCellValue('D1', 'Email');
            $sheet->setCellValue('E1', 'Contact Number');
            $sheet->setCellValue('F1', 'Companu Contact Person');
            $sheet->setCellValue('G1', 'Size');
            $sheet->setCellValue('H1', 'Address');
            $sheet->setCellValue('I1', 'State');
            $sheet->setCellValue('J1', 'City');
            $sheet->setCellValue('K1', 'Post Code');
            $sheet->setCellValue('L1', 'Company Fields Area');
            $sheet->setCellValue('M1', 'Company Internship Placement');
            $sheet->setCellValue('N1', 'Account Status');
            $sheet->setCellValue('O1', 'Rating');

            $rowCount = 2;
            foreach ($result1 as $company1) {

                $sheet->setCellValue('A'.$company1['companyID']);
                $sheet->setCellValue('B'.$company1['cmpName']);
                $sheet->setCellValue('C'.$company1['cmpDateJoined']);
                $sheet->setCellValue('D'.$company1['cmpEmail']);
                $sheet->setCellValue('E'.$company1['cmpContactNumber']);
                $sheet->setCellValue('F'.$company1['cmpContactPerson']);
                $sheet->setCellValue('G'.$company1['cmpCompanySize']);
                $sheet->setCellValue('H'.$company1['cmpAddress']);
                $sheet->setCellValue('I'.$company1['cmpState']);
                $sheet->setCellValue('J'.$company1['cmpCity']);
                $sheet->setCellValue('K'.$company1['cmpPostCode']);
                $sheet->setCellValue('L'.$company1['cmpFieldsArea']);
                $sheet->setCellValue('M'.$company1['cmpNumberOfInternshipPlacements']);
                $sheet->setCellValue('N'.$company1['cmpAccountStatus']);
                $sheet->setCellValue('O'.$company1['cmpRating']);
                $rowCount++;
            
            }
            $writer = new Xls($spreadsheet);
            $final_filename = $fileName.'.xls';

            // $writer->save($final_filename);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attactment; filename="'.urlencode($final_filename).'"');
            $writer->save('php://output');

            }
            else
            {
                echo "
                    <script>
                        alert('No record found');
                        document.location.href = 'ky-cmpMaintain.php';
                    </script>
                    ";
                exit(0);
            }
            */

    if(isset($_POST['ExportAllstud'])){

        $date = Date('Y-m-d');
        $filename = "Students details - $date";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; Filename = $filename.xls");
        require 'ky-studData.php';
    }
        
        
?>