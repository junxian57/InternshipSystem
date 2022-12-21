<?php

/**
 * Class for database interaction
 */
require_once("../../includes/db_connection.php");

class visitationMapDAL
{

    protected $databaseConnectionObj;
    public function __construct()
    {
        $this->databaseConnectionObj = new DBController();
    }
    /**
     * Get All VisitationList
     *
     * @return array
     */
    public function GetAllVisitationMapList()
    {
        //$db = new DBController();
        $listOfVisitationMapDto = array();
        $sql = "SELECT * from VisitationApplicationMap";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $Visitation_AppMapID = $result[$i]['Visitation_AppMapID'];
                $Visitation_CompanyID = $result[$i]['Visitation_CompanyID'];
                $Status = $result[$i]['status'];
                $createByID = $result[$i]['CreateByid'];
                $createDate = $result[$i]['CreateDate'];
                $listOfVisitationMapDto[] = new visitationMapDTO($Visitation_AppMapID, $Visitation_CompanyID, $createByID, $createDate);

                //Set status
                $listOfVisitationMapDto[$i]->setStatus($Status);
            }
        }
        return $listOfVisitationMapDto;
    }

    /**
     * Get a student
     *
     * @param string $Visitation_AppMapID
     * @return bool|\visitationMapDTO
     */
    public function GetvisitationMapList($Visitation_AppMapID)
    {
        $sql = "SELECT * FROM VisitationApplicationMap WHERE Visitation_AppMapID= '$Visitation_AppMapID'";
        $avisitList = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($avisitList)) {
            $listOfVisitationMapObj = new visitationMapDTO(
                $avisitList[0]['Visitation_AppMapID'],
                $avisitList[0]['Visitation_CompanyID'],
                $avisitList[0]['CreateByID'],
                $avisitList[0]['CreateDate']
            );
            return $listOfVisitationMapObj;
        }
        return false;
    }

    //generate ID
    public function generateID()
    {
        $db = new DBController();
        //Will be descending order
        $sql = "SELECT * FROM VisitationApplicationMap ORDER BY Visitation_AppMapID DESC";
        $result = $db->runQuery($sql);
        $prefix = 'VSTAM';

        if (empty($result)) {
            $prefix .= '000001';
            return $prefix;
        }

        //Get the first ID 
        $lastID = $result[0]['Visitation_AppMapID'];
        //SubString to last part of ID
        $numberPart = substr($lastID, 5, 6);

        if ((int) $numberPart < 9) {
            $prefix .= '00000' . ((int) $numberPart + 1);
        } else if ((int) $numberPart >= 9) {
            $prefix .= '0000' . ((int) $numberPart + 1);
        }

        return $prefix;
    }

    /**
     * Insert New Rubric Assessment
     *
     * @param object $visitationListDTO
     */
    public function AddvisitationMapList($visitationMapDTO, $visitationMapListDTO)
    {
        require_once "../../../config/email.php";
        $emailConfig = new EmailConfig();
        $sql = "INSERT INTO VisitationApplicationMap (`Visitation_AppMapID`, `Visitation_CompanyID` ,`status`,`CreateByID`,`CreateDate`)
                VALUES (
                  '" . $visitationMapDTO->getVisitation_AppMapID() . "',
                  '" . $visitationMapDTO->getVisitation_CompanyID() . "',
                  'activate',
                  '" . $visitationMapDTO->getCreateByID() . "',
                  '" . $visitationMapDTO->getCreateDate() . "'
                )";
        $result = $this->databaseConnectionObj->executeQuery($sql);
        foreach ($visitationMapListDTO as $visitationMapListDTO1) {
            $sql1 = "INSERT INTO VisitationApplicationMapList (`Visitation_AppMapID`,`lecturerID`,`lecName`,`lecEmail`)
                    VALUES (
                      '" . $visitationMapListDTO1->getVisitation_AppMapID() . "',
                      '" . $visitationMapListDTO1->getlecturerID() . "',
                      '" . $visitationMapListDTO1->getlecName() . "',
                      '" . $visitationMapListDTO1->getlecEmail() . "'
                    )";

            $emailConfig->singleEmail(
                $visitationMapListDTO1->getlecEmail(),
                "Visitation List",
                $this->createHTMLEmail($visitationMapDTO->getVisitation_AppMapID(), $visitationMapDTO->getVisitation_CompanyID())
            );

            $result2 = $this->databaseConnectionObj->executeQuery($sql1);
        }
        if ($result && $result2) {

            header("Location: ../../view/page/cch_companyVisitation-Map.php?status=success");
            exit();
        } else {
            header("Location: ../../view/page/cch_companyVisitation-Map.php?status=failed");
            exit();
        }
    }

    function createHTMLEmail($companyName, $companyAccount)
    {
        echo ("diu");
        $html = "
        <html>
        <head>
            <title>Company Visitation List</title>
        </head>
        <body>
            <p>Dear Sir/Madam,</p>
            <p>Welcome To TARUMT Internship System.</p>
            <br>
            <p>Your company  <span style='font-weight: bold;'>($companyName)</span> application as our internship partner has been <span style='color:#44ab15; font-weight: bold; text-decoration:underline;'>Approved</span>.</p> 
            <p>Company Account: <span style='color:#ff4500; font-weight: bold;'>$companyAccount</span></p>
            <br>
            <p>Thank you.</p>
        </body>
        </html>";

        return $html;
    }

    /**
     * Update visitation List
     *
     * @param object $visitationListDTO
     */
    public function UpdatevisitationMapListDTO($visitationMapListDTO)
    {
        $sql = " UPDATE VisitationApplicationMap SET
            Visitation_CompanyID = '" . $visitationMapListDTO->getVisitation_CompanyID() . "',
            WHERE Visitation_AppMapID ='" . $visitationMapListDTO->getVisitation_AppMapID() . "'";
        $result = $this->databaseConnectionObj->executeQuery($sql);
        if ($result) {
            header("Location: ../../view/page/RubricAssessment-Maintain.php?act=edit&status=success&id='" . $visitationMapListDTO->getVisitation_AppMapID() . "'");
            exit();
        } else {
            header("Location: ../../view/page/RubricAssessment-Maintain.php?act=edit&status=failed&id='" . $visitationMapListDTO->getVisitation_AppMapID() . "'");
            exit();
        }
    }

    /**
     * Checks whether the record are exists in this session or not
     *
     * @param string $Visitation_AppMapID
     * @param string $Visitation_CompanyID
     * @return bool
     */
    public function IsCompanyVisitationMapExists($Visitation_AppMapID, $Visitation_CompanyID)
    {
        $sql = "SELECT * FROM VisitationApplicationMap WHERE Visitation_AppMapID = '$Visitation_AppMapID' AND Visitation_CompanyID = '$Visitation_CompanyID' ";
        $result = $this->databaseConnectionObj->runQuery($sql);

        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }
}
