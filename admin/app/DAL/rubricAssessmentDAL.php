<?php

/**
 * Class for database interaction
 */
require_once("../../includes/db_connection.php");
class rubricAssessmentDAL
{

    protected $databaseConnectionObj;

    public function __construct()
    {
        $this->databaseConnectionObj = new DBController();
    }
    /**
     * Get All RubricAssessment
     *
     * @return array
     */
    public function GetAllRubricAssessment()
    {
        //$db = new DBController();
        $listOfRubricAssessmentDto = array();
        $sql = "SELECT * FROM RubricAssessment";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $assessmentID = $result[$i]['assessmentID'];
                $internshipBatchID = $result[$i]['internshipBatchID'];
                $Title = $result[$i]['Title'];
                $Instructions = $result[$i]['Instructions'];
                $TotalWeight = $result[$i]['TotalWeight'];
                $RoleForMark = $result[$i]['RoleForMark'];
                $CreateByID = $result[$i]['CreateByID'];
                $CreateDate = $result[$i]['CreateDate'];
                $listOfRubricAssessmentDto[] = new rubricAssessmentDTO($assessmentID, $internshipBatchID, $Title, $Instructions, $TotalWeight, $RoleForMark, $CreateByID, $CreateDate);
            }
        }
        return $listOfRubricAssessmentDto;
    }

    /**
     * Get a student
     *
     * @param string $assessmentID
     * @return bool|\rubricAssessmentDTO
     */
    public function GetRubricAssmt($assessmentID)
    {
        $sql = "SELECT * FROM RubricAssessment WHERE assessmentID= '$assessmentID'";
        $aRubricAssmt = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($aRubricAssmt)) {
            $listOfRubricAssessmentObj = new rubricAssessmentDTO(
                $aRubricAssmt[0]['assessmentID'],
                $aRubricAssmt[0]['internshipBatchID'],
                $aRubricAssmt[0]['Title'],
                $aRubricAssmt[0]['Instructions'],
                $aRubricAssmt[0]['TotalWeight'],
                $aRubricAssmt[0]['RoleForMark'],
                $aRubricAssmt[0]['CreateByID'],
                $aRubricAssmt[0]['CreateDate']
            );
            return $listOfRubricAssessmentObj;
        }

        return false;
    }

    //generate ID
    public function generateID()
    {
        $db = new DBController();
        //Will be descending order
        $sql = "SELECT * FROM RubricAssessment ORDER BY assessmentID DESC";
        $result = $db->runQuery($sql);
        $prefix = 'ASSMT';

        if (empty($result)) {
            $prefix .= '000001';
            return $prefix;
        }

        //Get the first ID 
        $lastID = $result[0]['assessmentID'];
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
     * @param object $rubricAssmtDto
     */
    public function AddRubricAssmt($rubricAssmtDto, $rubricAssmtCriteriaDto)
    {
        $sql = "INSERT INTO RubricAssessment (`assessmentID`, `internshipBatchID`, `Title`, `Instructions`,`TotalWeight`,`RoleForMark`,`CreateByID`,`CreateDate`)
                VALUES (
                  '" . $rubricAssmtDto->getAssmtId() . "',
                  '" . $rubricAssmtDto->getInternshipBatchID() . "',
                  '" . $rubricAssmtDto->getTitle() . "',
                  '" . $rubricAssmtDto->getInstructions() . "',
                  '" . $rubricAssmtDto->getTotalWeight() . "',
                  '" . $rubricAssmtDto->getRoleForMark() . "',
                  '" . $rubricAssmtDto->getCreateByID() . "',
                  '" . $rubricAssmtDto->getCreateDate() . "'
                )";
        $result = $this->databaseConnectionObj->executeQuery($sql);
        foreach ($rubricAssmtCriteriaDto as $rubricAssmtCriteriaDto1) {
            $sql1 = "INSERT INTO RubricAssessmentCriteria (`assessmentID`,`criterionID`,`Title`,`TotalWeight`)
                    VALUES (
                      '" . $rubricAssmtCriteriaDto1->getAssmtId() . "',
                      '" . $rubricAssmtCriteriaDto1->getcriterionID() . "',
                      '" . $rubricAssmtCriteriaDto1->getTitle() . "',
                      '" . $rubricAssmtCriteriaDto1->getscore() . "'
                    )";
            $result2 = $this->databaseConnectionObj->executeQuery($sql1);
        }
        if ($result &&  $result2) {

            header("Location: ../../view/page/addRubricAssessment.php?status=success");
            exit();
        } else {
            header("Location: ../../view/page/addRubricAssessment.php?status=failed");
            exit();
        }
    }

    /**
     * Update Rubric Assessment
     *
     * @param object $rubricAssmtDto
     */
    public function UpdRubricAssmt($rubricAssmtDto)
    {
        $sql = " UPDATE RubricAssessment SET
            internshipBatchID = '" . $rubricAssmtDto->getInternshipBatchID() . "',
            Title = '" . $rubricAssmtDto->getTitle() . "',
            Instructions ='" . $rubricAssmtDto->getInstructions() . "',
            TotalWeight ='" . $rubricAssmtDto->getTotalWeight() . "',
            RoleForMark ='" . $rubricAssmtDto->getRoleForMark() . "'
            WHERE assessmentID ='" . $rubricAssmtDto->getAssmtId() . "'";
        $result = $this->databaseConnectionObj->executeQuery($sql);
        if ($result) {
            header("Location: ../../view/page/addRubricAssessment.php?act=edit&status=success&id='" . $rubricAssmtDto->getAssmtId() . "'");
            exit();
        } else {
            header("Location: ../../view/page/addRubricAssessment.php?act=edit&status=failed&id='" . $rubricAssmtDto->getAssmtId() . "'");
            exit();
        }
    }


    /**
     * Checks whether given Rubric Title exists in this session or not
     *
     * @param string $tiitle
     * @param int $id
     * @param string $assmtID
     * @return bool
     */
    public function IsRubricExists($tiitle, $id, $assmtID)
    {
        $sql = "SELECT * FROM RubricAssessment WHERE Title='" . $tiitle . "' AND assessmentID <>'" . $assmtID . "'AND internshipBatchID = $id ";
        $result = $this->databaseConnectionObj->runQuery($sql);

        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }
}
