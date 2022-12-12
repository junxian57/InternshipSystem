<?php
require_once '../../includes/db_connection.php';

class rubricAssessmentComponentDAL
{
    protected $databaseConnectionObj;
    public function __construct()
    {
        $this->databaseConnectionObj = new DBController();
    }

    public function GetAllRubricComponentCriteria()
    {
        //$db = new DBController();
        $listOfRubricCmptCriteriaDto = array();
        $sql = "SELECT rcc.*,f.* from RubricComponentCriteria rcc JOIN Faculty f on rcc.facultyID=f.facultyID";

        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $assessmentCriteriaID = $result[$i]['criterionID'];
                $facultyName = $result[$i]['facAcronym'];
                $assessmentCriteriaTitle = $result[$i]['Title'];
                $RoleForMark = $result[$i]['RoleForMark'];
                $assessmentCriteriaSession = $result[$i]['CriteriaSession'];
                $assessmentCriteriaDesc = $result[$i]['description'];
                $Status = $result[$i]['status'];
                $CreateByID = $result[$i]['CreateByID'];
                $CreateDate = $result[$i]['CreateDate'];

                $listOfRubricCmptCriteriaDto[] = new rubricAssessmentComponentDTO($assessmentCriteriaID, $assessmentCriteriaTitle, $RoleForMark, $assessmentCriteriaSession, $assessmentCriteriaDesc, $CreateByID, $CreateDate);
                //Set status
                $listOfRubricCmptCriteriaDto[$i]->setStatus($Status);
                //Set Faculty Name
                $listOfRubricCmptCriteriaDto[$i]->setfacultyID($facultyName);
            }
        }
        return $listOfRubricCmptCriteriaDto;
    }

    public function GetRubricComponent($id)
    {
        //$db = new DBController();
        $listOfRubricCmptDto = array();
        $sql = "SELECT rc.componentID,rc.criterionID,rc.valueName,rc.score,rc.description from RubricComponentCriteria rcc left JOIN RubricComponent rc on rcc.criterionID=rc.criterionID WHERE rcc.criterionID= '$id'";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $componentID = $result[$i]['componentID'];
                $assessmentCriteriaID = $result[$i]['criterionID'];
                $valueName = $result[$i]['valueName'];
                $score = $result[$i]['score'];
                $CriteriaCmpDesc = $result[$i]['description'];
                $listOfRubricCmptDto[] = new rubricComponentDTO($componentID, $assessmentCriteriaID, $valueName, $score, $CriteriaCmpDesc);
            }
        }
        return $listOfRubricCmptDto;
    }
    /**
     * Get a Component Level
     *
     * @param string $criterionID
     * @return bool|\rubricAssessmentComponentDTO
     */
    public function GetRubricCmptCriteria($ID)
    {
        $sql = "SELECT * FROM RubricComponentCriteria WHERE criterionID = '$ID'";
        $aRubricCmptCriteria = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($aRubricCmptCriteria)) {
            $listOfRubricCmptLvlObj = new rubricAssessmentComponentDTO(
                $aRubricCmptCriteria[0]['criterionID'],
                $aRubricCmptCriteria[0]['Title'],
                $aRubricCmptCriteria[0]['RoleForMark'],
                $aRubricCmptCriteria[0]['CriteriaSession'],
                $aRubricCmptCriteria[0]['description'],
                $aRubricCmptCriteria[0]['CreateByID'],
                $aRubricCmptCriteria[0]['CreateDate']

            );
            $listOfRubricCmptLvlObj->setfacultyID($aRubricCmptCriteria[0]['facultyID']);
            return $listOfRubricCmptLvlObj;
        }

        return false;
    }

    //generate ID
    public function generateID()
    {
        $db = new DBController();
        //Will be descending order
        $sql = "SELECT * FROM RubricComponentCriteria ORDER BY criterionID DESC";
        $result = $db->runQuery($sql);
        $prefix = 'CMPCA';

        if (empty($result)) {
            $prefix .= '00001';
            return $prefix;
        }

        //Get the first ID 
        $lastID = $result[0]['criterionID'];
        //SubString to last part of ID
        $numberPart = substr($lastID, 5, 5);

        if ((int) $numberPart < 9) {
            $prefix .= '0000' . ((int) $numberPart + 1);
        } else if ((int) $numberPart >= 9) {
            $prefix .= '000' . ((int) $numberPart + 1);
        }

        return $prefix;
    }

    //generate ID
    public function generateRubricCmptID()
    {
        $db = new DBController();
        //Will be descending order
        $sql = "SELECT * FROM RubricComponent ORDER BY componentID DESC";
        $result = $db->runQuery($sql);
        $prefix = 'CMP';

        if (empty($result)) {
            $prefix .= '000001';
            return $prefix;
        }

        //Get the first ID 
        $lastID = $result[0]['componentID'];
        //SubString to last part of ID
        $numberPart = substr($lastID, 3, 6);
        if ((int) $numberPart < 9) {
            $prefix .= '00000' . ((int) $numberPart + 1);
        } else if ((int) $numberPart >= 9) {
            $prefix .= '0000' . ((int) $numberPart + 1);
        }

        return $prefix;
    }

    /**
     * Insert New Student
     *
     * @param object $studentDto
     */
    public function AddRubricCmpCriteria($rubricCmpCriteriaDto, $rubricCmpDto)
    {
        $sql = "INSERT INTO RubricComponentCriteria (`criterionID`, `facultyID`,`Title`, `RoleForMark`,`CriteriaSession`,`description`,`status`,`CreateByID`,`CreateDate`)
                VALUES (
                  '" . $rubricCmpCriteriaDto->getcriterionID() . "',
                  '" . $rubricCmpCriteriaDto->getfacultyID() . "',
                  '" . $rubricCmpCriteriaDto->getTitle() . "',
                  '" . $rubricCmpCriteriaDto->getRoleForMark() . "',
                  '" . $rubricCmpCriteriaDto->getCriteriaSession() . "',
                  '" . $rubricCmpCriteriaDto->getDesc() . "',
                  'activate',
                  '" . $rubricCmpCriteriaDto->getCreateID() . "',
                  '" . $rubricCmpCriteriaDto->getCreateDate() . "'
                )";

        $result = $this->databaseConnectionObj->executeQuery($sql);

        foreach ($rubricCmpDto as $rubricCmpDto1) {
            $sql1 = "INSERT INTO RubricComponent (`componentID`,`criterionID`,`valueName`,`score`,`description`)
                VALUES (
                  '" . $rubricCmpDto1->getcmptID() . "',
                  '" . $rubricCmpDto1->getcriterionID() . "',
                  '" . $rubricCmpDto1->getvalueName() . "',
                  '" . $rubricCmpDto1->getscore() . "',
                  '" . $rubricCmpDto1->getcriteriaCmpDesc() . "'
                )";
            $result2 = $this->databaseConnectionObj->executeQuery($sql1);
        }

        //location
        if ($result && $result2) {
            header("Location: addRubricComponentCriteria.php?status=success");
            exit();
        } else {
            header("Location: addRubricComponentCriteria.php?status=failed");
            exit();
        }
    }

    /**
     * Update Rubric Assessment
     *
     * @param object $rubricCmpCriteriaDto
     * @param object $rubricCmpDto
     */
    public function UpdRubricCmpCriteria($rubricCmpCriteriaDto, $rubricCmpDto)
    {
        $sql = " UPDATE RubricComponentCriteria SET
            facultyID='" . $rubricCmpCriteriaDto->getfacultyID() . "',
            Title = '" . $rubricCmpCriteriaDto->getTitle() . "',
            RoleForMark = '" . $rubricCmpCriteriaDto->getRoleForMark() . "',
            CriteriaSession = '" . $rubricCmpCriteriaDto->getCriteriaSession() . "',
            description = '" . $rubricCmpCriteriaDto->getDesc() . "'
            WHERE criterionID ='" . $rubricCmpCriteriaDto->getcriterionID() . "'";
        $result = $this->databaseConnectionObj->executeQuery($sql);

        foreach ($rubricCmpDto as $rubricCmpDto1) {
            $sql2 = " UPDATE RubricComponent SET
            valueName = '" . $rubricCmpDto1->getvalueName() . "',
            score = '" . $rubricCmpDto1->getscore() . "',
            description = '" . $rubricCmpDto1->getcriteriaCmpDesc() . "'
            WHERE criterionID ='" . $rubricCmpDto1->getcriterionID() . "' AND componentID ='" . $rubricCmpDto1->getcmptID() . "'";
            $result2 = $this->databaseConnectionObj->executeQuery($sql2);
        }
        if ($result && $result2) {
            header("Location: ../../view/page/addRubricComponentCriteria.php?act=edit&status=success&id='" . $rubricCmpCriteriaDto->getcriterionID() . "'");
            exit();
        } else {
            header("Location: ../../view/page/addRubricComponentCriteria.php?act=edit&status=failed&id='" . $rubricCmpCriteriaDto->getcriterionID() . "'");
            exit();
        }
    }

    /**
     * Checks whether given Rubric Component Level exists
     *
     * @param string $tiitle
     * @param string $RoleForMark
     * @param string $session
     * @return bool
     */
    public function IsValidRubricCmpExists($Title, $RoleForMark, $session, $facultyID)
    {
        $sql = "SELECT * FROM RubricComponentCriteria WHERE Title LIKE'%" . $Title . "%' AND RoleForMark ='" . $RoleForMark . "' AND CriteriaSession LIKE'%" . $session . "%' AND facultyID='" . $facultyID . "'";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }
}
