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
        $sql = "SELECT * from RubricComponentCriteria";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $assessmentCriteriaID = $result[$i]['criterionID'];
                $assessmentCriteriaTitle = $result[$i]['Title'];
                $RoleForMark = $result[$i]['RoleForMark'];
                $assessmentCriteriaSession = $result[$i]['CriteriaSession'];
                $assessmentCriteriaDesc = $result[$i]['Desc'];
                $CreateByID = $result[$i]['CreateByID'];
                $CreateDate = $result[$i]['CreateDate'];

                $listOfRubricCmptCriteriaDto[] = new rubricAssessmentComponentDTO($assessmentCriteriaID, $assessmentCriteriaTitle, $RoleForMark, $assessmentCriteriaSession, $assessmentCriteriaDesc, $CreateByID, $CreateDate);
            }
        }
        return $listOfRubricCmptCriteriaDto;
    }

    public function GetRubricComponent($id)
    {
        //$db = new DBController();
        $listOfRubricCmptDto = array();
        $sql = "SELECT rc.levelID,rc.criterionID,rc.Desc from RubricComponentCriteria rcc left JOIN RubricComponent rc on rcc.criterionID=rc.criterionID WHERE rcc.criterionID= '$id'";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $cmpLvlValue = $result[$i]['levelID'];
                $cmpLvlValue = $result[$i]['levelID'];
                $assessmentCriteriaID = $result[$i]['criterionID'];
                $valueName = $result[$i]['valueName'];
                $CriteriaCmpDesc = $result[$i]['Desc'];
                //nid change
                $listOfRubricCmptDto[] = new rubricComponentDTO($cmpLvlValue, $assessmentCriteriaID, $cmpLvlValue, $valueName, $CriteriaCmpDesc);
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
                $aRubricCmptCriteria[0]['Desc'],
                $aRubricCmptCriteria[0]['CreateByID'],
                $aRubricCmptCriteria[0]['CreateDate']

            );
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
        $sql = "INSERT INTO RubricComponentCriteria (`criterionID`, `Title`, `RoleForMark`,`CriteriaSession`,`Desc`,`CreateByID`,`CreateDate`)
                VALUES (
                  '" . $rubricCmpCriteriaDto->getcriterionID() . "',
                  '" . $rubricCmpCriteriaDto->getTitle() . "',
                  '" . $rubricCmpCriteriaDto->getRoleForMark() . "',
                  '" . $rubricCmpCriteriaDto->getCriteriaSession() . "',
                  '" . $rubricCmpCriteriaDto->getDesc() . "',
                  '" . $rubricCmpCriteriaDto->getCreateID() . "',
                  '" . $rubricCmpCriteriaDto->getCreateDate() . "'
                )";

        $result = $this->databaseConnectionObj->executeQuery($sql);

        foreach ($rubricCmpDto as $rubricCmpDto1) {
            $sql1 = "INSERT INTO RubricComponent (`componentID`,`levelID`,`criterionID`,`valueName`,`Desc`)
                VALUES (
                  '" . $rubricCmpDto1->getcmptID() . "',
                  '" . $rubricCmpDto1->getlevelID() . "',
                  '" . $rubricCmpDto1->getcriterionID() . "',
                  '" . $rubricCmpDto1->getvalueName() . "',
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
     * @param object $rubricAssmtDto
     */
    public function UpdRubricCmpLvl($cmpLvlDto)
    {
        $sql = " UPDATE RubricComponentLevel SET
            Title = '" . $cmpLvlDto->getcmpTitle() . "',
            Value = '" . $cmpLvlDto->getValue() . "'
            WHERE levelID ='" . $cmpLvlDto->getCmpLvlID() . "'";
        $result = $this->databaseConnectionObj->executeQuery($sql);
        if ($result) {
            header("Location: ../../view/page/addComponentLevel.php?act=edit&status=success&id='" . $cmpLvlDto->getCmpLvlID() . "'");
            exit();
        } else {
            header("Location: ../../view/page/addComponentLevel.php?act=edit&status=failed&id='" . $cmpLvlDto->getCmpLvlID() . "'");
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
    public function IsValidRubricCmpExists($Title, $RoleForMark, $session)
    {
        $sql = "SELECT * FROM RubricComponent WHERE Title LIKE'%" . $Title . "%' AND RoleForMark ='" . $RoleForMark . "' AND CriteriaSession LIKE'%" . $session . "%'";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }
}
