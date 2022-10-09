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
                $Title = $result[$i]['Title'];
                $Instructions = $result[$i]['Instructions'];
                $TotalWeight = $result[$i]['TotalWeight'];
                $RoleForMark = $result[$i]['RoleForMark'];
                $CreateByID = $result[$i]['CreateByID'];
                $CreateDate = $result[$i]['CreateDate'];
                $InternStartDate = $result[$i]['InternStartDate'];
                $InternEndDate = $result[$i]['InternEndDate'];
                $listOfRubricAssessmentDto[] = new rubricAssessmentDTO($assessmentID, $Title, $Instructions, $TotalWeight, $RoleForMark, $CreateByID, $CreateDate, $InternStartDate, $InternEndDate);
            }
        }
        return $listOfRubricAssessmentDto;
    }
}
