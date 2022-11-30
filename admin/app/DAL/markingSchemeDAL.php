<?php
require_once '../../includes/db_connection.php';

class markingSchemeDAL
{
    protected $databaseConnectionObj;
    public function __construct()
    {
        $this->databaseConnectionObj = new DBController();
    }

    /**
     * Get a Get Marking Scheme
     *
     * @param string $assessmentID
     * @param string $assessmentID
     * @return bool|\MarkingSchemeDTO
     */
    public function GetMarkingScheme($resultID, $assessmentID)
    {

        $listOfMarkingSchemeDTO = array();
        $sql = "SELECT * FROM MarkingScheme WHERE studResultID= '$resultID' AND assessmentID='$assessmentID' order by markingID";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $markingID = $result[$i]['markingID'];
                $studResultID = $result[$i]['studResultID'];
                $assessmentID = $result[$i]['assessmentID'];
                $CriteriaID = $result[$i]['CriteriaID'];
                $Score = $result[$i]['Score'];
                $listOfMarkingSchemeDTO[] = new MarkingSchemeDTO($markingID, $studResultID, $assessmentID, $CriteriaID, $Score);
            }
        }
        return $listOfMarkingSchemeDTO;
    }

    //generate ID
    public function generateID()
    {
        $db = new DBController();
        //Will be descending order
        $sql = "SELECT * FROM markingScheme ORDER BY markingID DESC";
        $result = $db->runQuery($sql);
        $prefix = 'MARK';

        if (empty($result)) {
            $prefix .= '000001';
            return $prefix;
        }

        //Get the first ID 
        $lastID = $result[0]['markingID'];
        //SubString to last part of ID
        $numberPart = substr($lastID, 4, 6);

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
    public function addMarckingScheme($studResultDTO, $markingSchemeDTO)
    {
        $sql = " UPDATE StudentResult SET
        finalScore = '" . $studResultDTO->getfinalScore() . "',
        feedback = '" . $studResultDTO->getfeedback() . "',
        signature = '" . $studResultDTO->getsignature() . "',
        markByID = '" . $studResultDTO->getmarkByid() . "',
        markDate = '" . $studResultDTO->getmarkDate() . "'
        WHERE studResultID ='" . $studResultDTO->getstudResultID() . "'";
        $result = $this->databaseConnectionObj->executeQuery($sql);

        foreach ($markingSchemeDTO as $markingSchemeDTO1) {
            $sql1 = "INSERT INTO MarkingScheme (`markingID`,`studResultID`,`assessmentID`,`CriteriaID`,`Score`)
                VALUES (
                  '" . $markingSchemeDTO1->getmarkingID() . "',
                  '" . $markingSchemeDTO1->getstudResultID() . "',
                  '" . $markingSchemeDTO1->getassessmentID() . "',
                  '" . $markingSchemeDTO1->getcriteriaID() . "',
                  '" . $markingSchemeDTO1->getscore() . "'
                )";

            $result2 = $this->databaseConnectionObj->executeQuery($sql1);
        }

        //location
        if ($result && $result2) {
            header("Location: listStudEvaluationByLecture.php?status=success&lectureID=" . $studResultDTO->getmarkByid() . "");
            exit();
        } else {
            header("Location: listStudEvaluationByLecture.php?status=failed&lectureID=" . $studResultDTO->getmarkByid() . "");
            exit();
        }
    }

    /**
     * Update Rubric Assessment
     *
     * @param object $rubricAssmtDto
     */
    public function UpdMarkingScheme($studResultDTO, $markingSchemeDTO)
    {
        $sql = " UPDATE StudentResult SET
        finalScore = '" . $studResultDTO->getfinalScore() . "',
        feedback = '" . $studResultDTO->getfeedback() . "',
        signature = '" . $studResultDTO->getsignature() . "',
        markByID = '" . $studResultDTO->getmarkByid() . "',
        markDate = '" . $studResultDTO->getmarkDate() . "'
        WHERE studResultID ='" . $studResultDTO->getstudResultID() . "'";
        $result = $this->databaseConnectionObj->executeQuery($sql);

        foreach ($markingSchemeDTO as $markingSchemeDTO1) {
            $sql1 = " UPDATE MarkingScheme SET
            Score = '" . $markingSchemeDTO1->getscore() . "'
            WHERE markingID ='" . $markingSchemeDTO1->getmarkingID() . "'";
            $result2 = $this->databaseConnectionObj->executeQuery($sql1);
        }
        //lectureID='${lectureID.value}'&studResultId='${i.studResultID}'&studid='${i.studentID}'&internshipBatchID='${internshipBatchID.value}'&studName='${i.studName}'&studProgrammeName='${i.programmeName}'&finalScore='${i.finalScore}
        if ($result && $result2) {
            header("Location: listStudEvaluationByLecture.php?status=success&lectureID=" . $studResultDTO->getmarkByid() . "");
            exit();
        } else {
            header("Location: listStudEvaluationByLecture.php?status=failed&lectureID=" . $studResultDTO->getmarkByid() . "");
            exit();
        }
    }
}
