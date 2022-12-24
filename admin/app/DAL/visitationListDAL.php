<?php

/**
 * Class for database interaction
 */
require_once("../../includes/db_connection.php");
class visitationListDAL
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
    public function GetAllVisitationList()
    {
        //$db = new DBController();
        $listOfVisitationDto = array();
        $sql = "SELECT * from VisitationCompany";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $Visitation_CompanyID = $result[$i]['Visitation_CompanyID'];
                $internshipBatchID = $result[$i]['internshipBatchID'];
                $Status = $result[$i]['status'];
                $CreateByID = $result[$i]['CreateByid'];
                $CreateDate = $result[$i]['CreateDate'];
                $listOfVisitationDto[] = new visitationListDTO($Visitation_CompanyID, $internshipBatchID, $CreateByID, $CreateDate);

                //Set status
                $listOfVisitationDto[$i]->setStatus($Status);
            }
        }
        return $listOfVisitationDto;
    }

    /**
     * Get a student
     *
     * @param string $Visitation_CompanyID
     * @return bool|\visitationListDTO
     */
    public function GetvisitationList($Visitation_CompanyID)
    {
        $sql = "SELECT * FROM VisitationCompany WHERE Visitation_CompanyID= '$Visitation_CompanyID'";
        $avisitList = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($avisitList)) {
            $listOfvisitationListObj = new visitationListDTO(
                $avisitList[0]['Visitation_CompanyID'],
                $avisitList[0]['internshipBatchID'],
                $avisitList[0]['CreateByID'],
                $avisitList[0]['CreateDate']
            );
            $listOfvisitationListObj->setinternAppID($avisitList[0]['internAppID']);
            return $listOfvisitationListObj;
        }

        return false;
    }

    //generate ID
    public function generateID()
    {
        $db = new DBController();
        //Will be descending order
        $sql = "SELECT * FROM VisitationCompany ORDER BY Visitation_CompanyID DESC";
        $result = $db->runQuery($sql);
        $prefix = 'VSTCP';

        if (empty($result)) {
            $prefix .= '000001';
            return $prefix;
        }

        //Get the first ID 
        $lastID = $result[0]['Visitation_CompanyID'];
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
    public function AddvisitationCompanyList($visitationListDTO, $visitationCompanyListDTO)
    {
        $sql = "INSERT INTO VisitationCompany (`Visitation_CompanyID`, `internshipBatchID` ,`status`,`CreateByID`,`CreateDate`)
                VALUES (
                  '" . $visitationListDTO->getVisitation_CompanyID() . "',
                  '" . $visitationListDTO->getInternshipBatchID() . "',
                  'activate',
                  '" . $visitationListDTO->getCreateByID() . "',
                  '" . $visitationListDTO->getCreateDate() . "'
                )";
        $result = $this->databaseConnectionObj->executeQuery($sql);
        foreach ($visitationCompanyListDTO as $visitationCompanyListDto1) {
            $sql1 = "INSERT INTO VisitationCompanyList (`Visitation_CompanyID`,`CompanyID`,`cmpName`)
                    VALUES (
                      '" . $visitationCompanyListDto1->getVisitation_CompanyID() . "',
                      '" . $visitationCompanyListDto1->getCompanyID() . "',
                      '" . $visitationCompanyListDto1->getcmpname() . "'
                    )";
            echo $sql1;
            $result2 = $this->databaseConnectionObj->executeQuery($sql1);
        }
        if ($result &&  $result2) {

            header("Location: ../../view/page/cch_AddVisitationList.php?status=success");
            exit();
        } else {
            header("Location: ../../view/page/cch_AddVisitationList.php?status=failed");
            exit();
        }
    }

    /**
     * Update visitation List
     *
     * @param object $visitationListDTO
     */
    public function UpdatevisitationListDTO($visitationListDTO)
    {
        $sql = " UPDATE VisitationCompany SET
            internshipBatchID = '" . $visitationListDTO->getInternshipBatchID() . "',
            internAppID='" . $visitationListDTO->getinternAppID() . "',
            WHERE Visitation_CompanyID ='" . $visitationListDTO->getVisitation_CompanyID() . "'";
        $result = $this->databaseConnectionObj->executeQuery($sql);
        if ($result) {
            header("Location: ../../view/page/RubricAssessment-Maintain.php?act=edit&status=success&id='" . $visitationListDTO->getVisitation_CompanyID() . "'");
            exit();
        } else {
            header("Location: ../../view/page/RubricAssessment-Maintain.php?act=edit&status=failed&id='" . $visitationListDTO->getVisitation_CompanyID() . "'");
            exit();
        }
    }

    /**
     * Checks whether the record are exists in this session or not
     *
     * @param string $Visitation_CompanyID
     * @param string $internshipBatchID
     * @param string $internAppID
     * @return bool
     */
    public function IsCompanySelectionExists($Visitation_CompanyID, $internshipBatchID, $internAppID)
    {
        $sql = "SELECT * FROM CompanyVisitation WHERE Visitation_CompanyID = '$Visitation_CompanyID' AND internshipBatchID = '$internshipBatchID' AND internAppID = '$internAppID' ";
        $result = $this->databaseConnectionObj->runQuery($sql);

        if (!empty($result)) {
            return false;
        } else {
            return true;
        }
    }
}
