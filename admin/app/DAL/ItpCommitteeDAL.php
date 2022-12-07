<?php

/**
 * Class for database interaction
 */
require_once("../../includes/db_connection.php");
class ItpCommitteeDAL
{

    protected $databaseConnectionObj;

    public function __construct()
    {
        $this->databaseConnectionObj = new DBController();
    }
    /**
     * Get All ItpCommittee
     *
     * @return array
     */
    public function GetAllItpCommittee()
    {
        //$db = new DBController();
        $listOfItpCommitteDto = array();
        $sql = "SELECT * from ITPCommittee";
        $result = $this->databaseConnectionObj->runQuery($sql);
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $committeeID = $result[$i]['committeeID'];
                $committeeName = $result[$i]['commName'];
                $gender = $result[$i]['commGender'];
                $committeeEmail = $result[$i]['commEmail'];
                $committeeContactNo = $result[$i]['commContactNumber'];
                $committeeAddress = $result[$i]['commAddress'];
                $committeePosition = $result[$i]['commJobPosition'];
                $date = $result[$i]['commDateJoined'];
                $listOfItpCommitteDto[] = new ItpCommitteeDTO($committeeID, $committeeName, $gender,$committeeEmail,$committeeContactNo,$committeeAddress,$committeePosition,"",$date);
                
            }
        }
        return $listOfItpCommitteDto;
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
            $listOfRubricAssessmentObj->setfacultyID($aRubricAssmt[0]['facultyID']);
            return $listOfRubricAssessmentObj;
        }

        return false;
    }

    //generate ID
    public function generateID()
    {
        $db = new DBController();
        //Will be descending order
        $sql = "SELECT * FROM ITPCommittee ORDER BY committeeID DESC";
        $result = $db->runQuery($sql);
        $prefix = 'ITP';

        if (empty($result)) {
            $prefix .= '00001';
            return $prefix;
        }

        //Get the first ID 
        $lastID = $result[0]['committeeID'];
        //SubString to last part of ID
        $numberPart = substr($lastID, 3, 5);

        if ((int) $numberPart < 9) {
            $prefix .= '0000' . ((int) $numberPart + 1);
        } else if ((int) $numberPart >= 9) {
            $prefix .= '000' . ((int) $numberPart + 1);
        }

        return $prefix;
    }

    /**
     * Insert New ITP Committee
     *
     * @param object $itpCommitteeDTO
     */
    public function AddItpCommittee($itpCommitteeDTO)
    {
        $sql = "INSERT INTO ITPCommittee (`committeeID`, `commName` ,`commGender`, `commEmail`,`commContactNumber`,`commAddress`,`commJobPosition`,`commPassword`,`commDateJoined`)
                VALUES (
                  '" . $itpCommitteeDTO->getcommitteeID() . "',
                  '" . $itpCommitteeDTO->getcommName() . "',
                  '" . $itpCommitteeDTO->getcommGender() . "',
                  '" . $itpCommitteeDTO->getcommEmail() . "',
                  '" . $itpCommitteeDTO->getcommContactNo() . "',
                  '" . $itpCommitteeDTO->getcommAddress() . "',
                  '" . $itpCommitteeDTO->getcommJobPosition() . "',
                  '" . $itpCommitteeDTO->getcommPassword() . "',
                  '" . $itpCommitteeDTO->getcommDateJoin() . "'
                )";
        $result = $this->databaseConnectionObj->executeQuery($sql);

        if ($result) {
            header("Location: ../../view/page/joel-ItpCommittee.php?status=success");
            exit();
        } else {
            header("Location: ../../view/page/joel-ItpCommittee.php?status=failed");
            exit();
        }
    }

    /**
     * Update ITP Committee
     *
     * @param object $rubricAssmtDto
     */
    public function UpdRubricAssmt($itpCommitteeDTO)
    {
        $sql = " UPDATE RubricAssessment SET
            internshipBatchID = '" . $itpCommitteeDTO->getInternshipBatchID() . "',
            facultyID='" . $itpCommitteeDTO->getfacultyID() . "',
            Title = '" . $itpCommitteeDTO->getTitle() . "',
            Instructions ='" . $itpCommitteeDTO->getInstructions() . "',
            TotalWeight ='" . $itpCommitteeDTO->getTotalWeight() . "',
            RoleForMark ='" . $itpCommitteeDTO->getRoleForMark() . "'
            WHERE assessmentID ='" . $itpCommitteeDTO->getAssmtId() . "'";
        $result = $this->databaseConnectionObj->executeQuery($sql);
        if ($result) {
            header("Location: ../../view/page/joel-ItpCommittee.php?act=edit&status=success&id='" . $itpCommitteeDTO->getAssmtId() . "'");
            exit();
        } else {
            header("Location: ../../view/page/joel-ItpCommittee.php?act=edit&status=failed&id='" . $itpCommitteeDTO->getAssmtId() . "'");
            exit();
        }
    }


    /**
     * Checks whether given Email is Existing
     *
     * @param string $tiitle
     * @param int $id
     * @param string $assmtID
     * @return bool
     */
    public function IsEmailExists($email)
    {
        $sql = "SELECT * FROM ITPCommittee WHERE commEmail='" . $email . "'";
        $result = $this->databaseConnectionObj->runQuery($sql);

        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }
}
