<?php

/**
 * Class for database interaction
 */
include_once("../../includes/db_connection.php");
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
     * Insert New Student
     *
     * @param object $studentDto
     * @return int
     */
    public function AddRubricAssmt($rubricAssmtDto)
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

        if ($result) {
            header("Location: addRubricAssessment.php?addRubricAssessment=success");
            exit();
        } else {
            header("Location: addRubricAssessment.php?addRubricAssessment=failed");
            exit();
        }
    }


    /**
     * Checks whether given Rubric Title exists in this session or not
     *
     * @param string $tiitle
     * @param int $id
     * @return bool
     */
    public function IsRubricExists($tiitle, $id)
    {
        $sql = "SELECT * FROM RubricAssessment WHERE Title='" . $tiitle . "' AND internshipBatchID = $id";
        $result = $this->databaseConnectionObj->runQuery($sql);

        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }
}
