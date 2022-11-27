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
$pdf->SetTitle('Final Report Sample');
$pdf->SetSubject('Final Report Sample');
$pdf->SetKeywords('Final Report Sample');

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

$pdf->Cell(180, 3, 'Guidewire Software Sdn Bhd', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Suite 29-2, Level 29, Vertical Corporate Tower B', 0, 1, 'C');
$pdf->Cell(180, 3, 'Jalan Kerinchi, Bangsar South', 0, 1, 'C'); 
$pdf->Cell(180, 3, '59200 Kuala Lumpur', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'From 5 December 2022 To 5 June 2023', 0, 1, 'C');
$pdf->Ln(30);

$pdf->Cell(180, 3, 'Prepared By', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Wong Hao Jie', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Diploma in Business Information Systems', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Ms Pong Suk Fun', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Faculty of Computing and Information Technology', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Tunku Abdul Rahman University of Management and Technology', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(180, 3, 'Kuala Lumpur', 0, 1, 'C');
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
$pdf->Cell(189, 3, 'Wong Hao Jie', 0, 1, 'L');

$pdf->Ln(2);
$pdf->Cell(189, 3, 'Date (dd/mm/yyyy): 30 April 2023', 0, 1, 'L');

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Acknowledgements', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(175, 15, 'First and foremost, I would like to mention that I am very happy to have this opportunity to study at Tunku Abdul Rahman University College. In addition, I would also like to thank Tunku Abdul Rahman University College of Computer and Information Technology (FOCS) for providing us with the opportunity to receive industrial training or internships as part of our academic courses.', 0, 'J', 0, 1, '', '', true);

$pdf->Ln(10);
$pdf->MultiCell(175, 15, 'Besides, I want to express my gratitude to my teachers for providing us with a convenient company list so that we can find a suitable company for training. I also want to thank Ms Pong Suk Fun (Leader of Industrial Training) for helping us solve all the problems when looking for an intern company and also provide us with some things to pay attention to. Besides, I also want to thank Mr. Wong Hon Yoo for giving a lot of advice on the internship.', 0, 'J', 0, 1, '', '', true);

$pdf->Ln(10);
$pdf->MultiCell(175, 15, 'In addition, I would like to thank my intern company Guidewire Software Sdn Bhd for accepting my application for a 10-week industrial training program in his company. In addition, I am very grateful to this company for providing me with social experience and extracurricular knowledge. I would also like to thank my company supervisor, Ms Amelia Ling, who carefully explained the company regulations to me during my internship and helped us solve big and small things.', 0, 'J', 0, 1, '', '', true);

$pdf->Ln(10);
$pdf->MultiCell(175, 15, 'Finally, I want to thank myself for spending 6 months of internship and for making me more perseverance and patience. In this internship, my work ability has improved and I can deal with different kind of tasks more effectively.', 0, 'J', 0, 1, '', '', true);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Abstract', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(175, 15, 'Industrial training is a mandatory course that shall be taken by Faculty of Computing and Information Technology (FOCS) in diploma student before graduation. My industrial training course was in Guidewire Software Sdn Bhd for the duration of 6 months. The firm is an alternative treatment centre, so the IT department will not need to deal with many projects or systems like other companies. Throughout these 10 weeks, I have been assigned to E-commence and Web design task. Therefore, I learned how to operate and manage seller centres for e-commerce and mobile commerce during the internship. At the same time, I also learned how to actually operate e-commerce. In addition, I also learned how to test, experience and observe the UI and UX interface of the website. I also learned how to give corresponding effective opinions and better suggestions. The objectives of this industry training are to make students understand the real work life, so that they have a deeper understanding of the courses they are engaged in, and provide them with appropriate job-related training occupations. In addition to industrial training, it can also cultivate our skills, teamwork and technical knowledge. This also allows students to take this opportunity to truly understand the courses they need to learn. It will be useful to me as a student in the field of computer and information technology.', 0, 'J', 0, 1, '', '', true);

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
$pdf->Cell(55, 66, 'Industrial training scheme', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 11.5);
$pdf->MultiCell(120, 15, 'Industrial training is a compulsory course, the purpose is to provide students with a good opportunity to establish connections before graduation. Through industry training, it can gain an in-depth understanding of your chosen profession. Industrial training can be provided to students to apply technical and non-technical skills in a real work environment. Students can also evaluate real-life tasks and projects through the industry experience gained. This may also expose students to things that may be challenging and beneficial in reality. Students can also show a professional attitude towards work and responsibilities. Students can use the experience gained in industry training to discuss and evaluate relevant issues in the actual research field. Students will also comply with the necessity and importance of company rules and regulations.', 1, 'J', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 27, 'Industrial training scopes', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 25, 'I was assigned to intern in the companys IT department. In this internship, I was assigned to the e-commerce team and was responsible for e-commerce tasks with other interns. My task is to manage the seller centre of e-commerce. Besides, I contribute to the companys official website and web pages.', 1, 'J', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 38, 'Company background', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 35, 'Guidewire Software Sdn Bhd is a provider of software and data services to the property and casualty insurance industry. The companys products cover the three primary operational functions of an insurance provider: policy, billings and claims. Guidewire also offers data and analytics services that allow its customers to run their businesses more effectively. The company was founded in 2001 by a team that included current Chairman Marcus Ryu.', 1, 'J', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 37, 'Business operation', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 25, 'Guidewire has a substantial lead in terms of market share over its nearest competitors, Duck Creek Technologies (public company) and Majesco (private company). The success of Guidewire Cloud gives us confidence that the company will at least maintain its market share. While our investment doe not depend on Guidewire becoming a monopoly provider, we do believe the companys shift to the cloud creates an opportunity to expand share.', 1, 'J', 0, 1, '', '', true);

$pdf->AddPage();
$pdf->Ln(20);
$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 65, 'Structures of project', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 25, 'The company only exists to serve its customers. The purpose of growing our harvest and increasing the fertility of our soil is to better serve our customers. "Staying customer-centric and creating value for customers" are the companys common values. The conferment of authority is required to drive the facilitation and implementation of the companys common values. However, without effective controls in place, authority un-checked will ultimately hinder such common values. The company has a well-developed internal governance structure, under which all governance bodies have clear and focused authority and responsibility, but operate under checks and balances. This creates a closed cycle of authority and achieves rational and cyclical succession of authority.', 1, 'J', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 35, 'Training department', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 25, 'My training department is IT department. In the IT department of my industry training, they will implement governance for the use of the network and operating system. The IT department can also fundamentally improve the company’s employees’ ability to communicate, collaborate and automate daily tasks. And usually provide the team with the functions needed to perform their duties.', 1, 'J', 0, 1, '', '', true);

$pdf->SetFont('times', '', 12);
$pdf->Cell(55, 43, 'Training personnel', 1, 0, 'C', 1);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(120, 25, 'Mr Wong Jian Han is a good manager, and his attitude towards interns is very good and very good. Whenever the team or regular employees encounter problems, he will try his best to assist us. In addition, he will also help us communicate with the boss about our suggestions or problems. Dean Bin Jamaludin is a very friendly team leader. Whenever we have a problem, he will explain patiently. He is responsible for intern and he is very dedicated. He will introduce all the work content to us.', 1, 'J', 0, 1, '', '', true);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Chapter 2: Project Background and Responsibilities', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(175, 15, 'During my internship, my main task was to manage e-commerce and mobile commerce. At the same time, I was also a tester for the companys web or website. The reason I was assigned these tasks was because they saw that I had studied in my courses (web design, development and e-commerce, mobile commerce and marketing, application development), because I have a basic foundation, it can make them easier when they are teaching. My main task include add new products or modify old products to be sold, order processing and shipping and change product content.', 0, 'J', 0, 1, '', '', true);

$pdf->Ln(10);
$pdf->MultiCell(175, 15, 'I am mainly responsible for the management of Mudah in e-commerce. Since Mudah has too few orders every month, I usually help the online store (Lazada) to process their orders. The companys commercial electronic sales include medical protective clothing, massage coupons, and automatic massage guns. It is easy to get started when I do e-commerce. This is because I used to study similar courses at TARUC and I used Shopline in the course. ', 0, 'J', 0, 1, '', '', true);

$pdf->Ln(10);
$pdf->MultiCell(175, 15, 'Through the understanding of Mudah seller centre, Mudah has many restrictions such as a Mudah post can only put up to 6 photos or videos. But Mudah is a platform that is easy to use. Its functions are all designed to be very simple, which makes it easy for sellers to use. In this e-commerce, I also learned how to process orders. During the ordering process, I learned how to carry out the operation and packaging process. Whenever there is a package to be mailed, I will send the package to The Garden. When I work from home, other staff will help me go to The Garden to send the package.', 0, 'J', 0, 1, '', '', true);

$pdf->AddPage();

$pdf->Ln(23);
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(189, 3, 'Chapter 3: Conclusions & Recommendations', 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(175, 10, 'I have gained a lot of benefits during the 10 weeks of industry training. First, for the first time, I learned how to make a resume, how to interview, how to find a job, etc. In fact, we have been constantly training before the 10-week industry training, because through this experience, I have learned that I can filter and choose through different websites.', 0, 'J', 0, 1, '', '', true);

$pdf->Ln(10);
$pdf->MultiCell(175, 15, 'During the internship, I also learned how to stick to my perseverance. Whenever I am facing a different thing or task, I will persist in completing the task within the available time. Even if I spend a lot of time in research, I persist and complete the task. Of course, I also learned a lot of different things such as: how to quickly adapt to the company environment, how to maintain a good relationship with other people, how to adjust your own state, and etc. This company has taught me a lot. This can also ensure that I have the ability to meet various challenges in the next company and to properly solve the problems encountered.', 0, 'J', 0, 1, '', '', true);

$pdf->Ln(10);
$pdf->MultiCell(175, 15, 'Although I have learned a lot of knowledge in different fields in this company, I am also a bit regretful that I cannot get in-depth and direct contact with the IT field. Although IT was not my first choice at the beginning, I hope my choice was not wrong and more determined. But I still thank the school for giving us this opportunity to experience “work”.', 0, 'J', 0, 1, '', '', true);

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
